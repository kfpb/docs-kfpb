<?php
require_once "cek_sesi.php";
session_start();
// error_reporting(E_ALL & ~E_NOTICE);
ini_set('display_errors', 0); ini_set('display_startup_errors', 0); error_reporting(0);
include"config/koneksi.php";
// include"config/koneksi_user.php";
include"config/fungsi_indotgl.php";
include "config/fungsi_thumb.php";
include "function.php";

$user = mysql_fetch_array(mysql_query(
    sprintf("SELECT cSession AS session FROM users WHERE cUser = '%s' LIMIT 1", $_SESSION['nppcv'])
));


?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN"
"http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml" lang="en" xml:lang="en">
<head>
    
    <style>
        #chatbot-container {
            position: fixed;
            bottom: 20px;
            right: 20px;
            z-index: 1000; /* Pastikan di atas elemen lain */
        }
        #chat-bubble-button {
            background-color: #4CAF50; /* Hijau */
            color: white;
            border: none;
            border-radius: 50%;
            width: 60px;
            height: 60px;
            font-size: 24px;
            cursor: pointer;
            box-shadow: 0px 4px 8px rgba(0, 0, 0, 0.2);
            display: flex;
            justify-content: center;
            align-items: center;
        }
        #chat-panel {
            display: none; /* Sembunyikan secara default */
            width: 350px;
            height: 450px;
            background-color: white;
            border-radius: 10px;
            box-shadow: 0px 8px 16px rgba(0, 0, 0, 0.2);
            flex-direction: column;
            overflow: hidden;
            margin-top: 10px; /* Jarak antara tombol dan panel */
        }
        #chat-header {
            background-color: #f0f0f0;
            padding: 15px;
            border-bottom: 1px solid #eee;
            font-weight: bold;
            display: flex;
            justify-content: space-between;
            align-items: center;
        }
        #chat-messages {
            flex-grow: 1;
            padding: 15px;
            overflow-y: auto;
            display: flex;
            flex-direction: column;
        }
        .message {
            margin-bottom: 10px;
            padding: 8px 12px;
            border-radius: 15px;
            max-width: 80%;
            word-wrap: break-word;
        }
        .message.user {
            align-self: flex-end;
            background-color: #DCF8C6; /* Hijau muda untuk user */
        }
        .message.bot {
            align-self: flex-start;
            background-color: #E0E0E0; /* Abu-abu muda untuk bot */
        }
        #chat-input-container {
            display: flex;
            padding: 10px;
            border-top: 1px solid #eee;
        }
        #chat-input {
            flex-grow: 1;
            padding: 10px;
            border: 1px solid #ddd;
            border-radius: 20px;
            outline: none;
            margin-right: 10px;
        }
        #send-button {
            background-color: #007BFF; /* Biru */
            color: white;
            border: none;
            border-radius: 20px;
            padding: 10px 15px;
            cursor: pointer;
        }
         /* CSS untuk Animasi Mengetik */
        .typing-indicator {
            display: flex; /* Akan diubah ke 'flex' saat ditampilkan */
            align-items: center;
            justify-content: center;
            margin-bottom: 10px;
            padding: 8px 12px;
            border-radius: 15px;
            background-color: #E0E0E0; /* Warna sama dengan latar belakang pesan bot */
            align-self: flex-start; /* Sejajarkan seperti pesan bot */
            max-width: 80px; /* Lebar kecil untuk indikator */
            order: 999;
        }
        .typing-indicator span {
            width: 8px;
            height: 8px;
            margin: 0 2px;
            background-color: #666; /* Warna titik */
            border-radius: 50%;
            opacity: 0.4;
            animation: bounce 1s infinite ease-in-out; /* Animasi bouncing */
        }
        .typing-indicator span:nth-child(2) {
            animation-delay: 0.2s; /* Delay untuk titik kedua */
        }
        .typing-indicator span:nth-child(3) {
            animation-delay: 0.4s; /* Delay untuk titik ketiga */
        }
        @keyframes bounce {
            0%, 100% {
                transform: translateY(0);
                opacity: 0.4;
            }
            50% {
                transform: translateY(-5px); /* Titik memantul ke atas */
                opacity: 1;
            }
        }
    </style>
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1" />
<title>Document Control Assistance System - PT. Kimia Farma (Persero) Tbk. Plant Banjaran</title>
<!-- Bootstrap -->
    <link rel="icon" href="https://docs.kfpb.kimiafarma.co.id/files.png" type="image/x-icon">
        <link href="bootstrap/css/bootstrap.min.css" rel="stylesheet" media="screen">
        <link href="bootstrap/css/bootstrap-responsive.min.css" rel="stylesheet" media="screen">
        <link href="assets/styles.css" rel="stylesheet" media="screen">
        <!--<link href="https://thread.kfpb.kimiafarma.co.id/floating.css" rel="stylesheet" type="text/css">-->
        <script language="javascript" type="text/javascript" src="vendors/flot/excanvas.min.js"></script>
        <!-- HTML5 shim, for IE6-8 support of HTML5 elements -->
        <!--[if lt IE 9]>-->
            <script src="http://html5shim.googlecode.com/svn/trunk/html5.js"></script>
        <!--<![endif]-->
        <script src="vendors/modernizr-2.6.2-respond-1.1.0.min.js"></script>
		
		<link href="vendors/jGrowl/jquery.jgrowl.css" rel="stylesheet" media="screen">
        <link href="assets/DT_bootstrap.css" rel="stylesheet" media="screen">
        
