<div class="navbar navbar-inner block-header">
	<div class="muted pull-left">users</div>
</div>
<div class="block-content collapse in">
<div class="span12">

<?php
if($_GET[act]=="tambah"){
?>
<form method="post" action="include/users/aksi_users.php?act=tambah" enctype="multipart/form-data" class="form-horizontal">
<fieldset>
<legend>Tambah users</legend>
	<div class="control-group">
		<label class="control-label" for="user">Username  <span style="color: red">*</span></label>
        <div class="controls"><input class="input-medium focused" id="user" type="text" name="user" required="required"></div>
    </div>
	<div class="control-group">
		<label class="control-label" for="id_jabatan">Ulangi Username  <span style="color: red">*</span></label>
        <div class="controls"><input class="input-medium focused" id="id_jabatan" type="text" name="id_jabatan"></div>
    </div>
    <div class="control-group">
		<label class="control-label" for="nama">Nama <span style="color: red">*</span></label>
        <div class="controls"><input class="input-xxlarge focused" id="nama" type="text" name="nama" required="required"></div>
    </div>
    <div class="control-group">
		<label class="control-label" for="nama_jabatan">Nama Jabatan  <span style="color: red">*</span></label>
        <div class="controls"><input class="input-xxlarge focused" id="nama_jabatan" type="text" name="nama_jabatan" required="required"></div>
    </div>
	<!--<div class="control-group">-->
	<!--	<label class="control-label" for="atasan">Atasan</label>-->
 <!--       <div class="controls"><input class="input-medium focused" id="atasan" type="text" name="atasan"></div>-->
 <!--   </div>-->
    <div class="control-group">
    <fieldset>

            <!--<form method="post" action="include/dister/aksi_dister.php?act=lp2&id=<?=$_GET[id];?>" enctype="multipart/form-data" class="form-horizontal">-->
			 <label class="control-label" for="atasan">Atasan  <span style="color: red">*</span></label>
			  <div class="controls">
			<select id="atasan" name="atasan" class="chzn-select span8">
            	<?php
				$cv = mysql_query("SELECT cId, cNama, bagian, cJabatan FROM users");
				
				    echo "<option selected>Pilih atasan</option>";
				while ($dcv=mysql_fetch_array($cv)){
	    	     	echo "<option value='$dcv[cId]'>$dcv[cJabatan] - $dcv[cNama]</option>";
				}
				?>                             
            </select>
			
<button type="button" class="chosen-toggle deselect">Hapus Semua</button>
     </div> 
 
</fieldset>
</div>
    <div class="control-group">
		<label class="control-label" for="singkatan_bagian">Singkatan Bagian  <span style="color: red">*</span></label>
        <div class="controls"><input class="input-xxlarge focused" id="singkatan_bagian" type="text" name="singkatan_bagian" required="required">
        <br><small>(Contoh : Penyimpanan = WR, Pemastian Mutu = QS)</small>
        </div>
    </div>
	 <div class="control-group">
		<label class="control-label" for="acc_atasan">ACC Atasan</label>
        <div class="controls">
        	<select name="acc_atasan" class="span8" required="required">
               <option value='Y' selected>Ya, harus acc atasan</option>
			   <option value='T' >Tidak harus acc atasan</option>
            </select>
         </div>
    </div>
    <div class="control-group">
		<label class="control-label" for="telp">Telepon</label>
        <div class="controls"><input class="input-medium focused" id="telp" type="text" name="telp"></div>
    </div>
    <div class="control-group">
		<label class="control-label" for="email">Email</label>
        <div class="controls"><input class="input-xxlarge focused" id="email" type="email" name="email" required="required"></div>
    </div>
  <div class="control-group">
		<label class="control-label" for="email2">Email ke-2</label>
        <div class="controls"><input class="input-xxlarge focused" id="email" type="email" name="email2"></div>
    </div>
    <div class="control-group">
		<label class="control-label" for="jabatan">Level</label>
        <div class="controls">
        	<select name="jabatan" class="span3" required="required">
                <?php
					$jabatan = mysql_query("SELECT * FROM jabatan");
					while($j = mysql_fetch_array($jabatan)){
						if ($j[jabatan]=="Administrator"){
							echo"<option value='$j[idj]' selected>$j[jabatan]</option>";	
						}else{
							echo"<option value='$j[idj]'>$j[jabatan]</option>";
						}
					}
				?>
            </select>
         </div>
    </div>
    
    	
	<div class="control-group">
		<label class="control-label" for="jabatan">Kecualikan Audit</label>
        <div class="controls">
        	<?php
			if($j[cAudit]==Y){
				echo "<select name='audit' class='span3'>
				<option value='Y' selected>Ya</option>
				<option value='N'>Tidak</option>";
			}else{
				echo "<select name='audit' class='span3'>
				<option value='N' selected>Tidak</option>
				<option value='Y'>Ya</option>";
			}
			?>

            </select>
         </div>
    </div>
	
	
	<div class="control-group">
		<label class="control-label">Foto</label>
		<div class="controls"><input class="input-file uniform_on" id="fileInput" type="file" name="fupload"></div>
    </div>
	
    <div class="control-group">
		<label class="control-label" for="pass">Password<br>
		<small>(Minimal 8 Karakter)</small></label>
        <div class="controls"><input class="input-medium focused" id="pass" minlength="8" type="password" name="pass" required="required"></div>
    </div>
    <div class="control-group">
        <div class="controls">
        <button class="btn btn-primary">Simpan</button> 
        <button type="reset" class="btn" onclick=self.history.back()>Batal</button>
        </div>
    </div>
</fieldset>
</form>
<?php
}elseif($_GET[act]=="edit"){
$e = mysql_fetch_array(mysql_query("SELECT * FROM users WHERE cId='$_GET[id]'"));
if ($e[cFoto]==""){
	$foto = "foto/none.jpg";
}else{
	$foto = "foto/$e[cFoto]";
}
?>
<form method="post" action="include/users/aksi_users.php?act=edit&id=<?=$e[cId];?>" enctype="multipart/form-data" class="form-horizontal">
<fieldset>
<legend>Edit Users</legend>
	<div class="control-group">
		<div class="controls">
		<img src="<?=$foto;?>" style="width: 120px; height: 120px;" class="tooltip-right" data-original-title="<?=$e[cNama];?>">
		<input class="input-file uniform_on" id="fileInput" type="file" name="fupload">
		<?php
		if ($e[cFoto]!=""){
		echo "<span class='help-inline'>*Abaikan bila foto tidak diganti</span>";
		}
		?>
		</div>
    </div>
<?php
	if ($_SESSION[cv]==1000){
	?>
	<div class="control-group">
		<label class="control-label" for="user">Username</label>
        <div class="controls"><input class="input-medium focused" id="user" type="text" name="user" required="required" value="<?=$e[cUser];?>"></div>
    </div>
<div class="control-group">
		<label class="control-label" for="nama">Nama</label>
        <div class="controls"><input class="input-xlarge focused" id="nama" type="text" name="nama" required="required" value="<?=$e[cNama];?>"></div>
    </div>
    <div class="control-group">
		<label class="control-label" for="nama_jabatan">Nama Jabatan</label>
        <div class="controls"><input class="input-xxlarge focused" id="nama_jabatan" type="text" name="nama_jabatan" required="required" value="<?=$e[cJabatan];?>"></div>
    </div>
    <div class="control-group">
		<label class="control-label" for="idjab">Id Jabatan</label>
        <div class="controls"><input class="input-medium focused" id="idjab" type="text" name="idjab" value="<?=$e[cIdjab];?>"></div>
    </div>
	  <div class="control-group">
		<label class="control-label" for="atasan">Atasan</label>
        <div class="controls"><input class="input-medium focused" id="atasan" type="text" name="atasan" required="required" value="<?=$e[cAtasan];?>"></div>
    </div>
	<div class="control-group">
		<label class="control-label" for="jabatan">ACC Atasan</label>
        <div class="controls">
        	<?php
			if($e[cAccatasan]==Y){
				echo "<select name='accatasan' class='span3'>
				<option value='Y' selected>Ya</option>
				<option value='N'>Tidak</option>";
			}else{
				echo "<select name='accatasan' class='span3'>
				<option value='N' selected>Tidak</option>
				<option value='Y'>Ya</option>";
			}
			?>

            </select>
         </div>
    </div>
    <div class="control-group">
		<label class="control-label" for="jabatan">Level</label>
        <div class="controls">
        	<?php
			if($_SESSION[jabatan]==0){
				echo "<select name='jabatan' class='span3'>";
			}else{
				echo "<select name='jabatan' class='span3' disabled='disabled'>";
			}
			?>
                <?php
					$tampil=mysql_query("SELECT * FROM jabatan ORDER BY jabatan");
					while($w=mysql_fetch_array($tampil)){
						if ($e[idj]==$w[idj]){
							echo "<option value=$w[idj] selected>$w[jabatan]</option>";
						}else{
							echo "<option value=$w[idj]>$w[jabatan]</option>";
						}
					}
				?>
            </select>
         </div>
    </div>

	
	<div class="control-group">
		<label class="control-label" for="jabatan">Kecualikan Audit</label>
        <div class="controls">
        	<?php
			if($e[cAudit]==Y){
				echo "<select name='audit' class='span3'>
				<option value='Y' selected>Ya</option>
				<option value='N'>Tidak</option>";
			}else{
				echo "<select name='audit' class='span3'>
				<option value='N' selected>Tidak</option>
				<option value='Y'>Ya</option>";
			}
			?>

            </select>
         </div>
    </div>
	
	
	
	
    <?php
	} else {
	?>	
	<input id="nama" type="hidden" name="user" value="<?=$e[cUser];?>">
	<input id="nama_jabatan" type="hidden" name="nama_jabatan" value="<?=$e[cJabatan];?>">
	<input id="idjab" type="hidden" name="idjab" value="<?=$e[cIdjab];?>">
	<input id="atasan" type="hidden" name="atasan" value="<?=$e[cAtasan];?>">
	<input id="accatasan" type="hidden" name="accatasan" value="<?=$e[cAccatasan];?>">
	<input id="jabatan" type="hidden" name="jabatan" value="<?=$e[idj];?>">
    <input id="telp" type="hidden" name="telp" value="<?=$e[cTelp];?>">
    <input id="email" type="hidden" name="email" value="<?=$e[cEmail];?>">
    <input id="email2" type="hidden" name="email2" value="<?=$e[cEmail2];?>">
	  <div class="control-group">
		<label class="control-label" for="nama">Nama</label>
        <div class="controls"><b><input id="nama" type="hidden" name="nama" value="<?=$e[cNama];?>"><?=$e[cNama];?></b></div>
    </div>
	<? } ?>
    <div class="control-group">
		<label class="control-label" for="pass">Password</label>
        <div class="controls">
        	<input class="input-medium focused" id="pass" type="password" name="pass">
            <span class="help-inline">* Kosongkan bila password tidak diganti</span>
        </div>
    </div>
    <div class="control-group">
        <div class="controls">
        <button class="btn btn-primary">Simpan</button> 
        <button type="reset" class="btn" onclick=self.history.back()>Batal</button>
        </div>
    </div>
</fieldset>
</form>
<?php
}else{
?>
<div class="block-content collapse in">
<div class="span12">
	<button class="btn-info btn-large" onclick="window.location.href='?pages=users&act=tambah'">Tambah users</button>
    <br /><br />
	<table cellpadding="0" cellspacing="0" border="0" class="table table-striped table-bordered" id="Tb14">
	<thead>
		<tr>
			<th>user</th>
			<th>Nama</th>
			<th>Jabatan</th>
			<th>Atasan</th>
			<th>Level</th>
            <th>Email</th>
            <th class='center'>Aksi</th>
		</tr>
	</thead>
	<tbody>
	<?php
		$users = mysql_query("SELECT * FROM users,jabatan WHERE jabatan.idj=users.idj");
		while($s = mysql_fetch_array($users)) {
		echo "<tr>
				<td>$s[cUser]</td>
                <td>$s[cNama]</td>
                <td>$s[cJabatan]</td>
                <td>$s[cAtasan]</td>
                <td>$s[jabatan]</td>
                <td>$s[cEmail]</td>
				<td class='center'>";
                echo "<a href='include/users/aksi_users.php?act=hapus&id=$s[cId]' onClick=\"return confirm('Yakin ingin menghapus??')\"><i class='icon-trash'></i></a> 
				<a href='?pages=users&act=edit&id=$s[cId]'><i class='icon-edit'></i>";
				echo "
				</td>
				</tr>";	
		}
	?>
	</tbody>
</table>
</div>
</div>

<?php
}
?>

</div><!--/span12-->
</div><!--/block-content-->
