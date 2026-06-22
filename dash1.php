<?php

	$memo_ttl = mysql_query("SELECT * FROM sinter a LEFT JOIN psin b ON a.siid=b.siid LEFT JOIN users c ON a.sipengirim1=c.cId WHERE b.cId='$_SESSION[cv]' && a.sstatus='Y'");
	$memo_belum = mysql_query("SELECT a.*,b.*,c.cNama FROM sinter a LEFT JOIN psin b ON a.siid=b.siid LEFT JOIN users c ON a.sipengirim1=c.cId WHERE b.cId='$_SESSION[cv]' && a.sstatus='Y' && b.sistatus = 'N'");
	$memo_sudah = mysql_query("SELECT a.*,b.*,c.cNama FROM sinter a LEFT JOIN psin b ON a.siid=b.siid LEFT JOIN users c ON a.sipengirim1=c.cId WHERE b.cId='$_SESSION[cv]' && a.sstatus='Y' && b.sistatus = 'Y'");
		


	$qsi_ttl = mysql_num_rows(mysql_query("SELECT a.*,b.*,c.cNama FROM sinter a LEFT JOIN psin b ON a.siid=b.siid LEFT JOIN users c ON a.sipengirim1=c.cId WHERE b.cId='$_SESSION[cv]' && a.sstatus='Y'"));
	$qsi_urd = mysql_num_rows(mysql_query("SELECT a.*,b.*,c.cNama FROM sinter a LEFT JOIN psin b ON a.siid=b.siid LEFT JOIN users c ON a.sipengirim1=c.cId WHERE b.cId='$_SESSION[cv]' && a.sstatus='Y' && b.sistatus = 'N'"));
	$qsi_rd = mysql_num_rows(mysql_query("SELECT a.*,b.*,c.cNama FROM sinter a LEFT JOIN psin b ON a.siid=b.siid LEFT JOIN users c ON a.sipengirim1=c.cId WHERE b.cId='$_SESSION[cv]' && a.sstatus='Y' && b.sistatus = 'Y'"));
		
	$qsi = mysql_query("SELECT a.cId,a.cNama, 
						(SELECT COUNT(b.psid) FROM psin b WHERE a.cId=b.cId) AS ttl,
						(SELECT COUNT(c.psid) FROM psin c WHERE a.cId=c.cId AND c.sistatus='N') AS urd,
						(SELECT COUNT(d.psid) FROM psin d WHERE a.cId=d.cId AND d.sistatus='Y') AS rd
						FROM users a WHERE a.cId='$_SESSION[cv]'");
	$i=mysql_fetch_array($qsi);
	
	$tsi_ttl = mysql_num_rows(mysql_query("SELECT a.*,b.*,c.cNama FROM sinter a LEFT JOIN tsin b ON a.siid=b.siid LEFT JOIN users c ON a.sipengirim1=c.cId WHERE b.cId='$_SESSION[cv]' && a.sstatus='Y'"));
	$tsi_urd = mysql_num_rows(mysql_query("SELECT a.*,b.*,c.cNama FROM sinter a LEFT JOIN tsin b ON a.siid=b.siid LEFT JOIN users c ON a.sipengirim1=c.cId WHERE b.cId='$_SESSION[cv]' && a.sstatus='Y' && b.sistatus = 'N'"));
	$tsi_rd = mysql_num_rows(mysql_query("SELECT a.*,b.*,c.cNama FROM sinter a LEFT JOIN tsin b ON a.siid=b.siid LEFT JOIN users c ON a.sipengirim1=c.cId WHERE b.cId='$_SESSION[cv]' && a.sstatus='Y' && b.sistatus = 'Y'"));
	
	$tsi = mysql_query("SELECT a.cId,a.cNama, 
						(SELECT COUNT(b.tsid) FROM tsin b WHERE a.cId=b.cId) AS ttl,
						(SELECT COUNT(c.tsid) FROM tsin c WHERE a.cId=c.cId AND c.sistatus='N') AS urd,
						(SELECT COUNT(d.tsid) FROM tsin d WHERE a.cId=d.cId AND d.sistatus='Y') AS rd
						FROM users a WHERE a.cId='$_SESSION[cv]'");
	$t=mysql_fetch_array($tsi);
	
	$qds = mysql_query("SELECT a.cId,a.cNama, 
						(SELECT COUNT(b.pdid) FROM pdis b WHERE a.cId=b.cId AND b.iid=0) AS ttl,
						(SELECT COUNT(c.pdid) FROM pdis c WHERE a.cId=c.cId AND c.psTglbaca='0000-00-00' AND c.iid=0) AS urd,
						(SELECT COUNT(d.pdid) FROM pdis d WHERE a.cId=d.cId AND d.psTglbaca<>'0000-00-00' AND d.iid=0) AS rd
						FROM users a WHERE a.cId='$_SESSION[cv]'");
	$d=mysql_fetch_array($qds);
	
	$qdt = mysql_query("SELECT a.cId,a.cNama, 
						(SELECT COUNT(b.pdid) FROM pdis b WHERE a.cId=b.cId AND b.siid=0) AS ttl,
						(SELECT COUNT(c.pdid) FROM pdis c WHERE a.cId=c.cId AND c.psTglbaca='0000-00-00' AND c.siid=0) AS urd,
						(SELECT COUNT(d.pdid) FROM pdis d WHERE a.cId=d.cId AND d.psTglbaca<>'0000-00-00' AND d.siid=0) AS rd
						FROM users a WHERE a.cId='$_SESSION[cv]'");
	$s=mysql_fetch_array($qdt);
	
	$qts = mysql_query("SELECT a.cId,a.cNama, 
						(SELECT COUNT(b.pdid) FROM tdis b WHERE a.cId=b.cId AND b.tampil='Y') AS ttl,
						(SELECT COUNT(c.pdid) FROM tdis c WHERE a.cId=c.cId AND c.psTglbaca='0000-00-00' AND c.tampil='Y') AS urd,
						(SELECT COUNT(d.pdid) FROM tdis d WHERE a.cId=d.cId AND d.psTglbaca<>'0000-00-00' AND d.tampil='Y') AS rd
						FROM users a WHERE a.cId='$_SESSION[cv]'");
	$te=mysql_fetch_array($qts);
?>

<html>
    <head><meta http-equiv="Content-Type" content="text/html; charset=utf-8">
        <title>e-kfpb</title>
        <script src="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/2.3.0/Chart.bundle.js"></script>

        <style type="text/css">
            .container {
                width: 50%;
                margin: 15px auto;
            }
        </style>
    </head>
    <body>
     
<center><h2>Data Pegawai Plant Banjaran</h2><h3></h3></center>         
       <table border=0 width=100%>
            <tr>
                <td>
                   

<?
	$upb = mysql_num_rows(mysql_query("SELECT * FROM pegawai WHERE cBagian3 ='UNIT PLANT Banjaran' AND cStatus!='MPP'"));
  	$pm = mysql_num_rows(mysql_query("SELECT * FROM pegawai WHERE cBagian3 ='SUB UNIT PEMASTIAN MUTU' AND cStatus!='MPP'"));
  	$prod = mysql_num_rows(mysql_query("SELECT * FROM pegawai WHERE cBagian3 ='SUB UNIT PRODUKSI' AND cStatus!='MPP'"));
 	$beli = mysql_num_rows(mysql_query("SELECT * FROM pegawai WHERE cBagian3 ='BAGIAN PEMBELIAN' AND cStatus!='MPP'"));
  	$qc = mysql_num_rows(mysql_query("SELECT * FROM pegawai WHERE cBagian3 ='BAGIAN PENGAWASAN MUTU' AND cStatus!='MPP'"));
  	$tp = mysql_num_rows(mysql_query("SELECT * FROM pegawai WHERE cBagian3 ='BAGIAN TEKNIK & PEMELIHARAAN' AND cStatus!='MPP'"));
  	$sdma = mysql_num_rows(mysql_query("SELECT * FROM pegawai WHERE cBagian3 ='BAGIAN AKUNTANSI & SDM' AND cStatus!='MPP'"));
  	$uk3l = mysql_num_rows(mysql_query("SELECT * FROM pegawai WHERE cBagian3 ='BAGIAN UMUM & K3L' AND cStatus!='MPP'"));
  	$p1 = mysql_num_rows(mysql_query("SELECT * FROM pegawai WHERE cBagian3 ='BAGIAN PRODUKSI I' AND cStatus!='MPP'"));
  	$p2 = mysql_num_rows(mysql_query("SELECT * FROM pegawai WHERE cBagian3 ='BAGIAN PRODUKSI II' AND cStatus!='MPP'"));
  	$kemas = mysql_num_rows(mysql_query("SELECT * FROM pegawai WHERE cBagian3 ='BAGIAN PENGEMASAN' AND cStatus!='MPP'"));
  	$pp = mysql_num_rows(mysql_query("SELECT * FROM pegawai WHERE cBagian3 ='BAGIAN PENGEMBANGAN PRODUK' AND cStatus!='MPP'")); 	
	$sm = mysql_num_rows(mysql_query("SELECT * FROM pegawai WHERE cBagian3 ='BAGIAN SISTEM MUTU' AND cStatus!='MPP'"));
  	$rdp = mysql_num_rows(mysql_query("SELECT * FROM pegawai WHERE cBagian3 ='BAGIAN PENGENDALIAN PROSES PRODUKSI' AND cStatus!='MPP'")); 	
	$simpan = mysql_num_rows(mysql_query("SELECT * FROM pegawai WHERE cBagian3 ='BAGIAN PENYIMPANAN' AND cStatus!='MPP'"));
  	$bnjrn = mysql_num_rows(mysql_query("SELECT * FROM pegawai WHERE cBagian3 ='PABRIK PLANT BANJARAN' AND cStatus!='MPP'")); 	
 
?>                   
                   
                    
                     <div class="container">
            <canvas id="myChart2" width="100%" height="100%"></canvas>
        </div>
        <script>
            var ctx = document.getElementById("myChart2");
            var myChart2 = new Chart(ctx, {
                type: 'bar',
                data: {
                    labels: ["PM", "MPM", "MP", "AMB", "AMPM", "AMTP","AMSDMA","AMUK3L","AMP1","AMP2","AMK","AMPP","AMSM","AMRDP","AMS","BNJRN"],
                    datasets: [{
                            label: 'Jumlah Pegawai Per Bagian',
                            data: [<? echo"$upb"; ?>, <? echo"$pm"; ?>, <? echo"$prod"; ?>, <? echo"$beli"; ?>, <? echo"$qc"; ?>, <? echo"$tp"; ?>, <? echo"$sdma"; ?>, <? echo"$uk3l"; ?>,<? echo"$p1"; ?>,<? echo"$p2"; ?>,<? echo"$kemas"; ?>,<? echo"$pp"; ?>,<? echo"$sm"; ?>,<? echo"$rdp"; ?>,<? echo"$simpan"; ?>,<? echo"$bnjrn"; ?>],
                            
                      <?   /*
                          labels: [<?php while ($b = mysql_fetch_array($memo_ttl)) { echo '"' . $b['bulan'] . '",';}?>],
                          datasets: [{
                            label: '# of Votes',
                         data: [<?php while ($p = mysql_fetch_array($memo_sudah)) { echo '"' . $p['hasil_penjualan'] . '",';}?>],
                         */ ?>
                         
                            backgroundColor: [
                                'rgba(255, 99, 132, 0.2)',
                                'rgba(54, 162, 235, 0.2)',
                                'rgba(255, 206, 86, 0.2)',
                                'rgba(75, 192, 192, 0.2)',
                                'rgba(153, 102, 255, 0.2)',
                                'rgba(255, 159, 64, 0.2)',
                                'rgba(255, 99, 132, 0.2)',
                                'rgba(54, 162, 235, 0.2)',
                                'rgba(255, 206, 86, 0.2)',
                                'rgba(75, 192, 192, 0.2)',
                                'rgba(153, 102, 255, 0.2)',
                                'rgba(255, 99, 132, 0.2)',
                                'rgba(54, 162, 235, 0.2)',
                                'rgba(255, 206, 86, 0.2)',
                                'rgba(255, 159, 64, 0.2)'
                            ],
                            borderColor: [
                                'rgba(255,99,132,1)',
                                'rgba(54, 162, 235, 1)',
                                'rgba(255, 206, 86, 1)',
                                'rgba(75, 192, 192, 1)',
                                'rgba(153, 102, 255, 1)',
                                'rgba(255, 159, 64, 1)',
                                'rgba(255, 99, 132, 0.2)',
                                'rgba(54, 162, 235, 0.2)',
                                'rgba(255, 206, 86, 0.2)',
                                'rgba(75, 192, 192, 0.2)',
                                'rgba(153, 102, 255, 0.2)',
                                'rgba(255,99,132,1)',
                                'rgba(54, 162, 235, 1)',
                                'rgba(255, 206, 86, 1)',
                                'rgba(255, 159, 64, 0.2)'
                            ],
                            borderWidth: 1
                        }]
                },
                options: {
                    scales: {
                        yAxes: [{
                                ticks: {
                                    beginAtZero: true
                                }
                            }]
                    }
                }
            });
        </script>
                    
                    </td>
            </tr>
       </table>
 <?
 	$pt = mysql_num_rows(mysql_query("SELECT * FROM pegawai WHERE cStatus='PT'"));
 	$pkwt = mysql_num_rows(mysql_query("SELECT * FROM pegawai WHERE cStatus='PKWT'"));
 	$to = mysql_num_rows(mysql_query("SELECT * FROM pegawai WHERE cStatus='TO'"));
 	$egs = mysql_num_rows(mysql_query("SELECT * FROM pegawai WHERE cStatus='EGS'"));	
 	$security = mysql_num_rows(mysql_query("SELECT * FROM pegawai WHERE cStatus='Security'"));
 	$security_bnjrn = mysql_num_rows(mysql_query("SELECT * FROM pegawai WHERE cStatus='Security_Bnjrn'"));
 	$ISS = mysql_num_rows(mysql_query("SELECT * FROM pegawai WHERE cStatus='ISS'"));
?>
<center><h3>Jumlah Pegawai berdasarkan status pegawai</h3></center>
        <table border=0 width=100%>
            <tr>
                <td>
                     <div class="container">
            <canvas id="myChart3"></canvas>
        </div>
        <script>
            var ctx = document.getElementById("myChart3");
            var myChart3 = new Chart(ctx, {
                type: 'pie',
                data: {
                    labels: ["Pegawai Tetap (PT)=<? echo"$pt"; ?>", "Pegawai Tidak Tetap (PKWT)=<? echo"$pkwt"; ?>", "Tenaga Outsourcing (TO)=<? echo"$to"; ?>", "EGS Kebersihan Bdg =<? echo"$egs"; ?>", "ISS Kebersihan Bnjrn =<? echo"$ISS"; ?>", "EGS Security Bdg =<? echo"$security"; ?>", "ISS Security Bnjrn =<? echo"$security_bnjrn"; ?>"],
                    datasets: [{
                            label: 'Jumlah Pegawai Berdasarkan Status',
                            data: [<? echo"$pt"; ?>, <? echo"$pkwt"; ?>, <? echo"$to"; ?>,  <? echo"$egs"; ?>,  <? echo"$ISS"; ?>, <? echo"$security"; ?>, <? echo"$security_bnjrn"; ?>],
                            
                      <?   /*
                          labels: [<?php while ($b = mysql_fetch_array($memo_ttl)) { echo '"' . $b['bulan'] . '",';}?>],
                          datasets: [{
                            label: '# of Votes',
                         data: [<?php while ($p = mysql_fetch_array($memo_sudah)) { echo '"' . $p['hasil_penjualan'] . '",';}?>],
                         */ ?>
                         
                            backgroundColor: [
                                'rgba(255, 99, 132, 0.2)',
                                'rgba(54, 162, 235, 0.2)',
                                'rgba(255, 206, 86, 0.2)',
                                'rgba(75, 192, 192, 0.2)',
                                'rgba(153, 102, 255, 0.2)',
                                'rgba(255, 159, 64, 0.2)',
                                'rgba(255, 99, 132, 0.2)',
                                'rgba(54, 162, 235, 0.2)',
                                'rgba(255, 206, 86, 0.2)',
                                'rgba(75, 192, 192, 0.2)',
                                'rgba(153, 102, 255, 0.2)',
                                'rgba(255, 159, 64, 0.2)'
                            ],
                            borderColor: [
                                'rgba(255,99,132,1)',
                                'rgba(54, 162, 235, 1)',
                                'rgba(255, 206, 86, 1)',
                                'rgba(75, 192, 192, 1)',
                                'rgba(153, 102, 255, 1)',
                                'rgba(255, 159, 64, 1)',
                                'rgba(255, 99, 132, 0.2)',
                                'rgba(54, 162, 235, 0.2)',
                                'rgba(255, 206, 86, 0.2)',
                                'rgba(75, 192, 192, 0.2)',
                                'rgba(153, 102, 255, 0.2)',
                                'rgba(255, 159, 64, 0.2)'
                            ],
                            borderWidth: 1
                        }]
                },
                options: {
                    scales: {
                        yAxes: [{
                                ticks: {
                                    beginAtZero: true
                                }
                            }]
                    }
                }
            });
        </script>
                    
                    
                </td>
            </tr></table>
            <p></p>

 <?
 	$ptbnjrn = mysql_num_rows(mysql_query("SELECT * FROM pegawai WHERE cStatus='PT' AND cBagian3='PABRIK PLANT BANJARAN' "));
 	$pt = mysql_num_rows(mysql_query("SELECT * FROM pegawai WHERE cStatus='PT' AND cBagian3!='PABRIK PLANT BANJARAN' "));
 	$pkwtbnj = mysql_num_rows(mysql_query("SELECT * FROM pegawai WHERE cStatus='PKWT' AND cBagian3='PABRIK PLANT BANJARAN' "));
 	$pkwt = mysql_num_rows(mysql_query("SELECT * FROM pegawai WHERE cStatus='PKWT' AND cBagian3!='PABRIK PLANT BANJARAN'"));
 	$tobnj = mysql_num_rows(mysql_query("SELECT * FROM pegawai WHERE cStatus='TO' AND cBagian3='PABRIK PLANT BANJARAN'"));
 	$to = mysql_num_rows(mysql_query("SELECT * FROM pegawai WHERE cStatus='TO' AND cBagian3!='PABRIK PLANT BANJARAN'"));
?>
   
        <table border=0 width=100%>
            <tr>
                <td>
                     <div class="container">
            <canvas id="myChart4"></canvas>
        </div>
        <script>
            var ctx = document.getElementById("myChart4");
            var myChart4 = new Chart(ctx, {
                type: 'pie',
                data: {
                    labels: ["PT Banjaran (<? echo"$pt"; ?>)", "PT Banjaran (<? echo"$ptbnjrn"; ?>)", "PKWT Banjaran (<? echo"$pkwt"; ?>)", "PKWT Banjaran (<? echo"$pkwtbnj"; ?>)", "TO Banjaran (<? echo"$to"; ?>)", "TO Banjaran (<? echo"$tobnj"; ?>)"],
                    datasets: [{
                            label: 'Jumlah Pegawai Berdasarkan Status',
                            data: [<? echo"$pt"; ?>,<? echo"$ptbnjrn"; ?>, <? echo"$pkwt"; ?>, <? echo"$pkwtbnj"; ?>, <? echo"$to"; ?>,  <? echo"$tobnj"; ?>],
                            
                      <?   /*
                          labels: [<?php while ($b = mysql_fetch_array($memo_ttl)) { echo '"' . $b['bulan'] . '",';}?>],
                          datasets: [{
                            label: '# of Votes',
                         data: [<?php while ($p = mysql_fetch_array($memo_sudah)) { echo '"' . $p['hasil_penjualan'] . '",';}?>],
                         */ ?>
                         
                            backgroundColor: [
                                'rgba(255, 99, 132, 0.2)',
                                'rgba(54, 162, 235, 0.2)',
                                'rgba(255, 206, 86, 0.2)',
                                'rgba(75, 192, 192, 0.2)',
                                'rgba(153, 102, 255, 0.2)',
                                'rgba(255, 159, 64, 0.2)',
                                'rgba(255, 99, 132, 0.2)',
                                'rgba(54, 162, 235, 0.2)',
                                'rgba(255, 206, 86, 0.2)',
                                'rgba(75, 192, 192, 0.2)',
                                'rgba(153, 102, 255, 0.2)',
                                'rgba(255, 159, 64, 0.2)'
                            ],
                            borderColor: [
                                'rgba(255,99,132,1)',
                                'rgba(54, 162, 235, 1)',
                                'rgba(255, 206, 86, 1)',
                                'rgba(75, 192, 192, 1)',
                                'rgba(153, 102, 255, 1)',
                                'rgba(255, 159, 64, 1)',
                                'rgba(255, 99, 132, 0.2)',
                                'rgba(54, 162, 235, 0.2)',
                                'rgba(255, 206, 86, 0.2)',
                                'rgba(75, 192, 192, 0.2)',
                                'rgba(153, 102, 255, 0.2)',
                                'rgba(255, 159, 64, 0.2)'
                            ],
                            borderWidth: 1
                        }]
                },
                options: {
                    scales: {
                        yAxes: [{
                                ticks: {
                                    beginAtZero: true
                                }
                            }]
                    }
                }
            });
        </script>
                    
                    
                </td>
            </tr>
            

            
       </table>
<p></p>
            <p></p>
<? 
/* 
<center><h3>Jumlah Memo Plant Banjaran</h3></center>     
          <table border=0 width=100%>
            <tr>
                <td>
                     <div class="container">
            <canvas id="myChart"></canvas>
        </div>

<?
	$jan = mysql_num_rows(mysql_query("SELECT * FROM sinter WHERE sitgl LIKE '%2019-01%'"));
	$feb = mysql_num_rows(mysql_query("SELECT * FROM sinter WHERE sitgl LIKE '%2019-02%'"));
	$mar = mysql_num_rows(mysql_query("SELECT * FROM sinter WHERE sitgl LIKE '%2019-03%'"));
	$apr = mysql_num_rows(mysql_query("SELECT * FROM sinter WHERE sitgl LIKE '%2019-04%'"));
	$mei = mysql_num_rows(mysql_query("SELECT * FROM sinter WHERE sitgl LIKE '%2019-05%'"));
	$jun = mysql_num_rows(mysql_query("SELECT * FROM sinter WHERE sitgl LIKE '%2019-06%'"));
	$jul = mysql_num_rows(mysql_query("SELECT * FROM sinter WHERE sitgl LIKE '%2019-07%'"));
	$ags = mysql_num_rows(mysql_query("SELECT * FROM sinter WHERE sitgl LIKE '%2019-08%'"));
	$sep = mysql_num_rows(mysql_query("SELECT * FROM sinter WHERE sitgl LIKE '%2019-09%'"));
	$okt = mysql_num_rows(mysql_query("SELECT * FROM sinter WHERE sitgl LIKE '%2019-10%'"));
	$nov = mysql_num_rows(mysql_query("SELECT * FROM sinter WHERE sitgl LIKE '%2019-11%'"));	
?>
        <script>
            var ctx = document.getElementById("myChart");
            var myChart = new Chart(ctx, {
                type: 'line',
                data: {
                    labels: ["Jan", "Feb", "Mar", "Apr", "Mei", "Jun","Jul","Ags","Sep","Okt","Nov"],
                    datasets: [{
                            label: 'Jumlah Memo Tahun 2019',
                            data: [<? echo"$jan"; ?>, <? echo"$feb"; ?>, <? echo"$mar"; ?>, <? echo"$apr"; ?>, <? echo"$mei"; ?>, <? echo"$jun"; ?>, <? echo"$jul"; ?>, <? echo"$jul"; ?>,<? echo"$ags"; ?>,<? echo"$sep"; ?>,<? echo"$okt"; ?>,<? echo"$nov"; ?>],
                            
                         
                            backgroundColor: [
                                'rgba(255, 99, 132, 0.2)',
                                'rgba(54, 162, 235, 0.2)',
                                'rgba(255, 206, 86, 0.2)',
                                'rgba(75, 192, 192, 0.2)',
                                'rgba(153, 102, 255, 0.2)',
                                'rgba(255, 159, 64, 0.2)',
                                'rgba(255, 99, 132, 0.2)',
                                'rgba(54, 162, 235, 0.2)',
                                'rgba(255, 206, 86, 0.2)',
                                'rgba(75, 192, 192, 0.2)',
                                'rgba(153, 102, 255, 0.2)',
                                'rgba(255, 159, 64, 0.2)'
                            ],
                            borderColor: [
                                'rgba(255,99,132,1)',
                                'rgba(54, 162, 235, 1)',
                                'rgba(255, 206, 86, 1)',
                                'rgba(75, 192, 192, 1)',
                                'rgba(153, 102, 255, 1)',
                                'rgba(255, 159, 64, 1)',
                                'rgba(255, 99, 132, 0.2)',
                                'rgba(54, 162, 235, 0.2)',
                                'rgba(255, 206, 86, 0.2)',
                                'rgba(75, 192, 192, 0.2)',
                                'rgba(153, 102, 255, 0.2)',
                                'rgba(255, 159, 64, 0.2)'
                            ],
                            borderWidth: 1
                        }]
                },
                options: {
                    scales: {
                        yAxes: [{
                                ticks: {
                                    beginAtZero: true
                                }
                            }]
                    }
                }
            });
        </script>
                    
                    
                </td>
                                    
            </tr>
       </table>
 <?               
  */
  ?>
       
     
    </body>
</html>