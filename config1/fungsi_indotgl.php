<?php
function tgl_indo($tgl){
			$tanggal = substr($tgl,8,2);
			$bulan = getBulan(substr($tgl,5,2));
			$tahun = substr($tgl,0,4);
			return $tanggal.' '.$bulan.' '.$tahun;		 
	}	

function tgl_indo1($tgl){
			$tanggal = substr($tgl,8,2);
			$bulan = getBulan1(substr($tgl,5,2));
			return '-'.$bulan.'-'.$tanggal.''.$tahun;			 
	}	
	
function tgl_indo12($tgl){
			$tanggal = substr($tgl,8,2);
			$bulan = getBulan1(substr($tgl,5,2));
			return '-'.$bulan.'-'.$tanggal.''.$tahun;			 
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
?>
