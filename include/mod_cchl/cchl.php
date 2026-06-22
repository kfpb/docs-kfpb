<div class="navbar navbar-inner block-header">
	<div class="muted pull-left">Copy Controlled Holder List (CCHL)</div>
</div>
<div class="block-content collapse in">
<div class="span12">


<?php
$aksi="include/mod_cchl/aksi_cchl.php";
switch($_GET[act]){
  // Tampil cchl
  default:
    echo "<h3>Penerima Dokumen/ Copy Controlled Hold List (CCHL)</h3>
          <input type=button value='Tambah cchl' 
          onclick=\"window.location.href='?pages=cchl&act=tambahcchl';\">";
         
		  $tampil=mysql_query("SELECT * FROM cchl ORDER BY id_cchl");
		$jmldata = mysql_num_rows($tampil);
		echo "<font size=2> Total Penerima Dokumen : $jmldata   <table border=1>
          <tr><th>no</th><th>Nama Jabatan Penerima</th><th>Singkatan Jabatan</th><th>Aksi</th></tr>"; 
       $no=1;
    while ($r=mysql_fetch_array($tampil)){
       echo "<tr><td>$no</td>
             <td>$r[nama_cchl]</td>
	     <td>$r[cchl]</td>
             <td><a href=?pages=cchl&act=editcchl&id=$r[id_cchl]>Edit</a> | 
	               <a href=$aksi?module=cchl&act=hapus&id=$r[id_cchl]>Hapus</a>
             </td></tr>";
      $no++;
    }
    echo "</table></font>";
    break;
  
  // Form Tambah cchl
  case "tambahcchl":
    echo "<h3>Tambah CCHL/ Jabatan</h3>
          <form method=POST action='$aksi?module=cchl&act=input'>
          <table>
          <tr><td>Nama Jabatan</td><td> : <input type=text name='nama_cchl'></td></tr>
          <tr><td>Singkatan Jabatan</td><td> : <input type=text name='cchl'></td></tr>
          <tr><td colspan=2><input type=submit name=submit value=Simpan>
                            <input type=button value=Batal onclick=self.history.back()></td></tr>
          </table></form>";
     break;
  
  // Form Edit CCHL 
  case "editcchl":
    $edit=mysql_query("SELECT * FROM cchl WHERE id_cchl='$_GET[id]'");
    $r=mysql_fetch_array($edit);

    echo "<h3>Edit cchl</h3>
          <form method=POST action=$aksi?module=cchl&act=update>
          <input type=hidden name=id value='$r[id_cchl]'>
          <table>
          <tr><td>Nama Jabatan</td><td> : <input type=text name='nama_cchl' value='$r[nama_cchl]'></td></tr>
          <tr><td>Singkatan Jabatan</td><td> : <input type=text name='cchl' value='$r[cchl]'></td></tr>
          <tr><td colspan=2><input type=submit value=Update>
                            <input type=button value=Batal onclick=self.history.back()></td></tr>
          </table></form>";
    break;  
}
?>
</div><!--/span12-->
</div><!--/block-content-->