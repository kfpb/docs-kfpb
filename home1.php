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


						if($_GET[pages]=="users"){
							include"include/users/users.php";	//admin untuk kelola user
						}elseif($_GET[pages]=="dokint"){
							include"under.php";	//admin dan user untuk reg dokumen internal
						}elseif($_GET[pages]=="dokest"){
							include"under.php";	//admin dan user untuk reg dokumen eksternal
						}elseif($_GET[pages]=="ccinter0"){
							include"include/ccinter/ccinter0.php";	//admin, admin CC untuk kelola manual CC
						}elseif($_GET[pages]=="ccinter"){
							include"include/ccinter/ccinter1.php";	//admin, admin CC untuk kelola manual CC
						}elseif($_GET[pages]=="ccinter2"){
							include"include/ccinter/ccinter2.php";	//admin, admin CC untuk kelola manual CC
						}elseif($_GET[pages]=="ccinter3"){
							include"include/ccinter/ccinter3.php";	//admin, admin CC untuk kelola manual CC
						}elseif($_GET[pages]=="ccinter4"){
							include"include/ccinter/ccinter4.php";	//admin, admin CC untuk kelola manual CC
						}elseif($_GET[pages]=="ccinter5"){
							include"include/ccinter/ccinter5.php";	//admin, admin CC untuk kelola manual CC
						}elseif($_GET[pages]=="acccc"){
							include"under.php";	//admin dan user untuk kelola ACC CC
						}elseif($_GET[pages]=="rtcc"){
							include"rtcc.php";	//admin dan user untuk kelola RT CC
						}elseif($_GET[pages]=="regdokint"){
							include"under.php";	//admin reg dokumen internal lama
						}elseif($_GET[pages]=="regdokeks"){
							include"under.php";	//admin reg dokumen eksternal lama
						}elseif($_GET[pages]=="regusulan"){
							include"under.php";	//admin dan user untuk reg usulan lama
						}elseif($_GET[pages]=="cchl"){
							include"include/mod_cchl/cchl.php";	//admin untuk kelola CCHL lama
						}elseif($_GET[pages]=="jendok"){
							include"include/mod_jendok/jendok.php";	//admin	untuk kelola jenis dokumen			
						}elseif($_GET[pages]=="jabatan"){
							include"include/jabatan/jabatan.php";	//admin untuk kelola level dokumen
						}elseif($_GET[pages]=="suin"){
							include"include/suin/suin.php";			//admin untuk kelola surat masuk internal
						}elseif($_GET[pages]=="duin1"){
							include"include/duin/duin1.php";			//admin untuk kelola tela'ahan
						}elseif($_GET[pages]=="tuin"){
							include"include/tuin/tuin1.php";			//admin untuk kelola tela'ahan
						}elseif($_GET[pages]=="copy"){
							include"include/copy/sout1.php";			//admin untuk kelola surat keluar eksternal
						}elseif($_GET[pages]=="dinter1"){
							include"include/dinter/dinter1.php";		//print lembar distribusi
						}elseif($_GET[pages]=="dinter2"){
							include"include/dinter/dinter2.php";		//print	QRCODE
						}elseif($_GET[pages]=="dister1"){
							include"include/dister/dister1.php";		//print lembar distribusi
						}elseif($_GET[pages]=="dister2"){
							include"include/dister/dister2.php";		//print	QRCODE
						}elseif($_GET[pages]=="sinter"){
							include"include/sinter/sinter1.php";		//admin untuk kelola memo/undangan internal
						}elseif($_GET[pages]=="linter"){
							include"include/linter/linter1.php";		//admin untuk kelola memo/undangan internal
						}elseif($_GET[pages]=="sintertp"){
							include"include/spptek/sinter2.php";		//admin untuk kelola memo/undangan internal
						}elseif($_GET[pages]=="sinterm"){
							include"include/sinter/sinter1.php";		//admin untuk kelola memo/undangan internal
						}elseif($_GET[pages]=="rall"){
							include"include/rall/rall.php";			//admin untuk buat laporan
						}elseif($_GET[pages]=="rsuin"){
							include"include/rsuin/rsuin.php";		//admin untuk buat laporan surat masuk internal
						}elseif($_GET[pages]=="rsout"){
							include"include/rsout/rsout.php";		//admin untuk buat laporan surat keluar eksternal
						}elseif($_GET[pages]=="usrte"){
							include"usrte.php";						//other untuk user surat eksternal
						}elseif($_GET[pages]=="usrtl"){
							include"usrtl.php";						//other untuk telaahan
						}elseif($_GET[pages]=="usrt"){
							include"usrt.php";						//other untuk user memo internal
						}elseif($_GET[pages]=="usrtm"){
							include"usrtm.php";						//other untuk user memo internal
						}elseif($_GET[pages]=="usrtm1"){
							include"usrtm1.php";		
						}elseif($_GET[pages]=="usrtm2"){
							include"usrtm2.php";					
						}elseif($_GET[pages]=="usrtpp"){
							include"usrtpp.php";						//other untuk download excel spptek	
						}elseif($_GET[pages]=="printduin"){
							include"include/duin/printduin.php";						//other untuk download excel spptek	
						}elseif($_GET[pages]=="printaktivitas"){
							include"include/aktivitas_docs/printaktivitas.php";						//other untuk download excel aktivitas dokumen	
						}elseif($_GET[pages]=="printsout"){
							include"include/copy/printsout.php";						//other untuk download excel spptek	
						}elseif($_GET[pages]=="printdister"){
							include"include/dister/printdister.php";						//other untuk download excel spptek	
						}elseif($_GET[pages]=="usrtt"){
							include"usrtt.php";						//other untuk user tembusan memo masuk internal
						}elseif($_GET[pages]=="rsi"){
							include"include/rsi/rsi.php";		//other admin dan user laporan
						}elseif($_GET[pages]=="rdi"){
							include"include/rdi/rdi.php";		//other admin dan user laporan
						}elseif($_GET[pages]=="udis"){
							include"udisposisi.php";				//other untuk user lihat disposisi
						}elseif($_GET[pages]=="ldis"){
							include"ldisposisi.php";				//other untuk user lihat disposisi
						}elseif($_GET[pages]=="utis"){
							include"utisposisi.php";				//other untuk user lihat tela'ahan
						}elseif($_GET[pages]=="pelulusan"){
							include"pelulusan.php";				//other pelulusan
                        }elseif($_GET[pages]=="dashppic"){
							include"dashppic.php";				//other pelulusan
						
						}elseif($_GET[pages]=="cetakRDTCC"){
							include"include/dinter/export_excel.php";		//admin untuk kelola dokumen internal
						}
					    elseif($_GET[pages]=="export_permintaan_ebr"){         // untuk update data masal
						    include"include/copy_ebr/export_permintaan_ebr.php";
						}
						else{
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
