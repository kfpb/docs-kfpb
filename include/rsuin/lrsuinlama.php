<?php
	session_start(0);
	error_reporting(E_ALL ^ (E_NOTICE | E_WARNING));
	
	include"../../config/koneksi.php";
	include"../../config/fungsi_indotgl.php";
	require_once "../cek_sesi.php";
	require('../pdf/fpdf.php');
	
class PDF extends FPDF
{
	function Header()
	{
		//set logo
		$tgl=tgl_indo(date("Y-m-d"));
		$this->Image('../pdf/logo.jpg',20,10,'');
		// menulis header
		$this->SetFont('Times','B',16);
		$this->Cell(0,4,'',0,2,'C');
		$this->Cell(0,8,'PLANT Banjaran',0,2,'C');
		$this->SetFont('Times','B',24);
		$this->Cell(0,8,'PT. KIMIA FARMA',0,2,'C');
		$this->SetFont('Times','B',15);
		$this->Cell(0,8,'Banjaran',0,1,'C');
		$this->Cell(0,6,'',0,1,'C');
		
		// membuat jarak terhadap cell sebelumnya
		
		
		// setting properti font
		$this->SetFont('Times','',12);
		$this->Cell(0,5,'Banjaran, '.$tgl,0,2,'R');

		// membuat garis dari koordinat (10 mm, 40 mm) sampai koordinat (20 mm,40 mm)
		$this->Line(10,40,270,40);

		// membuat space kosong antara header dengan teks konten
		$this->Ln(5);
	}

	// membuat footer
	function Footer()
	{
		//Position at 1.5 cm from bottom
		$this->SetY(-15);
		$this->Line(10,200,270,200);
		//Arial italic 8
		$this->SetFont('Times','',10);
		//Page number
		$this->Cell(0,10,$this->PageNo(),0,0,'R');
	}
	
	function LoadData()
	{
		$data=array();
		$query = "SELECT a.inmr, a.itgl, a.ipengirim, a.iperihal, b.cNama FROM isurat a
				  LEFT JOIN users b ON a.ikepada=b.cId
				  WHERE a.itgl>='$_POST[tglm]' AND a.itgl<='$_POST[tgls]'";
				  
		$hasil = mysql_query($query);
		$i = 0;
		while ($fetchdata = mysql_fetch_row($hasil))
		{
			$i++; // membuat counter 1, 2, 3, ... untuk ditampilkan
			array_unshift($fetchdata,$i);
			$data[] = $fetchdata;	
		}
		return $data;
	}
	
	function TabelWarna($header,$data)
	{
		// setting lebar masing-masing kolom dalam mm
		//$hdr = array('NO','NOMOR SURAT','TANGGAL','DARI','PERIHAL','KEPADA')
		$w=array(8,50,35,60,60,50);   
		$p=array('C','L','C','L','L','L'); 

		// membuat kepala tabel
		for($i=0;$i<count($header);$i++)
		{
			// memberi warna latar merah pada kepala tabel
			$this->SetFillColor(255, 0, 0);    	
			// setting huruf bold pada kepala tabel
			$this->SetFont('Times','B',12);           
			// parameter L menunjukkan teks rata kiri pada setiap 
			// sel kepala tabel 
			$this->Cell($w[$i],7,$header[$i],1,0,'C',1);    
		}
		$this->Ln();
		// menampilkan data
		// setting jenis font pada data tabel
		$this->SetFont('Times','',12);     
		$j = 0;
		foreach($data as $row)
		{
			$this->SetFillCOlor(255,255,255); //row warna putih
			// menampilkan data rata kiri	
			for($i=0;$i<=sizeof($w)-1;$i++){
				if ($i==2){
					$this->Cell($w[$i],6,tgl_indo($row[$i]),1,0,$p[$i],1);
				}else{
					$this->Cell($w[$i],6,$row[$i],1,0,$p[$i],1);							
				}
			}
			$this->Ln();
			$j++;
			
		}
		// penutup tabel
		$this->Cell(array_sum($w),0,'','T');
	}
}

	$pdf=new PDF();
	$pdf->AddPage('Landscape','Letter');
	$pdf->setMargins(10,10,10,10);
	
	$tglm = tgl_indo($_POST[tglm]);
	$tgls = tgl_indo($_POST[tgls]);
	
	$pdf->Cell(0,5,'LAPORAN SURAT MASUK PERIODE '.$tglm.' - '.$tgls,0,1,'L');
	
	$pdf->Ln(5);
	$header = Array('NO','NOMOR SURAT','TANGGAL','DARI','PERIHAL','KEPADA');
	// memanggil function untuk baca data
	$data = $pdf->LoadData();

	//$pdf->AddPage();

	// memanggil function untuk menampilkan tabel
	$pdf->TabelWarna($header,$data);
	
	$pdf->Ln(5);
	$pdf->Output();

?>