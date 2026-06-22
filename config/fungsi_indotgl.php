<?php

	date_default_timezone_set('Asia/Jakarta');

	function tgl_indo($tgl){

			$tanggal = substr($tgl,8,2);

			$bulan = getBulan(substr($tgl,5,2));

			$tahun = substr($tgl,0,4);

			return $tanggal.' '.$bulan.' '.$tahun;		 

	}	

function tgl_indojam($tgl){

			$tanggal = substr($tgl,8,2);

			$bulan = getBulan(substr($tgl,5,2));

			$tahun = substr($tgl,0,4);
			
			$jam = date("H:i:s",strtotime($tgl));

			return $tanggal.' '.$bulan.' '.$tahun.'<br> '.$jam;		 

	}


	function getBulan($bln){

				switch ($bln){

					case 1: 

						return "Jan";

						break;

					case 2:

						return "Feb";

						break;

					case 3:

						return "Mar";

						break;

					case 4:

						return "Apr";

						break;

					case 5:

						return "Mei";

						break;

					case 6:

						return "Jun";

						break;

					case 7:

						return "Jul";

						break;

					case 8:

						return "Agu";

						break;

					case 9:

						return "Sep";

						break;

					case 10:

						return "Okt";

						break;

					case 11:

						return "Nov";

						break;

					case 12:

						return "Des";

						break;

				}

			} 

function tgl_indo1($tgl){
$tanggal = substr($tgl,8,2);
$bulan = getBulan1(substr($tgl,5,2));
$tahun = substr($tgl,0,4);
return $tanggal.'-'.$bulan.'-'.$tahun;			 
	}	
	
function getBulan1($bln){
				switch ($bln){
					case 1: 
						return "01";
						break;
					case 2:
						return "02";
						break;
					case 3:
						return "03";
						break;
					case 4:
						return "04";
						break;
					case 5:
						return "05";
						break;
					case 6:
						return "06";
						break;
					case 7:
						return "07";
						break;
					case 8:
						return "08";
						break;
					case 9:
						return "09";
						break;
					case 10:
						return "10";
						break;
					case 11:
						return "11";
						break;
					case 12:
						return "12";
				break;
				}
		}


		
function tgl_indo2($tgl){
	
	if ($tgl==0000-00-00) { echo"";}
	else {
			$tanggal = substr($tgl,8,2);
			$bulan = getBulan1(substr($tgl,5,2));
			$tahun = substr($tgl,2,2);
			return $tanggal.'/'.$bulan.'/'.$tahun;	
			}		 
	}	
	
function tgl_indo3($tgl){
			$tanggal = substr($tgl,8,2);
			$bulan = getBulan1(substr($tgl,5,2));
			$tahun = substr($tgl,0,4);
			return $tahun.'-'.$bulan.'-'.$tanggal;			 
	}	
		
function tgl_indo4($tgl){
			$tanggal = substr($tgl,8,2);
			$bulan = getBulan1(substr($tgl,5,2));
			$tahun = substr($tgl,2,2);
			return $bulan.'-'.$tahun;	 
	}	
	
function tgl_indo5($tgl){
			$tanggal = substr($tgl,8,2);
			$bulan = getBulan1(substr($tgl,5,2));
			$tahun = substr($tgl,0,4);
			return $tanggal.'-'.$bulan.'-'.$tahun;			 
	}			
	
function tgl_indo6($tgl){
			$tanggal = substr($tgl,8,2);
			$bulan = getBulan1(substr($tgl,5,2));
			return '-'.$bulan.'-'.$tanggal.''.$tahun;			 
	}	
	
	
function getBulan2($bln){
				switch ($bln){
					case 1: 
						return "A";
						break;
					case 2:
						return "B";
						break;
					case 3:
						return "C";
						break;
					case 4:
						return "D";
						break;
					case 5:
						return "E";
						break;
					case 6:
						return "F";
						break;
					case 7:
						return "G";
						break;
					case 8:
						return "H";
						break;
					case 9:
						return "I";
						break;
					case 10:
						return "J";
						break;
					case 11:
						return "K";
						break;
					case 12:
						return "L";
				break;
				}
		}

function tgl_indo7($tgl){
$tanggal = substr($tgl,8,2);
$bulan = getBulan2(substr($tgl,5,2));
$tahun = substr($tgl,0,4);
return $bulan;			 
	}
	
	function getBula($bln){
				switch ($bln){
					case 1: 
						return "Januari";
						break;
					case 2:
						return "Februari";
						break;
					case 3:
						return "Maret";
						break;
					case 4:
						return "April";
						break;
					case 5:
						return "Mei";
						break;
					case 6:
						return "Juni";
						break;
					case 7:
						return "Juli";
						break;
					case 8:
						return "Agustus";
						break;
					case 9:
						return "September";
						break;
					case 10:
						return "Oktober";
						break;
					case 11:
						return "November";
						break;
					case 12:
						return "Desember";
				break;
				}
		}
		
		function tgl_indo8($tgl){
            $bulan = getBula($tgl);
            return $bulan;			 
	    }	
		function tgl_indo9($tgl){
            $tanggal = substr($tgl,8,2);
            $bulan = getBula(substr($tgl,5,2));
            $tahun = substr($tgl,0,4);
            return $tahun;			 
	    }	
	    
	    function getBulanfilter($bln){
				switch ($bln){
					case 01: 
						return "01";
						break;
					case 02:
						return "02";
						break;
					case 03:
						return "03";
						break;
					case 04:
						return "04";
						break;
					case 05:
						return "05";
						break;
					case 06:
						return "06";
						break;
					case 07:
						return "07";
						break;
					case 08:
						return "08";
						break;
					case 09:
						return "09";
						break;
					case 10:
						return "10";
						break;
					case 11:
						return "11";
						break;
					case 12:
						return "12";
				break;
				}
		}
		
		function tgl_bulanfilt($tgl){
            $tanggal = substr($tgl,8,2);
            $bulan = getBulanfilter(substr($tgl,5,2));
            $tahun = substr($tgl,0,4);
            return $bulan;			 
	    }
		


?>