<link rel="stylesheet" href="//code.jquery.com/ui/1.12.1/themes/base/jquery-ui.css">
	  	<script src="https://code.jquery.com/jquery-1.12.4.js"></script>
	  	<script src="https://code.jquery.com/ui/1.12.1/jquery-ui.js"></script>
	  	<script>
	  		$( function() {
	   			$( "#tgl_slesai" ).datepicker({
	   				minDate: 0
	   			});
	  		});
	  	</script>
	<script src="ckeditor/ckeditor.js"></script>
	<script src="ckeditor/js/sample.js"></script>
	<link rel="stylesheet" href="ckeditor/toolbarconfigurator/lib/codemirror/neo.css">


<script type="text/javascript" src="vendors/jquery-1.9.1.js"></script>
<link rel="stylesheet" type="text/css" href="vendors/chosen.css"">
<script type="text/javascript" src="vendors/chosen.jquery.js"></script>
    
<script type='text/javascript'>
$(window).load(function(){
$('select').chosen({width: "300px"});

$('.chosen-toggle').each(function(index) {
console.log(index);
    $(this).on('click', function(){
    console.log($(this).parent().find('option').text());
         $(this).parent().find('option').prop('selected', $(this).hasClass('select')).parent().trigger('chosen:updated');
    });
});
});//]]> 

</script>
	
<script type="text/javascript">
function validasi_input(form){
 if (form.jenisms.value =="0"){
    alert("Anda belum pilih jenis memo/undangan!");
    return (false);
 }  
return (true);
}
</script>	
	<link rel="stylesheet" href="https://cdn.datatables.net/1.10.23/css/jquery.dataTables.min.css">
</head>
<body>
<!-- batas panel atas-->
<div class="navbar navbar-fixed-top">
	<div class="navbar-inner">
    	<div class="container-fluid">
        	<a class="btn btn-navbar" data-toggle="collapse" data-target=".nav-collapse"> 
            	<span class="icon-bar"></span>
                <span class="icon-bar"></span>
                <span class="icon-bar"></span>
			</a>
			<a class="brand" href="home.php?pages=home">Document Control Assistance System - Kimia Farma Plant Banjaran </a>
	        <div class="nav-collapse collapse">
	            <ul class="nav pull-right">
	                <li class="dropdown">
	                <?php 
	                
                      
                      $waktu=gmdate("H:i",time()+7*3600);
                        $t=explode(":",$waktu);
                        $jam=$t[0];
                        $menit=$t[1];
                        
                        if ($jam >= 00 and $jam < 10 ){
                            if ($menit >00 and $menit<60){
                                $ucapan="Selamat Pagi";
                            }
                        }else if ($jam >= 10 and $jam < 15 ){
                            if ($menit >00 and $menit<60){
                                $ucapan="Selamat Siang";
                            }
                        }else if ($jam >= 15 and $jam < 18 ){
                            if ($menit >00 and $menit<60){
                                $ucapan="Selamat Sore";
                            }
                        }else if ($jam >= 18 and $jam <= 24 ){
                            if ($menit >00 and $menit<60){
                                $ucapan="Selamat Malam";
                            }
                        }else {
                            $ucapan="Hallo";
                        
                        }
                
	                ?>
                    	<a href="#" role="button" class="dropdown-toggle" data-toggle="dropdown">
                        	<i class="icon-time"></i> <small id="time"></small> | <i class="icon-user"></i> <small><?php echo $ucapan ?>, <b><?php echo $_SESSION[namacv];?></b></small> <i class="caret"></i>
                        </a>
                        <ul class="dropdown-menu">
                        <?php if($_SESSION[cv]=='1103' OR $_SESSION[cv]=='1104') {?>
                        
                        <?php }else{ ?>
                        <li>
                        	<a tabindex="-1" href="home.php?pages=users&act=edit&id=<?php echo $_SESSION[cv];?>">Rubah Profil/ Password</a>
						</li>
						
                        <?php } ?>
						<!-- <li>-->
      <!--                  	<a tabindex="-1" href="http://kfpb.kimiafarma.co.id/">Manual Book</a>-->
						<!--</li>-->
                        <li><a tabindex="-1" href="logout.php">Keluar Aplikasi</a></li>
                        </ul>
                   </li>
                </ul>
            </div>
            
            	  
           
           <div class="nav-collapse collapse">
	            <ul class="nav pull-right">
	                 <li class="dropdown">
                    	<!--<a href="home3.php">-->
                     <!--   Hide Menu-->
                     <!--   </a>-->
                    
                     
                        </ul>
                   </li>
                </ul>
            </div>
            
        </div>
    </div>
