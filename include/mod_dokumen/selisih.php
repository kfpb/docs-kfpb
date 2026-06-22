<?
function selisihHari($tglAwal, $tglAkhir)
{
// list tanggal merah selain hari minggu
$tglLibur = Array("2012-08-17","2012-08-20","2012-08-21","2012-08-22","2012-08-23","2012-08-24","2012-10-26","2012-11-15","2012-11-16","2012-12-24","2012-12-25","2012-12-31","2013-01-01","2013-01-24","2013-03-12","2013-03-29","2013-05-01","2013-05-09","2013-07-06","2013-08-07","2013-08-08","2013-08-09","2013-08-12","2013-08-13","2013-10-14","2013-10-15","2013-10-31","2013-11-05","2013-12-25","2013-12-26","2014-01-01","2014-01-14","2014-01-31","2014-03-31","2014-04-09","2014-04-18","2014-05-01","2014-05-02","2014-05-15","2014-05-26","2014-05-27","2014-07-09","2014-07-28","2014-07-29","2014-07-30","2014-07-31","2014-08-01","2014-12-25","2014-12-26","2015-01-01","2015-01-02","2015-02-19","2015-04-03","2015-05-01","2015-05-14","2015-06-02","2015-07-16","2015-07-17","2015-07-18","2015-07-20","2015-07-21","2015-08-17","2015-05-27","2015-09-24","2015-10-14","2015-11-12","2015-12-24","2015-12-25","2016-01-01","2016-02-08","2016-03-09","2016-03-25","2016-05-05","2016-05-06","2016-07-04","2016-07-05","2016-07-06","2016-07-07","2016-07-08","2016-08-17","2016-09-12","2016-12-12","2016-12-26");
 
// memecah string tanggal awal untuk mendapatkan
// tanggal, bulan, tahun
$pecah1 = explode("-", $tglAwal);
$date1 = $pecah1[2];
$month1 = $pecah1[1];
$year1 = $pecah1[0];
 
// memecah string tanggal akhir untuk mendapatkan
// tanggal, bulan, tahun
$pecah2 = explode("-", $tglAkhir);
$date2 = $pecah2[2];
$month2 = $pecah2[1];
$year2 =  $pecah2[0];
 
// mencari selisih hari dari tanggal awal dan akhir
$jd1 = GregorianToJD($month1, $date1, $year1);
$jd2 = GregorianToJD($month2, $date2, $year2);
 
$selisih = $jd2 - $jd1;

// proses menghitung tanggal merah dan hari minggu
// di antara tanggal awal dan akhir
for($i=1; $i<=$selisih; $i++)
{
// menentukan tanggal pada hari ke-i dari tanggal awal
$tanggal = mktime(0, 0, 0, $month1, $date1+$i, $year1);
$tglstr = date("Y-m-d", $tanggal);

// menghitung jumlah tanggal pada hari ke-i
// yang masuk dalam daftar tanggal merah selain minggu
if (in_array($tglstr, $tglLibur))
{
$libur1++;
}
 
// menghitung jumlah tanggal pada hari ke-i
// yang merupakan hari minggu
if ((date("N", $tanggal) == 7))
{
$libur2++;
}

// menghitung jumlah tanggal pada hari ke-i
// yang merupakan hari sabtu
if ((date("N", $tanggal) == 6))
{
$libur3++;
}

}

// menghitung selisih hari yang bukan tanggal merah dan hari minggu
return $selisih-$libur1-$libur2-$libur3;

}
?>