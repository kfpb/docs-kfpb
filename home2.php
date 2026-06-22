<?php
require_once "cek_sesi.php";
session_start();
error_reporting(E_ERROR);
include"config/koneksi.php";
include"config/fungsi_indotgl.php";
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN"
"http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml" lang="en" xml:lang="en">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1" />
<title>Aplikasi E-kfpb - PT. Kimia Farma (Persero) Tbk. Plant Banjaran</title>
<!-- Bootstrap -->
        <link href="bootstrap/css/bootstrap.min.css" rel="stylesheet" media="screen">
        <link href="bootstrap/css/bootstrap-responsive.min.css" rel="stylesheet" media="screen">
        <link href="assets/styles.css" rel="stylesheet" media="screen">
        <!--[if lte IE 8]><script language="javascript" type="text/javascript" src="vendors/flot/excanvas.min.js"></script><![endif]-->
        <!-- HTML5 shim, for IE6-8 support of HTML5 elements -->
        <!--[if lt IE 9]>
            <script src="http://html5shim.googlecode.com/svn/trunk/html5.js"></script>
        <![endif]-->
        <script src="vendors/modernizr-2.6.2-respond-1.1.0.min.js"></script>
		
		<link href="vendors/jGrowl/jquery.jgrowl.css" rel="stylesheet" media="screen">
        <link href="assets/DT_bootstrap.css" rel="stylesheet" media="screen">

	<script src="ckeditor/ckeditor.js"></script>
	<script src="ckeditor/js/sample.js"></script>
	<link rel="stylesheet" href="ckeditor/toolbarconfigurator/lib/codemirror/neo.css">
	
</head>
<body>
<?
/*$namaFile = "export.xls";
header("Pragma: public");
header("Expires: 0");
header("Cache-Control: must-revalidate, post-check=0, pre-check=0");
header("Content-Type: application/force-download");
header("Content-Type: application/octet-stream");
header("Content-Type: application/download");
header("Content-Disposition: attachment; filename=$namaFile");
header("Content-Transfer-Encoding: binary ");
*/
header("Content-type: application/vnd-ms-excel");
header("Content-Disposition: attachment; filename=Data_Export.xls");

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
						}elseif($_GET[pages]=="upd"){
							include"include/mod_upd/upd.php";	//admin reg upd internal lama
						}elseif($_GET[pages]=="usulandok"){
							include"include/duin/duin.php";	//admin untuk reg usulan 
						}elseif($_GET[pages]=="usulandok2"){
							include"include/duin/duin2.php";	//admin untuk reg usulan 
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
						}elseif($_GET[pages]=="suin3"){
							include"include/suin3/suin.php";			//note
						}elseif($_GET[pages]=="tuin"){
							include"include/tuin/tuin.php";			//admin untuk kelola tela'ahan
						}elseif($_GET[pages]=="sout"){
							include"include/sout/sout.php";			//admin untuk kelola laporan/ permohonan copy dokumen
						}elseif($_GET[pages]=="copy"){
							include"include/copy/sout.php";			//admin untuk kelola laporan/ permohonan copy dokumen
						}elseif($_GET[pages]=="linter"){
							include"include/linter/linter.php";		//lembur
						}elseif($_GET[pages]=="sinter"){
							include"include/sinter/sinter.php";		//admin untuk kelola memo/undangan internal
						}elseif($_GET[pages]=="sintertp"){
							include"include/sinter/sintertp.php";		//admin untuk kelola spptek
						}elseif($_GET[pages]=="sinterm"){
							include"include/sinter/sinterm.php";		//admin untuk memo pr
						}elseif($_GET[pages]=="dinter"){
							include"include/dinter/dinter.php";		//admin untuk kelola distribusi dokumen terkendali
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
						}elseif($_GET[pages]=="usrtp"){
							include"usrtp.php";	
						}elseif($_GET[pages]=="usrtpp"){
							include"usrtpp.php";	
						}elseif($_GET[pages]=="usrtm"){
							include"usrtm.php";	
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
						}elseif($_GET[pages]=="udis2"){
							include"udisposisi2.php";				//other untuk user lihat disposisi tugas capa 
						}elseif($_GET[pages]=="udis3"){
							include"udisposisi3.php";				//other untuk user lihat Agenda note
						}elseif($_GET[pages]=="udis"){
							include"udisposisi.php";				//other untuk user lihat disposisi
						}elseif($_GET[pages]=="ldis"){
							include"ldisposisi.php";				//other untuk user lihat disposisi hasil lembur
						}elseif($_GET[pages]=="ddis"){
							include"udisposisidok.php";				//other untuk user lihat disposisi dok/ info dok
						}elseif($_GET[pages]=="utis"){
							include"utisposisi.php";				//other telaahan untuk user lihat tela'ahan
						}elseif($_GET[pages]=="pkl"){
							include"pkl.php";				//other PKL
						}elseif($_GET[pages]=="pelulusan"){
							include"pelulusan.php";				//other pelulusan
						}elseif($_GET[pages]=="note"){
							include"include/hal_notulen/notulen.php";	
						}elseif($_GET[pages]=="esdm"){
							include"esdm.php";				//other pelulusan
						}else{
							include"welcome.php";			//user + admin
						}
					?>  
            
<link href="vendors/datepicker.css" rel="stylesheet" media="screen">
<link href="vendors/uniform.default.css" rel="stylesheet" media="screen">
<link href="vendors/chosen.min.css" rel="stylesheet" media="screen">
<link href="vendors/wysiwyg/bootstrap-wysihtml5.css" rel="stylesheet" media="screen">
<script src="vendors/jquery-1.9.1.js"></script>
<script src="bootstrap/js/bootstrap.min.js"></script>
<script src="vendors/jquery.uniform.min.js"></script>
<script src="vendors/chosen.jquery.min.js"></script>
<script src="vendors/bootstrap-datepicker.js"></script>
<script src="vendors/wysiwyg/wysihtml5-0.3.0.js"></script>
<script src="vendors/wysiwyg/bootstrap-wysihtml5.js"></script>
<script src="vendors/wizard/jquery.bootstrap.wizard.min.js"></script>
<script src="assets/scripts.js"></script>

<script src="vendors/jGrowl/jquery.jgrowl.js"></script>

<script src="vendors/datatables/js/jquery.dataTables.min.js"></script>
<script src="assets/DT_bootstrap.js"></script>
<script>
   $(function(){});
</script>

<script>
    $(function() {
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
            // If it's the last tab then hide the last button and show the finish instead
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
    });
</script>
<script>
	initSample();
</script>
</body>
</html>