</div>
<!-- batas panel atas-->

<div class="container-fluid"><!-- container-fluid-->
	<div class="row-fluid">
	<!--batas side bar (kiri)-->
	<div class="span3" id="sidebar"><!--span2-->
        <ul class="nav nav-list bs-docs-sidenav nav-collapse collapse">
			<div class="navbar navbar-inner block-header">
		    <center>
			
			<img src="images/logo.png" />
			<h5 align="center">Document Control Assistance System</h5>        
			</center>
		    </div>
        </ul>
			
			<ul class="nav nav-list bs-docs-sidenav nav-collapse collapse">
				<a href='?pages=home'>
				<div class="navbar navbar-inner block-header">
					<div class="muted pull-left"><i class='icon-home'></i><font color=black> Beranda/Dashboard</font></div>
				</div>
				</a>
			</ul>
				<?	/*
				<ul class="nav nav-list bs-docs-sidenav nav-collapse collapse">
				<a href='home.php?pages=users&act=edit&id=<?php echo $_SESSION[cv];?>'>
				<div class="navbar navbar-inner block-header">
					<div class="muted pull-left"><i class='icon-user'></i><font color=black> Profil</font></div>
				</div>
				</a>
			</ul>
			*/ ?>
					
        <?php
//admin		
			if ($_SESSION[cv]==1000){
				include "menumaster.php";
				include "menuregdok.php";
				// include "menuregusulan.php";
				// include "menusurateksternal.php";
				// include "menusuratinternal.php";	
				include "menulaporan.php";

				
			}
			
            $sqlteknik = mysql_query("SELECT * FROM users WHERE cId='$_SESSION[cv]' AND bagian2='PTK'");
            $usrteknik = @mysql_num_rows($sqlteknik);
// SPD		
			if ($_SESSION[cv]==1 OR $_SESSION[cv]==53 OR $_SESSION[cv]==81 OR $_SESSION[cv]==55 OR $_SESSION[cv]==1051 OR $_SESSION[cv]==1054 OR $_SESSION[cv]==1055 OR $_SESSION[cv]==1056 OR $_SESSION[cv]==1057 OR $_SESSION[cv]==1058 OR $_SESSION[cv]==1052 OR $_SESSION[cv]==99 OR $_SESSION[cv]==1060 OR $_SESSION[cv]==1059 OR $_SESSION[cv]==50){
				include "menuregdok.php";
				// include "menuusr.php";
				
			}
			if ($_SESSION[cv]==1103 OR $_SESSION[cv]==1104 OR $_SESSION[cv]==1107 OR $_SESSION[cv]==1108){
				include "menuregdok.php";
				
			}
