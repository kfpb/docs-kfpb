<?php 
session_start();
error_reporting(E_ERROR | E_WARNING | E_PARSE | E_NOTICE);
include"config/koneksi.php";
if (isset($_SESSION['cv'])) {
    header("Location: home.php");
}
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN"
"http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml" lang="en" xml:lang="en">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1" />
<title>Document Control Assistance System - PT. Kimia Farma (Persero) Tbk. Plant Banjaran</title>
    <!-- Bootstrap -->
    <link rel="icon" href="https://docs.kfpb.kimiafarma.co.id/files.png" type="image/x-icon">
    <link href="https://docs.kfpb.kimiafarma.co.id/bootstrap/css/bootstrap.min.css" rel="stylesheet" media="screen">
    <link href="https://docs.kfpb.kimiafarma.co.id/bootstrap/css/bootstrap-responsive.min.css" rel="stylesheet" media="screen">
    <link href="https://docs.kfpb.kimiafarma.co.id/assets/styles.css" rel="stylesheet" media="screen">
     <!-- HTML5 shim, for IE6-8 support of HTML5 elements -->
    <!--[if lt IE 9]>
      <script src="http://html5shim.googlecode.com/svn/trunk/html5.js"></script>
    <![endif]-->
    <script src="https://docs.kfpb.kimiafarma.co.id/js/vendor/modernizr-2.6.2-respond-1.1.0.min.js"></script>
</head>
<body id="login">
	<div class="container">
	    <form class="form-signin" method="post" action="cek_login.php">
        <div class="navbar-inner navbar-inverse">
         <center>
         <!--<h5 align="center">Aplikasi</h5>-->
		 <img src="https://docs.kfpb.kimiafarma.co.id/images/logo.png" />
		 <h4><i></i></h4>
         <h6>Document Control Assistance System</h6>
         </center>
        </div>
        <br />
        <legend></legend>
        <input type="text" class="input-block-level" placeholder="Username" name="username">
        <input type="password" class="input-block-level" placeholder="Password" name="password">
        <center><i>
            
            <table border="0" cellpadding="0" cellspacing="0" align="center">
                <tr>
                    <tr>
                        <td><small>Kode Captcha</small></td>
                        <!-- tentukan letak script generate gambar -->
                        <td><img src="captcha.php" alt="gambar" /> </td>
                    </tr><br>
                    <tr>
                        <td><small>Masukkan Kode diatas</small></td>
                        <td><input name="kodecaptcha" value="" maxlength="5"/></td>
                    <tr>
                    <input type="hidden" class="input-block-level" value="baru" name="struktur">
                </tr>
              </table>
              <hr>
        <button class="btn btn-block btn-primary" type="submit">Masuk</button>
        <br />
        <center>
Rekomendasi Browser : Chrome</strong></h5> 
         <p>Copyright &copy; <?php echo date('Y'); ?> | <strong>Pengembangan Sistem</strong> <br /><a href="http://docs.kfpb.kimiafarma.co.id">Plant Banjaran - <strong>PT. Kimia Farma
         </strong></p>         
         </center>
    	</form>
         
    </div> <!-- /container -->
  </body>
</html>

 <script src="https://docs.kfpb.kimiafarma.co.id/vendors/jquery-1.9.1.min.js"></script>
 <script src="https://docs.kfpb.kimiafarma.co.id/bootstrap/js/bootstrap.min.js"></script>