//sekretaris dan sekretariat PKL			
			elseif ($_SESSION[cv]==79){
			    //include "menunotif.php";
        			    //   include "menusurateksternal.php";
        			    //   include "menuoffice.php";
    				    // include "menulaporan.php";
				include "menuusr.php";
			
			}
			//menu teknik
			elseif($_SESSION[cv]=='10' OR $_SESSION[cv]=='11' or $_SESSION[cv]=='12' or $_SESSION[cv]=='13' or $_SESSION[cv]=='14' or $_SESSION[cv]=='15' or $_SESSION[cv]=='16' or $_SESSION[cv]=='17' or $_SESSION[cv]=='18' or $_SESSION[cv]=='19' or $_SESSION[cv]=='20' or $_SESSION[cv]=='21' or $_SESSION[cv]=='80'){
			            //   include "menuteknik.php";
				include "menuusr.php";

			}
			elseif($usrteknik > 0){
			    
			            //   include "menuteknik.php";
				include "menuusr.php";
			    
			}else{
				include "menuusr.php";
			}
		?>
    </div><!--/span2-->
	<!--batas side bar (kiri)-->
                
	<!--batas konten (kanan)-->
    <div class="span9"><!--span10-->
        <div class="row-fluid">
		    <div class="span12" id="content">
		        <div class="row-fluid">
		            <div class="block"><!-- block -->
                    <?php
						if($_GET[pages]=="users"){
							include"include/users/users.php";	//admin untuk kelola user
						}elseif($_GET[pages]=="pegawai"){
							include"include/pegawai/pegawai.php";	//pegawai
						}elseif($_GET[pages]=="dokint"){
							include"include/mod_dokumen/dokumen.php";	//admin dan user untuk reg dokumen internal
						}elseif($_GET[pages]=="dokint1"){
							include"include/mod_dokumen/aksi_dokumen.php";	//admin dan user untuk reg dokumen internal
						}elseif($_GET[pages]=="reviewdok"){
							include"include/mod_dokumen/reviewdokumen.php";	//admin dan user untuk review dokumen internal	
						}elseif($_GET[pages]=="sarmut"){
							include"include/mod_sarmut/sarmut.php";	//admin dan user untuk sasaran mutu dan KPI	
						}elseif($_GET[pages]=="dokeks"){
							include"include/mod_dokest/dokest.php";	//admin reg dokumen eksternal lama
						}elseif($_GET[pages]=="ccinter"){
							include"include/ccinter/ccinter.php";	//admin, admin CC untuk kelola manual CC
						}elseif($_GET[pages]=="ccinter0"){
							include"include/ccinter/ccinter0.php";	//admin, admin CC untuk kelola manual CC
						}elseif($_GET[pages]=="rtcc"){
							include"rtcc.php";	//admin dan user untuk kelola rencana tindakan CC
						}elseif($_GET[pages]=="usrcc"){
							include"usrcc.php";	//admin dan user untuk kelola ACC CC
						}elseif($_GET[pages]=="usracc"){
							include"usracc.php";	//admin dan user untuk kelola ACC CC MPM	
							
						}elseif($_GET[pages]=="ncinter"){
							include"include/ncinter/ncinter.php";	//admin
						}elseif($_GET[pages]=="ncinter0"){
							include"include/ncinter/ncinter0.php";	//admin
						}elseif($_GET[pages]=="rtnc"){
							include"rtnc.php";	//admin dan user untuk kelola rencana tindakan NC
						}elseif($_GET[pages]=="usrnc"){
							include"usrnc.php";	//admin dan user untuk kelola ACC NC
						}elseif($_GET[pages]=="usrncc"){
							include"usranc.php";	//admin dan user untuk kelola ACC NC MPM		
							
							
						}elseif($_GET[pages]=="upd"){
							include"include/mod_upd/upd.php";	//admin reg upd internal lama
						}elseif($_GET[pages]=="usulandok"){
							include"include/duin/duin.php";	//admin untuk reg usulan 
						}elseif($_GET[pages]=="usulandokumen"){
							include"include/duin/duin_usulan.php";	//admin untuk reg usulan 
						}elseif($_GET[pages]=="usulandok2"){
							include"include/duin/duin2.php";	//admin untuk reg usulan 
	                    }elseif($_GET[pages]=="usulandok3"){
							include"include/duin/duin3.php";	//admin untuk reg usulan 
						}elseif($_GET[pages]=="cchl"){
							include"include/mod_cchl/cchl.php";	//admin untuk kelola CCHL lama
						}elseif($_GET[pages]=="jendok"){
							include"include/mod_jendok/jendok.php";	//admin	untuk kelola jenis dokumen			
						}elseif($_GET[pages]=="jabatan"){
							include"include/jabatan/jabatan.php";	//admin untuk kelola level dokumen
						}elseif($_GET[pages]=="jenisms"){
							include"include/jenisms/jenisms.php";	//admin untuk kelola level dokumen	
						}elseif($_GET[pages]=="suin"){
							include"include/suin/suin.php";			//surat masuk
						}elseif($_GET[pages]=="suin2"){
							include"include/suin2/suin.php";			//sumber tugas
						}elseif($_GET[pages]=="ruin"){
							include"include/ruin/ruin.php";			//sumber reminder
						}elseif($_GET[pages]=="suin3"){
							include"include/suin3/suin.php";			//note
						}elseif($_GET[pages]=="tuin"){
							include"include/tuin/tuin.php";			//admin untuk kelola tela'ahan
						}elseif($_GET[pages]=="sout"){
							include"include/sout/sout.php";			//admin untuk kelola laporan/ permohonan copy dokumen
						}elseif($_GET[pages]=="copy"){
							include"include/copy/sout.php";			//admin untuk kelola laporan/ permohonan copy dokumen
						}elseif($_GET[pages]=="linter"){
							include"include/linter/linter.php";		//ATK
						}elseif($_GET[pages]=="minter"){
							include"include/minter/minter.php";		//mutasi sementara
						}elseif($_GET[pages]=="sinter"){
							include"include/sinter/sinter.php";		//admin untuk kelola memo/undangan internal
						}elseif($_GET[pages]=="sintertp"){
							include"include/spptek/sintertp.php";		//admin untuk kelola spptek
						}elseif($_GET[pages]=="barangtek"){
							include"include/spptek/barangtek.php";		//admin untuk kelola spptek Barang teknik
						}elseif($_GET[pages]=="approvebarangtek"){
							include"include/spptek/approve_pesanbarang.php";		//admin untuk kelola Approve Barang teknik
						}elseif($_GET[pages]=="pesananbarangtek"){
							include"include/spptek/pesanan_barangtek.php";		//untuk kelola pesanan Barang teknik
						}elseif($_GET[pages]=="sinterit"){
							include"include/sinter/sinterit.php";		//admin untuk kelola tiket IT
						}elseif($_GET[pages]=="sinterm"){
							include"include/sinter/sinterm.php";		//admin untuk memo pr
						}elseif($_GET[pages]=="sinterm1"){
							include"include/sinter/sinterm1.php";		//admin untuk memo pr all
						}elseif($_GET[pages]=="dinter"){
							include"include/dinter/dinter.php";		//admin untuk kelola dokumen internal
					
						}elseif($_GET[pages]=="dinterebr"){
							include"include/copy_ebr/dinter_ebr.php";		//admin untuk kelola dokumen internal
						}
						elseif($_GET[pages]=="tambahpermintaanebr"){
							include"include/copy_ebr/tambahcopy_ebr.php";		//admin untuk kelola dokumen internal
						}
						elseif($_GET[pages]=="detailpermintaanebr"){
							include"include/copy_ebr/detail_ebr.php";		//admin untuk kelola dokumen internal
						}
						elseif($_GET[pages]=="dintercari"){
							include"include/dinter/dinter_cari.php";		//admin untuk kelola dokumen internal cari	
						}elseif($_GET[pages]=="dinterfind"){
							include"include/dinter/dinter_find.php";		//admin untuk kelola dokumen internal cari
						}elseif($_GET[pages]=="dister"){
							include"include/dister/dister.php";		//admin untuk kelola distribusi dokumen terkendali
						}elseif($_GET[pages]=="dester"){
							include"include/dester/dester.php";		//admin untuk kelola distribusi dokumen terkendali
						}elseif($_GET[pages]=="dointer"){
							include"include/dointer/dointer.php";		//admin untuk kelola sosialisasi dokumen MK3L
						}elseif($_GET[pages]=="rall"){
							include"include/rall/rall.php";			//admin untuk buat laporan
						}elseif($_GET[pages]=="rsuin"){
							include"include/rsuin/rsuin.php";		//admin untuk buat laporan surat masuk internal
						}elseif($_GET[pages]=="rsout"){
							include"include/rsout/rsout.php";		//admin untuk buat laporan surat keluar eksternal
						}elseif($_GET[pages]=="usrte3"){
							include"usrte3.php";
						}elseif($_GET[pages]=="usrtes"){
							include"usrtes.php";						//other untuk user surat tugas
						}elseif($_GET[pages]=="usrrm"){
							include"usrrm.php";						//other untuk reminder/
						}elseif($_GET[pages]=="usrtes2"){
							include"usrtes2.php";						//other untuk user note
						}elseif($_GET[pages]=="usrtes3"){
							include"usrtes3.php";						//other untuk daftar note 
						}elseif($_GET[pages]=="usrte"){
							include"usrte.php";						//untuk surat masuk eksternal
						}elseif($_GET[pages]=="usrtl"){
							include"usrtl.php";						//other untuk telaahan
						}elseif($_GET[pages]=="usrtls"){
							include"usrtls.php";						//other untuk telaahan selesai
						}elseif($_GET[pages]=="usrt"){
							include"usrt.php";						//other untuk user memo internal
						}elseif($_GET[pages]=="usrl"){
							include"usrl.php";
						}elseif($_GET[pages]=="usrm"){
							include"usrm.php";	
						}elseif($_GET[pages]=="usrti"){
							include"usrti.php";	
						}elseif($_GET[pages]=="usrtp"){
							include"usrtp.php";
						}elseif($_GET[pages]=="usrtpl"){
							include"usrtpl.php";	
						}elseif($_GET[pages]=="usrtpp"){
							include"usrtpp.php";	
						}elseif($_GET[pages]=="usrtm"){
							include"usrtm.php";	
						}elseif($_GET[pages]=="usrtm1"){
							include"usrtm1.php";	
						}elseif($_GET[pages]=="usrtt"){
							include"usrtt.php";						//other untuk user tembusan memo masuk internal
						}elseif($_GET[pages]=="usrtd"){
							include"usrtd.php";						//other untuk user usulan dokumen
						}elseif($_GET[pages]=="rsi"){
							include"include/rsi/rsi.php";		//other admin dan user laporan
						}elseif($_GET[pages]=="rdi"){
							include"include/rdi/rdi.php";		//other admin dan user laporan
						}elseif($_GET[pages]=="udok"){
							include"udokumen.php";				//other untuk user lihat alur usulan dok kirim kembali
						}elseif($_GET[pages]=="usrd"){
							include"usrd.php";				   //other untuk user lihat distribusi dokumen terkendali
						}elseif($_GET[pages]=="usrdin"){
							include"usrdin.php";				   //dokumen internal
						}elseif($_GET[pages]=="usrdek"){
							include"usrdek.php";				   //dokumen eksternal
						}elseif($_GET[pages]=="usrdrvw_admin"){
							include"usrdrvw_admin.php";				   //review dokumen admin
						}elseif($_GET[pages]=="usrdrvw_admin2"){
							include"usrdrvw_admin2.php";				   //review dokumen admin	
						}elseif($_GET[pages]=="usrdrvw"){
							include"usrdrvw.php";				   //review dokumen
						}elseif($_GET[pages]=="ussd"){
							include"ussd.php";				   //other untuk user lihat sosialisasi dokumen MK3L
						}elseif($_GET[pages]=="udis2"){
							include"udisposisi2.php";				//other untuk user lihat disposisi tugas capa 
						}elseif($_GET[pages]=="udremind"){
							include"udremind.php";				//other untuk user lihat reminder
						}elseif($_GET[pages]=="udremind1"){
							include"udremind1.php";				//other untuk user lihat reminder 1 bulan
						}elseif($_GET[pages]=="udremind6"){
							include"udremind6.php";				//other untuk user lihat reminder 6 bulan
						}elseif($_GET[pages]=="udremind2"){
							include"udremind2.php";				//other untuk user lihat reminder all
						}elseif($_GET[pages]=="udremind4"){
							include"udremind4.php";				//other untuk user lihat reminder pelatihan
						}elseif($_GET[pages]=="udremind44"){
							include"udremind44.php";				//other untuk user lihat reminder pelatihan
						}elseif($_GET[pages]=="udis3"){
							include"udisposisi3.php";				//other untuk user lihat Agenda note
						}elseif($_GET[pages]=="udis4"){
							include"udisposisi4.php";				//other all capa
						}elseif($_GET[pages]=="udis"){
							include"udisposisi.php";				//other untuk user lihat disposisi
						}elseif($_GET[pages]=="ldis"){
							include"ldisposisi.php";				//other untuk user lihat disposisi hasil lembur
						}elseif($_GET[pages]=="ddis"){
							include"udisposisidok.php";				//other untuk user lihat disposisi dok/ info dok
						}elseif($_GET[pages]=="ddis2"){
							include"udisposisidok2.php";				//other untuk user lihat disposisi dok/ info 
						}elseif($_GET[pages]=="ddist"){
							include"udistribusidok.php";				//other untuk user lihat info dokumen
						}elseif($_GET[pages]=="ddist2"){
							include"udistribusidok2.php";				//other untuk user lihat info dokumen
						}elseif($_GET[pages]=="utis"){
							include"utisposisi.php";				//other telaahan untuk user lihat tela'ahan
						}elseif($_GET[pages]=="pkl"){
							include"pkl.php";				//other PKL
						}elseif($_GET[pages]=="mobil"){
							include"mobil.php";				//other Mobil
						}elseif($_GET[pages]=="pelulusan"){
							include"pelulusan.php";				//other pelulusan
						}elseif($_GET[pages]=="note"){
							include"include/hal_notulen/notulen.php";	
						}elseif($_GET[pages]=="esdm"){
							include"esdm.php";				//other esdm
						}elseif($_GET[pages]=="aktiva"){
							include"include/aktiva/aktiva.php";				//aktiva
						}elseif($_GET[pages]=="riwayat"){
							include"include/riwayat/riwayat.php";				//riwayat
						}elseif($_GET[pages]=="area"){
							include"include/area/area.php";				//area ruangan
                    	}elseif($_GET[pages]=="atk"){
							include"include/atk/atk.php";				//area ruangan
						}elseif($_GET[pages]=="reminder"){
							include"include/reminder/hslreminder.php";				//
						}elseif($_GET[pages]=="data_reminder"){
							include"include/reminder/reminder.php";				//
						}elseif($_GET[pages]=="pemeliharaan"){
							include"include/pemeliharaan/pemeliharaan.php";				//area ruangan
						}elseif($_GET[pages]=="aktivitas_dokumen"){
						    include"include/aktivitas_docs/index.php";
						}elseif($_GET[pages]=="aktivitas_login"){
						    include"include/aktivitas_docs/loguser.php";
						}elseif($_GET[pages]=="update_data_masal"){         // untuk update data masal
						    include"include/inputdatamasal.php";
						
						}elseif($_GET[pages]=="chatbot"){         // untuk update data masal
						    include"chatapi.php";
						}
						else{
							include"welcome.php";			//user + admin
						}
					?>  
		            </div><!-- /block -->
		        </div>
		    </div>
        </div>
    </div><!--/span10-->
	<!--batas konten (kanan)-->
    </div><!--/row fluid-->
	<hr>
	<!--batas footer -->
	<footer>
        <p>
			Copyright &copy; <?php echo date('Y'); ?> | <b>QA Pengendalian Sistem</b><br />
			<a href="http://www.kimiafarma.co.id"><strong>PT. Kimia Farma</strong></a> <a href="http://www.kfpb.kimiafarma.co.id">Plant Banjaran</a>
			
		</p>
    </footer>
	<!--batas footer -->
</div><!-- /container-fluid-->

<div id="chatbot-container">
        <button id="chat-bubble-button">💬</button>
        <div id="chat-panel">
            <div id="chat-header">
                Chat dengan Asisten AI TIM QA Pengembangan Sistem
                <button id="close-chat-button" style="background: none; border: none; font-size: 20px; cursor: pointer;">&times;</button>
            </div>
            <div id="chat-messages">
                <div id="typing-indicator" class="typing-indicator" style="display: none;">
                    <span></span>
                    <span></span>
                    <span></span>
                </div>
            </div>
            <div id="chat-input-container">
                <input type="text" id="chat-input" placeholder="Ketik pesan Anda...">
                <button id="send-button">Kirim</button>
            </div>
        </div>
    </div>

</div><link href="vendors/datepicker.css" rel="stylesheet" media="screen">
<link href="vendors/uniform.default.css" rel="stylesheet" media="screen">
<link href="vendors/wysiwyg/bootstrap-wysihtml5.css" rel="stylesheet" media="screen">
<script src="bootstrap/js/bootstrap.min.js"></script>
<script src="vendors/jquery.uniform.min.js"></script>
<script src="vendors/bootstrap-datepicker.js"></script>
<script src="vendors/wysiwyg/wysihtml5-0.3.0.js"></script>
<script src="vendors/wysiwyg/bootstrap-wysihtml5.js"></script>
<script src="vendors/wizard/jquery.bootstrap.wizard.min.js"></script>
<script src="assets/scripts.js"></script>

<script src="vendors/jGrowl/jquery.jgrowl.js"></script>
<script src="vendors/datatables/js/jquery.dataTables.min.js"></script>
<script src="assets/DT_bootstrap.js"></script>
<script src="ckeditor/ckeditor.js"></script> <script src="ckeditor/js/sample.js"></script>
<script src="https://cdn.jsdelivr.net/npm/marked/marked.min.js"></script>

<script>
    // Kode JavaScript aplikasi Anda yang sudah ada, dibungkus dalam $(function(){});
    // Ini adalah shorthand untuk $(document).ready(function(){});
    $(function(){
        // FUNGSI UTAMA APLIKASI ANDA YANG LAIN
        $(".datepicker").datepicker();
        $(".uniform_on").uniform();
        $(".chzn-select").chosen();
        $('.textarea').wysihtml5();
        
        $('.tooltip').tooltip();    
        $('.tooltip-left').tooltip({ placement: 'left' });  
        $('.tooltip-right').tooltip({ placement: 'right' });    
        $('.tooltip-top').tooltip({ placement: 'top' });    
        $('.tooltip-bottom').tooltip({ placement: 'bottom' });

        $('.popover-left').popover({placement: 'left', trigger: 'hover'});
        $('.popover-right').popover({placement: 'right', trigger: 'hover'});
        $('.popover-top').popover({placement: 'top', trigger: 'hover'});
        $('.popover-bottom').popover({placement: 'bottom', trigger: 'hover'});
        
        $('#rootwizard').bootstrapWizard({onTabShow: function(tab, navigation, index) {
            var $total = navigation.find('li').length;
            var $current = index+1;
            var $percent = ($current/$total) * 100;
            $('#rootwizard').find('.bar').css({width:$percent+'%'});
            if($current >= $total) {
                $('#rootwizard').find('.pager .next').hide();
                $('#rootwizard').find('.pager .finish').show();
                $('#rootwizard').find('.pager .finish').removeClass('disabled');
            } else {
                $('#rootwizard').find('.pager .next').show();
                $('#rootwizard').find('.pager .finish').hide();
            }
        }});
        $('#rootwizard .finish').click(function() {
            alert('Finished!, Starting over!');
            $('#rootwizard').find("a[href*='tab1']").trigger('click');
        });

        // Update Time Function (tetap di sini)
        var timestamp = '<?=time();?>';
        function updateTime(){
            const formattedDate = new Date(timestamp * 1000).toLocaleString(); // Gunakan new Date() dan kalikan timestamp dengan 1000 untuk milidetik
            const trimmedDate = formattedDate.slice(0, formattedDate.length - 34); // Sesuaikan ini jika formatnya berbeda
            $('#time').html(trimmedDate);
            timestamp++;
        }
        setInterval(updateTime, 1000);
    });

    // Kode JavaScript KHUSUS UNTUK CHATBOT (tempatkan di luar $(function(){}) jika Anda ingin variabel global,
    // atau di dalamnya jika hanya digunakan di sana, tapi pastikan didefinisikan sebelum digunakan)

    // Definisikan elemen DOM chatbot
    const chatBubbleButton = document.getElementById('chat-bubble-button');
    const chatPanel = document.getElementById('chat-panel');
    const closeChatButton = document.getElementById('close-chat-button');
    const chatMessages = document.getElementById('chat-messages');
    const chatInput = document.getElementById('chat-input');
    const sendButton = document.getElementById('send-button');
    const typingIndicator = document.getElementById('typing-indicator');
    // URL backend PHP Anda (file chat_api.php)
    const CHAT_API_ENDPOINT = 'include/api/chatapi.php'; // Sesuaikan path ini jika chat_api.php tidak di direktori yang sama

    let isChatPanelOpen = false;

    // Fungsi untuk menambah pesan ke tampilan chat
    function addMessage(text, sender) {
        const messageDiv = document.createElement('div');
        messageDiv.classList.add('message', sender);
    
        // GUNAKAN MARKED.PARSE() UNTUK MERENDER MARKDOWN KE HTML
        messageDiv.innerHTML = marked.parse(text); 
    
        chatMessages.appendChild(messageDiv);
        chatMessages.scrollTop = chatMessages.scrollHeight; // Gulir otomatis ke bawah
    }

    // Fungsi untuk mengirim pesan
    async function sendMessage() {
        const message = chatInput.value.trim();
        chatMessages.appendChild(typingIndicator);
        if (message === '') return;

        addMessage(message, 'user');
        chatInput.value = ''; // Hapus input
        
        typingIndicator.style.display = 'flex'; // <-- TAMBAHKAN INI
        chatMessages.scrollTop = chatMessages.scrollHeight;
        try {
            const response = await fetch(CHAT_API_ENDPOINT, {
                method: 'POST',
                headers: {
                    'Content-Type': 'application/json'
                },
                body: JSON.stringify({ message: message })
            });
            typingIndicator.style.display = 'none'; 
            if (!response.ok) {
                const errorData = await response.json();
                throw new Error(`HTTP error! status: ${response.status} - ${errorData.error || 'Unknown error'}`);
            }

            const data = await response.json();
            addMessage(data.reply, 'bot');

        } catch (error) {
            typingIndicator.style.display = 'none';
            console.error('Error sending message:', error);
            addMessage('Maaf, terjadi kesalahan. Silakan coba lagi.', 'bot');
        }
    }

    // Event Listeners (Pastikan ini terlampir setelah elemen ditemukan)
    // Disarankan untuk membungkus ini dalam DOMContentLoaded atau $(document).ready() juga
    // agar yakin semua elemen HTML sudah tersedia.
    document.addEventListener('DOMContentLoaded', function() {
        chatBubbleButton.addEventListener('click', () => {
            isChatPanelOpen = !isChatPanelOpen;
            chatPanel.style.display = isChatPanelOpen ? 'flex' : 'none';
            if (isChatPanelOpen) {
                chatInput.focus();
            }
        });

        closeChatButton.addEventListener('click', () => {
            isChatPanelOpen = false;
            chatPanel.style.display = 'none';
        });

        sendButton.addEventListener('click', sendMessage);
        chatInput.addEventListener('keypress', (e) => {
            if (e.key === 'Enter') {
                sendMessage();
            }
        });

        // Pesan selamat datang awal dari bot
        addMessage('Halo! Ada yang bisa saya bantu mengenai aplikasi ini ? atau mengenai hal lain', 'bot');
    });

</script>

<script>
	initSample(); // Ini adalah fungsi CKEditor, tetap di sini
</script>

</body>
</html>