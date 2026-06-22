<div class="navbar navbar-inner block-header">
	<div class="muted pull-left">Permohonan Copy (Salinan/File) Dokumen</div>
</div>
<div class="block-content collapse in">
<div class="span12">

<?php
if($_GET[act]=="tambah"){
$e = mysql_fetch_array(mysql_query("SELECT * FROM isurat WHERE iid='$_GET[id]'"));

$acak            = rand(1,99);
$acak2           = rand(1,99);
$bln			 = date("m/Y");
$thn			 = date("Y");	
$tgl			 = date("d-M-Y");
$tgl1			 = date("Y-m-d");

$query = "SELECT max(onmr) as max_no FROM copydok WHERE onmr LIKE '%$thn%'";
$hasil = mysql_query($query);
$hitung = mysql_num_rows($hasil);
$data  = mysql_fetch_array($hasil); 
$idMax = $data['max_no'];
$noUrut = (int) substr($idMax, 2, 4);
$noUrut++;
$newID = sprintf("C-%04s/$_SESSION[nppcv]/$bln", $noUrut);


?>

<form method="post" action="include/copy/aksi_sout.php?act=tambah" enctype="multipart/form-data" class="form-horizontal">
<fieldset>
<legend>Buat Permohonan Copy Dokumen</legend>
<?php

	if($_SESSION[cv]==0 OR $_SESSION[cv]==1 OR $_SESSION[cv]==53 OR $_SESSION[cv]==1051 OR $_SESSION[cv]==1054 OR $_SESSION[cv]==1055 OR $_SESSION[cv]==1056 OR $_SESSION[cv]==1057 OR $_SESSION[cv]==1058 OR $_SESSION[cv]==1058 OR $_SESSION[cv]==1000){
	echo "<input type=hidden name=kepada value=2>";
		?>
    <div class="control-group">
		<label class="control-label" for="tgl">Tanggal</label>
        <div class="controls"><input class="input-small datepicker" id="tgl" type="text" name="tgl" required="required"></div>
    </div>
    <div class="control-group">
    	<label class="control-label" for="pengirim">Yang Bertanda Tangan</label>
        <div class="controls">
            <select id="pengirim" class="chzn-select" name="pengirim" required="required">
            	<option>Pilih users</option>
            <?php
				$cv = mysql_query("SELECT cId, cNama FROM users WHERE cid<>0");
				while ($dcv=mysql_fetch_array($cv)){
	    	     	echo "<option value='$dcv[cId]'>$dcv[cNama]</option>";
				}
			?>
           	</select>
        </div> 
    </div>
	<? } else { ?>
    <div class="control-group">
		<label class="control-label" for="tgl">Tanggal</label>
        <div class="controls"> <?  echo "<input type=hidden name=kepada value=53><input type=hidden name=tgl value=$tgl1><b>$tgl</b>";  ?> </div>
    </div>
	
    <div class="control-group">
    	<label class="control-label" for="pengirim">Yang Bertanda Tangan</label>
        <div class="controls">
            <select id="pengirim" class="chzn-select" name="pengirim" required="required">
            	<option>Pilih users</option>
				 <?php
				echo "
				<option value='$_SESSION[cv]' selected>$_SESSION[namacv]</option>";
			?>
           	</select>
        </div> 
    </div>
	<? } ?>
	

		<div class="control-group">
    	<label class="control-label" for="Jenismemo">Jenis Permohonan/Laporan</label>
        <div class="controls">
          	 <select id="jenisms" class="chzn-select span6" name="jenisms" required="required">
            	<option value='' selected>Pilih/Cari Jenis Permohonan/Laporan</option>
				<option value='1'>Permohonan Copy Controlled</option>
				<option value='2'>Permohonan Copy Uncontrolled</option>
				<!--<option value='3'>Permohonan Copy Batch Record</option>-->
				<!--<option value='4'>Permohonan Email/File Dokumen</option>-->
           	</select>
        </div> 
		</div>
 
<!--    <div class="control-group">-->
<!--    	<label class="control-label" for="ket">Isi Permohonan</label>-->
<!--        <div class="controls">-->
<!--				<textarea name="ket" id="editor">-->
				
<!--<table border="1" width=100%>-->
<!--	<tbody>-->
<!--		<tr>-->
<!--			<td><b><center>No</b></center></td>-->
<!--			<td><b><center>Kode Dokumen(R)/Produk</b></center></td>-->
<!--			<td><b><center>Judul Dokumen/ Produk</b></center></td>-->
<!--			<td><b><center>Jumlah</b></center></td>-->
<!--			<td><b><center>Keterangan</b></center></td>-->
<!--			<td><b><center>Tgl Terima</b></center></td>-->
<!--			<td><b><center>Paraf</b></center></td>-->
<!--		</tr>-->
<!--		<tr>-->
<!--			<td>&nbsp;</td>-->
<!--			<td>&nbsp;</td>-->
<!--			<td>&nbsp;</td>-->
<!--			<td>&nbsp;</td>-->
<!--			<td>&nbsp;</td>-->
<!--			<td>&nbsp;</td>-->
<!--			<td>&nbsp;</td>-->
<!--		</tr>-->
<!--		<tr>-->
<!--			<td>&nbsp;</td>-->
<!--			<td>&nbsp;</td>-->
<!--			<td>&nbsp;</td>-->
<!--			<td>&nbsp;</td>-->
<!--			<td>&nbsp;</td>-->
<!--			<td>&nbsp;</td>-->
<!--			<td>&nbsp;</td>-->
<!--		</tr>-->
<!--	</tbody>-->
<!--</table>-->
<!--<p>&nbsp;</p>-->
				
<!--				</textarea>-->
<!--        </div>-->
<!--    </div>-->
    <div class="control-group dynamic_form">
    <!--  <div class="controls"><button type="button" name="tambahin" id="tambahin" class="btn btn-warning text-white tambahin">Tambah Keterangan Permohonan Copy</button></div><br>-->
    </div>
	
    <div class="control-group">
        <div class="controls">
        <button class="btn btn-primary">Simpan</button> 
        <button type="reset" class="btn" onclick=self.history.back()>Batal</button>
        <button type="button" name="tambahin" id="tambahin" class="btn btn-warning text-white tambahin">Tambah Keterangan Permohonan Copy</button>
        </div>
    </div>
</fieldset>
</form>
<?php
}elseif($_GET[act]=="edit"){ 


// Logika untuk menampilkan form edit
if (isset($_GET['act']) && $_GET['act'] == "edit") {
    $oid_utama = mysql_real_escape_string($_GET['id']); // Ambil ID utama, bersihkan

    // Query data utama dari tabel copydok
    $e = mysql_fetch_array(mysql_query("SELECT * FROM copydok WHERE oid='" . $oid_utama . "'"));

    // Query untuk nama pengirim (ef)
    $ef = mysql_fetch_array(mysql_query("SELECT a.*, b.cNama FROM copydok a, users b WHERE a.opengirim=b.cId AND a.oid='" . $oid_utama . "'"));

    // Query untuk nama pengirim (efg) - umumnya sama dengan ef
    $efg = mysql_fetch_array(mysql_query("SELECT a.*, b.cNama FROM copydok a, users b WHERE a.opengirim=b.cId AND a.oid='" . $oid_utama . "'"));

    // --- Ambil Data Detail Dokumen dari copydok_lampiran ---
    $detail_dokumen = array();
    // PENTING: Ganti 'cl_kodok', 'cl_judok', dst., dengan NAMA KOLOM ASLI di tabel `copydok_lampiran` Anda.
    $query_detail = mysql_query("SELECT * FROM copydok_lampiran WHERE copydok_id='" . $oid_utama . "' ORDER BY clid ASC");

    if ($query_detail) {
        while ($row_detail = mysql_fetch_assoc($query_detail)) {
            $detail_dokumen[] = array(
                'iddetail' => $row_detail['clid'],        // PK di copydok_lampiran
                'dikodok'  => $row_detail['dinmr'],    // NAMA KOLOM ASLI Anda
                'dijudok'  => $row_detail['dijudok'],    // NAMA KOLOM ASLI Anda
                'direv'    => $row_detail['direv'],      // NAMA KOLOM ASLI Anda
                'dijumlah' => $row_detail['dijumlah'],   // NAMA KOLOM ASLI Anda
                'dilokasi' => $row_detail['dilokasi'],   // NAMA KOLOM ASLI Anda
                'diketdok' => $row_detail['diketdok']    // NAMA KOLOM ASLI Anda
            );
        }
    }
    // --- Akhir Ambil Data Detail Dokumen ---
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Edit Permohonan Copy</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/chosen/1.8.7/chosen.min.css" />

</head>
<body>

<form method="post" action="include/copy/aksi_sout.php?act=edit&id=<?php echo htmlspecialchars($e['oid']);?>" enctype="multipart/form-data" class="form-horizontal" id="form_edit_copy">
<fieldset>
<legend>Edit Permohonan Copy</legend>

    <?php
    if (isset($_SESSION['cv']) && ($_SESSION['cv'] == 0 || $_SESSION['cv'] == 1 || $_SESSION['cv'] == 53 || $_SESSION['cv'] == 1051 || $_SESSION['cv'] == 1054 || $_SESSION['cv'] == 1055 || $_SESSION['cv'] == 1056 || $_SESSION['cv'] == 1057 || $_SESSION['cv'] == 1058 || $_SESSION['cv'] == 1000)) {
    ?>
    <div class="control-group">
        <label class="control-label" for="tgl">Tanggal</label>
        <div class="controls"><input class="input-small datepicker" id="tgl" type="text" name="tgl" value="<?php echo htmlspecialchars($e['otgl']);?>" required="required"></div>
    </div>
    <div class="control-group">
        <label class="control-label" for="pengirim">Yang Bertanda Tangan</label>
        <div class="controls">
            <select id="pengirim" class="chzn-select" name="pengirim">
            <?php
                echo "<option value=\"" . htmlspecialchars($e['opengirim']) . "\" selected>" . htmlspecialchars($ef['cNama']) . "</option>";
                $cv_query = mysql_query("SELECT cId, cNama FROM users");
                if ($cv_query) {
                    while ($dcv = mysql_fetch_array($cv_query)) {
                        echo "<option value=\"" . htmlspecialchars($dcv['cId']) . "\">" . htmlspecialchars($dcv['cNama']) . "</option>";
                    }
                }
            ?>
            </select>
        </div>
    </div>
    <?php } else { ?>
    <div class="control-group">
        <label class="control-label" for="tgl">Tanggal</label>
        <div class="controls"><input type="hidden" name="tgl" value="<?php echo htmlspecialchars($e['otgl']);?>" required="required"><?php echo tgl_indo($e['otgl']); ?></div>
    </div>
    <div class="control-group">
        <label class="control-label" for="pengirim">Yang Bertanda Tangan</label>
        <div class="controls">
            <input type="hidden" name="pengirim" value="<?php echo htmlspecialchars($e['opengirim']);?>">
            <input type="hidden" name="kepada" value="<?php echo htmlspecialchars($e['okepada']);?>">
            Dibuat oleh : <b><?php echo htmlspecialchars($efg['cNama']); ?></b>
        </div>
    </div>
    <?php } ?>
    <?php
    if ($e['otgl_admin'] != '0000-00-00') {
    ?>
    <!--<div class="control-group">-->
    <!--    <label class="control-label" for="ket">Isi Permohonan (Tekan Shift+Enter untuk pindah baris)</label>-->
    <!--    <div class="controls">-->
    <!--        <?php //echo nl2br(htmlspecialchars($e['oket'])); ?>-->
    <!--    </div>-->
    <!--</div>-->
    <?php } else { ?>
    <div class="control-group">
        <label class="control-label" for="ket">Isi Permohonan (Tekan Shift+Enter untuk pindah baris)</label>
        <div class="controls">
            <textarea name="ket" id="editor" class="form-control"><?php echo htmlspecialchars($e['oket']);?></textarea>
        </div>
    </div>
    <?php } ?>

    <hr>
    <h4>Detail Dokumen yang Di-copy</h4>
    <div class="dynamic_form_detail">
        </div>
    <div class="control-group">
        <div class="controls">
            <button type="button" class="btn btn-info tambahin_detail"><i class="icon-plus"></i> Tambah Dokumen</button>
        </div>
    </div>
    <hr>

    <?php
    if (isset($_SESSION['cv']) && ($_SESSION['cv'] == 0 || $_SESSION['cv'] == 1 || $_SESSION['cv'] == 53 || $_SESSION['cv'] == 1051 || $_SESSION['cv'] == 1054 || $_SESSION['cv'] == 1055 || $_SESSION['cv'] == 1056 || $_SESSION['cv'] == 1057 || $_SESSION['cv'] == 1058 || $_SESSION['cv'] == 1000)) {
    ?>
    <div class="control-group">
        <label class="control-label" for="fileInput">Lampiran Permohonan Copy</label>
        <div class="controls">
            <?php if (!empty($e['olampiran'])) { ?>
                <p>Lampiran saat ini: <a href="files/<?php echo htmlspecialchars($e['olampiran']); ?>" target="_blank"><?php echo htmlspecialchars($e['olampiran']); ?></a></p>
                <label class="checkbox"><input type="checkbox" name="hapus_lampiran" value="1"> Hapus Lampiran Lama</label><br>
            <?php } ?>
            <input class="input-file uniform_on" id="fileInput" type="file" name="fupload"> Max. 15 MB<br>(Jika lampiran lebih dari 2, scan/satukan jadi 1 file PDF/ZIP)
        </div>
    </div>
    <?php } ?>
    <div class="control-group">
        <div class="controls">
            <button class="btn btn-primary" type="submit"><i class="icon-save"></i> Simpan Perubahan</button>
            <button type="reset" class="btn" onclick="self.history.back()"><i class="icon-remove"></i> Batal</button>
        </div>
    </div>
</fieldset>
</form>

<script>
    // Data detail dokumen dari PHP, di-encode menjadi JSON
    var initial_detail_data = <?php echo json_encode($detail_dokumen); ?>;

    // Data untuk datalist, agar tidak perlu query ulang
    var datalist_options = '<?php
        $select_options_query_for_js = mysql_query("SELECT dikodok, dijudok, direv FROM dinter ORDER BY dikodok ASC");
        if ($select_options_query_for_js) {
            while ($a_js = mysql_fetch_array($select_options_query_for_js)) {
                echo '<option value="' . htmlspecialchars($a_js['dikodok']) . '">' . htmlspecialchars($a_js['dikodok']) . ' - Revisi (' . htmlspecialchars($a_js['direv']) . ') - ' . htmlspecialchars($a_js['dijudok']) . '</option>';
            }
        }
    ?>';
</script>

<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/chosen/1.8.7/chosen.jquery.min.js"></script>
<script>
$(document).ready(function() {
    var dynamic_row_counter = 0;
    if (initial_detail_data && initial_detail_data.length > 0) {
        dynamic_row_counter = initial_detail_data.length;
    }

    function htmlEntities(str) {
        return String(str).replace(/&/g, '&amp;').replace(/</g, '&lt;').replace(/>/g, '&gt;').replace(/"/g, '&quot;');
    }

    function add_dynamic_row(data_row = null) {
        dynamic_row_counter++;

        var iddetail_val = (data_row && data_row.iddetail !== undefined && data_row.iddetail !== null) ? htmlEntities(data_row.iddetail) : '';
        var dikodok_val = (data_row && data_row.dikodok !== undefined && data_row.dikodok !== null) ? htmlEntities(data_row.dikodok) : '';
        var dijudok_val = (data_row && data_row.dijudok !== undefined && data_row.dijudok !== null) ? htmlEntities(data_row.dijudok) : '';
        var direv_val = (data_row && data_row.direv !== undefined && data_row.direv !== null) ? htmlEntities(data_row.direv) : '';
        var dijumlah_val = (data_row && data_row.dijumlah !== undefined && data_row.dijumlah !== null) ? htmlEntities(data_row.dijumlah) : '1';
        var dilokasi_val = (data_row && data_row.dilokasi !== undefined && data_row.dilokasi !== null) ? htmlEntities(data_row.dilokasi) : '';
        var diketdok_val = (data_row && data_row.diketdok !== undefined && data_row.diketdok !== null) ? htmlEntities(data_row.diketdok) : '';

        var newRowHtml =
            '<div id="detail-group-' + dynamic_row_counter + '" class="control-group-wrapper">' +
                '<input type="hidden" name="iddetail[]" value="' + iddetail_val + '">' +
                '<div class="control-group">' +
                    '<label class="control-label">Kode Dokumen</label>' +
                    '<div class="controls"><b>' +
                    // '<div class="controls"><b>' +
                        // '<input type="text" onchange="getdata(this.value, ' + dynamic_row_counter + ')" placeholder="Pilih / Tulis Kode" id="dinmr' + dynamic_row_counter + '" name="dinmr[]" autofocus tabindex="1" class="chzn-select open-data" list="datalist_all_dokumen" value="' + dikodok_val + '">' +
                         '<input type="text" onchange="getdata(this.value, ' + dynamic_row_counter + ')" placeholder="Pilih / Tulis Kode" id="dinmr' + dynamic_row_counter + '" name="dinmr[]" autofocus tabindex="1" class="input-xlarge form-control dinmr" list="datalist_all_dokumen" value="' + dikodok_val + '">' +
                        '<button type="button" name="remove" data-row-id="' + dynamic_row_counter + '" data-iddetail="' + iddetail_val + '" class="btn btn-danger btn_remove_detail">Hapus</button>' +
                    '</b></div>' + // Penutup div controls dan b
                '</div>' +
                '<div class="control-group">' +
                    '<label class="control-label">Judul Dokumen</label>' +
                    '<div class="controls"><b><input type="text" id="dijudok' + dynamic_row_counter + '" name="dijudok[]" autofocus tabindex="1" class="input-xlarge form-control dijudok" value="' + dijudok_val + '"></b></div>' +
                '</div>' +
                '<div class="control-group">' +
                    '<label class="control-label">Revisi Dokumen Ke</label>' +
                    '<div class="controls"><b><input type="text" id="direv' + dynamic_row_counter + '" name="direv[]" autofocus tabindex="1" class="input-xlarge form-control direv" value="' + direv_val + '"></b></div>' +
                '</div>' +
                '<div class="control-group">' +
                    '<label class="control-label">Jumlah Permintaan</label>' +
                    '<div class="controls"><b><input type="number" id="dijumlah' + dynamic_row_counter + '" name="dijumlah[]" autofocus tabindex="1" class="input-xlarge form-control dijumlah" value="' + dijumlah_val + '"></b><br><small style="color: red;">Isi Hanya Angka, Contoh: 1.</small></div>' +
                '</div>' +
                '<div class="control-group">' +
                    '<label class="control-label">Lokasi</label>' +
                    '<div class="controls"><b><input type="text" id="dilokasi' + dynamic_row_counter + '" name="dilokasi[]" autofocus tabindex="1" class="input-xlarge form-control lokasi" value="' + dilokasi_val + '"></b><br><small style="color: red;">Lokasi Penggunaan Dokumen</small></div>' +
                '</div>' +
                '<div class="control-group">' +
                    '<label class="control-label">Keterangan</label>' +
                    '<div class="controls"><b><textarea name="diketdok[]" tabindex="1" style="width: 400px; height: 90px" class="form-control" id="diketdok' + dynamic_row_counter + '">' + diketdok_val + '</textarea></b></div>' +
                '</div>' +
                '<div class="separator-line"><hr></div>' +
            '</div>';

        $('.dynamic_form_detail').append(newRowHtml);
    }

    $('body').append('<datalist id="datalist_all_dokumen">' + datalist_options + '</datalist>');

    if (initial_detail_data && initial_detail_data.length > 0) {
        $.each(initial_detail_data, function(index, item) {
            add_dynamic_row(item);
        });
    } else {
        add_dynamic_row();
    }

    $('.tambahin_detail').click(function() {
        add_dynamic_row();
    });

    $(document).on('click', '.btn_remove_detail', function() {
        var row_id_js = $(this).data("row-id");
        var iddetail_from_db = $(this).data("iddetail");

        $('#detail-group-' + row_id_js).remove();

        if (iddetail_from_db) {
            $('#form_edit_copy').append('<input type="hidden" name="deleted_detail_ids[]" value="' + iddetail_from_db + '">');
        }
    });

    window.getdata = function(isi, idx) {
        if (!isi) {
            $('#dijudok' + idx).val('');
            $('#direv' + idx).val('');
            return;
        }

        $.ajax({
            url: "include/copy/aksi_sout.php?act=coba&id=" + encodeURIComponent(isi),
            type: "GET",
            dataType: "JSON",
            success: function(data) {
                if (data && data.error) {
                    Swal.fire({ icon: 'error', title: 'Error!', text: data.error });
                    $('#dijudok' + idx).val('');
                    $('#direv' + idx).val('');
                } else if (data && data.dijudok === 'Data tidak ditemukan') {
                    Swal.fire({ icon: 'warning', title: 'Perhatian!', text: 'Data dokumen tidak ditemukan.' });
                    $('#dijudok' + idx).val('');
                    $('#direv' + idx).val('');
                } else if (data) {
                    $('#dijudok' + idx).val(data.dijudok);
                    $('#direv' + idx).val(data.direv);
                } else {
                    Swal.fire({ icon: 'error', title: 'Respons Invalid!', text: 'Respons dari server tidak valid.' });
                    $('#dijudok' + idx).val('');
                    $('#direv' + idx).val('');
                }
            },
            error: function(xhr, status, error) {
                console.error("AJAX Error Status:", status);
                console.error("AJAX Error Object:", error);
                console.log("Response Text (for debugging):", xhr.responseText);
                Swal.fire({ icon: 'error', title: 'Server Error!', text: 'Gagal mengambil data dokumen.' });
                $('#dijudok' + idx).val('');
                $('#direv' + idx).val('');
            }
        });
    };

    $('#form_edit_copy').submit(function(e) {
        e.preventDefault();

        var formData = new FormData(this);

        $.ajax({
            url: $(this).attr('action'),
            method: "POST",
            data: formData,
            processData: false,
            contentType: false,
            success: function(response) {
                if (response && response.error) {
                    Swal.fire({
                        icon: 'error',
                        title: 'Gagal!',
                        text: response.error
                    });
                } else {
                    Swal.fire({
                        icon: 'success',
                        title: 'Berhasil!',
                        text: response.success
                    }).then((result) => {
                        if (result.isConfirmed) {
                            window.location.reload();
                        }
                    });
                }
                console.log("AJAX Success Response:", response);
            },
            error: function(xhr, status, error) {
                console.error("AJAX Submit Error Status:", status);
                console.error("AJAX Submit Error Object:", error);
                console.log("Response Text (for debugging):", xhr.responseText);

                Swal.fire({
                    icon: 'error',
                    title: 'Error!',
                    text: 'Terjadi kesalahan saat mengirim data. Cek konsol browser Anda.'
                });
            }
        });
    });

    $('.chzn-select').chosen();
});
</script>

</body>
</html>
<?php
}
?>


<? }elseif($_GET[act]=="detail"){
$e = mysql_fetch_array(mysql_query("SELECT * FROM copydok WHERE oid='$_GET[id]'"));
$ef = mysql_fetch_array(mysql_query("SELECT * FROM users WHERE cId='$e[opengirim]'"));
$efg = mysql_fetch_array(mysql_query("SELECT * FROM users WHERE cId='$e[okepada]'"));
$lampiran = mysql_query("SELECT * FROM copydok_lampiran WHERE copydok_id='$_GET[id]'");

				// var_dump($lampiran);die();

	        $sft = Array("1"=>"Controlled","2"=>"Uncontrolled","3"=>"Batch Record","4"=>"Email/File");
			$bdg = Array("A"=>"success","B"=>"warning","C"=>"important");
			$jenis = "<span class='label label-".$bdg[$e[jenisms]]."'>".$sft[$e[jenisms]]."</span>";
?>
<strong>
<legend>Detail Permohonan Copy</legend>
<table width="100%" border=1>
	<tr><td width="24%">Nomor Copy</td><td>: <?
	
	if ($e[onmr]=='') { echo"<u>Belum ada Nomor!</u>";}
	else  { echo"$e[onmr]";}
	?></td></tr>
    <tr><td>Tanggal Permohonan </td><td>: <?=tgl_indo($e[otgl]);?></td></tr>
	<tr><td>jenis Copy</td><td>: <? echo"$jenis";?></td></tr>
    <tr><td>Pemohon</td><td>: <strong><?=$ef[cNama];?></strong></td></tr>
	 <tr><td>Lampiran Permohonan</td><td>: <strong><a href='scopy/<? echo"$e[ofile]";?>' class='btn btn-info' target='_blank'>File</a></strong> *Jika ada</td></tr>
	  <tr><td>Tanggal Terima SPD </td><td>: <?=tgl_indo($e[otgl_admin]);?></td></tr>
	   <tr><td>Tanggal Selesai </td><td>: <?=tgl_indo($e[otgl_slesai]);?></td></tr>
</table>
<br></b></strong>
<table width="100%">
    <tr><td align=top><b>Isi Permohonan Copy :</b></td></tr>
    <?php if($e[dinmr]){?>
    
	<tr><td>
    	<table border="1" style="width:100%">
    	<tbody>
    		<tr>
    			<td>
    			<p><strong>No</strong></p>
    			</td>
    			<td>
    			<p><strong>Kode Dokumen(R)/Produk</strong></p>
    			</td>
    			<td>
    			<p><strong>Judul Dokumen/ Produk</strong></p>
    			</td>
    			<td>
    			<p><strong>Jumlah</strong></p>
    			</td>
    			<td>
    			<p><strong>Lokasi Dokumen</strong></p>
    			</td>
    			<td>
    			<p><strong>Keterangan</strong></p>
    			</td>
    			<td>
    			<p><strong>Tgl Terima</strong></p>
    			</td>
    			<td>
    			<p><strong>Paraf</strong></p>
    			</td>
    		</tr>
    		<tr>
    			<td></td>
    			<td><?=$e[dinmr];?></td>
    			<td><?=$e[dijudok];?></td>
    			<td><?=$e[dijumlah];?></td>
    			<td><?=$e[dilokasi];?></td>
    			<td><?=$e[diketdok];?></td>
    			<td></td>
    			<td></td>
    		</tr>
    		<tr>
    			<td>&nbsp;</td>
    			<td>&nbsp;</td>
    			<td>&nbsp;</td>
    			<td>&nbsp;</td>
    			<td>&nbsp;</td>
    			<td>&nbsp;</td>
    			<td>&nbsp;</td>
    		</tr>
    	</tbody>
    </table>
</td></tr>
<p>&nbsp;</p>

	<?php }elseif($lampiran != null){ ?>
	<tr><td>
    	<table border="1" style="width:100%">
    	<tbody>
    		<tr>
    			<td>
    			<p><strong>No</strong></p>
    			</td>
    			<td>
    			<p><strong>Kode Dokumen(R)/Produk</strong></p>
    			</td>
    			<td>
    			<p><strong>Judul Dokumen/ Produk</strong></p>
    			</td>
    			<td>
    			<p><strong>Revisi</strong></p>
    			</td>
    			<td>
    			<p><strong>Jumlah</strong></p>
    			</td>
    			<td>
    			<p><strong>Lokasi Dokumen</strong></p>
    			</td>
    			<td>
    			<p><strong>Keterangan</strong></p>
    			</td>
    			<td>
    			<p><strong>Tgl Terima</strong></p>
    			</td>
    			<td>
    			<p><strong>Paraf</strong></p>
    			</td>
    		</tr>
    		<?php
    		$i = 1;
    			while ($lmp=mysql_fetch_array($lampiran)){
				?>
    		<tr>
    			<td><?= $i; ?></td>
    			<td><?=$lmp[dinmr];?></td>
    			<td><?=$lmp[dijudok];?></td>
    			<td><?=$lmp[direv];?></td>
    			<td><?=$lmp[dijumlah];?></td>
    			<td><?=$lmp[dilokasi];?></td>
    			<td><?=$lmp[diketdok];?></td>
    			<td></td>
    			<td></td>
    		</tr>
    		<? $i++; } ?>
    	
    	</tbody>
    </table>
</td></tr>
<p>&nbsp;</p>
	
	
	<?php }else{ ?>
	
	
	<tr><td><?php echo $e[oket];?></td></tr>
	
	<?php } ?>
</table>
</strong>
<? 
$tglhrini = date("Y-m-d");
if ($e[okepada]=$_SESSION[cv] AND $e[otgl_admin]=="0000-00-00") {
mysql_query("UPDATE copydok SET otgl_admin='$tglhrini' WHERE oid=$_GET[id]");
}
?>
<br><br>
<? echo"<a href='home1.php?pages=copy&act=print&id=$e[oid]' class='btn btn-info pull-right' target=_blank><i class='icon-print' ></i> Cetak</a>";?>
<br />
<?php
} else{
?>
<div>
    <?php
    if ($_SESSION[cv]==0 OR $_SESSION[cv]==1 OR $_SESSION[cv]==53 OR $_SESSION[cv]==1051 OR $_SESSION[cv]==1054 OR $_SESSION[cv]==1055 OR $_SESSION[cv]==1056 OR $_SESSION[cv]==1057 OR $_SESSION[cv]==1058 OR $_SESSION[cv]==1058 OR $_SESSION[cv]==1000){?>
<div class="span12">
	<div>
     <form method="post" action='home1.php?pages=printsout' target=_blank>
        <div>
    		<label class="control-label" for="lokasi2">Jenis Copy</label>
            <select class="chzn-select span5" name="jenispptek">
              	 <option value='ALL' selected>Silahkan Pilih Jenis Copy</option>  
              	    <option value='ALL'>Semua Jenis</option> 
    			    <option value='Controlled'>Controlled</option>   
                    <option value='Uncontrolled'>Uncontrolled</option>  
            </select>
        </div>
        <div class="control-group">
    		<label class="control-label" for="lokasi2">Bulan Dan Tahun</label>
            <div class="controls"><input type="date" name="blnn1"> s/d <input type="date" name="blnn2"> </div>
        </div>
        
        <input class="btn btn-primary" type="submit" value="Export" />
    </form>
</div>
	<hr>
	<?php } ?>
	
	<button class="btn-info btn-large" onclick="window.location.href='?pages=copy&act=tambah'">Buat Permohonan Copy Dokumen</button>
 <br><br><b>Informasi</b> : Fasilitas Permohonan Copy atau Salinan Dokumen ini berfungsi sebagai permohonan manual hardcopy atau file dokumen ke SPD-MR. 
  
 
    <br /><br />
	
	<table cellpadding="0" cellspacing="0" border="0" class="table table-striped table-bordered" id="Tb14" width=100%>
	<thead>
		<tr><th></th><th>Tanggal</th>
		<th>Tanggal Kirim Usulan</th>
			<th>Pemohon</th>
			<th>Jenis Copy</th>
			<th>Tgl Baca SPD</th>
			<th>Tgl Selesai SPD</th>
			<th>Status</th>
            <th class='center' width=14%>Aksi</th>
		</tr>
	</thead>
	<tbody>
	<?php
	    	
	   if ($_SESSION[cv]==0 OR $_SESSION[cv]==1 OR $_SESSION[cv]==53 OR $_SESSION[cv]==1051 OR $_SESSION[cv]==1054 OR $_SESSION[cv]==1055 OR $_SESSION[cv]==1056 OR $_SESSION[cv]==1057 OR $_SESSION[cv]==1058 OR $_SESSION[cv]==1058 OR $_SESSION[cv]==1000){
	   $smasuk = mysql_query("SELECT * FROM copydok WHERE kirim_status='Y' OR kirim_status IS NULL order by otgl DESC");
	   }
	   else {
		$smasuk = mysql_query("SELECT * FROM copydok WHERE opengirim=$_SESSION[cv] OR okepada=$_SESSION[cv] order by otgl DESC");
	   }
		
		
		while($s = mysql_fetch_array($smasuk)) {
			$user = mysql_fetch_array(mysql_query("SELECT cNama FROM users WHERE cId=$s[opengirim]"));
			$sft = Array("1"=>"Controlled","2"=>"Uncontrolled","3"=>"Batch Record","4"=>"Email/File");
			$bdg = Array("A"=>"success","B"=>"warning","C"=>"important");
			$jenis = "<span class='label label-".$bdg[$s[jenisms]]."'>".$sft[$s[jenisms]]."</span>";
			
		if ($s[sstatus]=='N'){
			echo "<tr class=success>";
		}else{
			echo "<tr>";
		}
		echo "<td>$s[sstatus]</td><td>";echo tgl_indo($s[otgl]);echo"</td>
		<td>";echo tgl_indo($s[tgl_kirimajuan]);echo"</td>
                <td>$user[cNama]</td>
				<td>$jenis</td>
                <td>";echo tgl_indo1($s[otgl_admin]);echo"</td>
				<td>";echo tgl_indo1($s[otgl_slesai]);echo"</td>";
				if ($s[sstatus]=='N'){
					if ($s[okepada]==$_SESSION[cv] OR $_SESSION[cv]==0 OR $_SESSION[cv]==1 OR $_SESSION[cv]==53 OR $_SESSION[cv]==1051 OR $_SESSION[cv]==1054 OR $_SESSION[cv]==1055 OR $_SESSION[cv]==1056 OR $_SESSION[cv]==1057 OR $_SESSION[cv]==1058 OR $_SESSION[cv]==1058 OR $_SESSION[cv]==1000)
					{
            			echo "<td><a href='include/copy/aksi_sout.php?act=acc&id=$s[oid]' class='btn btn-info' onClick=\"return confirm('Yakin ACC/Selesai Permohonan Copy?')\">Selesai</a></td>";
        			}elseif($s[kirim_status]=='N'){
        			    
            			echo "<td><a href='include/copy/aksi_sout.php?act=kirim_permohonan&id=$s[oid]' class='btn btn-info' onClick=\"return confirm('Yakin Akan Mengirimkan Permohonan Copy?')\">Kirim Permintaan</a></td>";
        			}
        					else {
        			echo "<td><b>Belum Selesai</b></td>";	
        					}
			
			}	else{
			        echo "<td>Telah Selesai</td>";
			}
				if ($s[kirim_status]=='N' OR $s[kirim_status]==null){
				echo "
				<td class='center'>
                    <a href='#deleteConfirmationModal' data-toggle='modal' data-id='$s[oid]' class='open-delete-modal'><i class='icon-trash'></i></a>

				<a href='?pages=copy&act=edit&id=$s[oid]'><i class='icon-edit'></i></a> <a href='?pages=copy&act=detail&id=$s[oid]' class='btn btn-info'>Detail</a>
				</td>
				</tr>";
				}
				else {
				echo"<td><a href='?pages=copy&act=detail&id=$s[oid]' class='btn btn-info'>Detail</a></td></tr>";
					
				}
		}
	?>
	</tbody>
</table>
<div class="modal fade" id="deleteConfirmationModal" tabindex="-1" role="dialog" aria-labelledby="deleteConfirmationModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="deleteConfirmationModalLabel">Konfirmasi Penghapusan Dokumen</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <form id="deleteForm" action="include/copy/aksi_sout.php?act=hapus" method="POST">
                <div class="modal-body">
                    <input type="hidden" name="id" id="documentIdToDelete">
                    <div class="form-group">
                        <label for="deleteReason">Alasan Penghapusan:</label>
                        <textarea class="form-control" id="deleteReason" name="alasan" rows="3" required></textarea>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Batal</button>
                    <button type="submit" class="btn btn-danger">Hapus</button>
                </div>
            </form>
        </div>
    </div>
</div>
<br><br>
	<span class="label label-info">
	<h5>Baris tabel Berwarna HIJAU = <strong>Permohonan/Laporan Copy Dokumen SELESAI<BR>
	</strong></h5>
	<? } ?>
</div>
</div>
</div><!--/span12-->
</div><!--/block-content-->

<?php $select = mysql_query("SELECT * FROM dinter WHERE distatus='Y' order by suid DESC");?>
<script src="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.8/js/select2.min.js" defer></script>
<script>
     
    $(document).ready(function() {
	$('.open-delete-modal').on('click', function() {
        var id = $(this).data('id');
        $('#documentIdToDelete').val(id);
    });
		var i = 1;
		$('.tambahin').click(function() {
			i++;
			$('.dynamic_form').append(
				'<div id="row' + i + '" class="control-group"><div class="control-label">Kode Dokumen</div><div class="controls"><b><input type="text" onchange="getdata' + i + '(this.value,0)" placeholder="Pilih / Tulis Kode" id="dinmr" name="dinmr[]" autofocus tabindex="1" class="chzn-select open-data" list="kd"><datalist id="kd"><?php while($a=mysql_fetch_array($select)){?><option value="<?php echo $a[dikodok]; ?>"><?php echo $a[dikodok]; ?> - Revisi (<?php echo $a[direv]; ?>) - <?php echo $a[dijudok]; ?></option><?php } ?></datalist></b> <button type="button" name="remove" id="' + i + '" class="btn btn-danger btn_remove">Hapus</button></div></div>',
			
			'<div id="row2' + i + '" class="control-group"><div class="control-label">Judul Dokumen</div><div class="controls"><b><input type="text" id="dijudok' + i + '" name="dijudok[]" autofocus tabindex="1" class="input-xlarge form-control dijudok"></b></div></div>',
			
			'<div id="row2' + i + '" class="control-group"><div class="control-label">Revisi Dokumen Ke</div><div class="controls"><b><input type="text" id="direv' + i + '" name="direv[]" autofocus tabindex="1" class="input-xlarge form-control direv"></b></div></div>',
			
			'<div id="row3' + i + '" class="control-group"><div class="control-label">Jumlah Permintaan</div><div class="controls"><b><input type="number" id="dijumlah" name="dijumlah[]" autofocus tabindex="1" class="input-xlarge form-control dijumlah" value="1"></b><br><small style="color: red;">Isi Hanya Angka, Contoh: 1.</small></div></div>',
			
			'<div id="row3' + i + '" class="control-group"><div class="control-label">Lokasi</div><div class="controls"><b><input type="text" id="dilokasi" name="dilokasi[]" autofocus tabindex="1" class="input-xlarge form-control lokasi"></b><br><small style="color: red;">Lokasi Penggunaan Dokumen</small></div></div>',
			
			
			'<div id="row7' + i + '" class="control-group"><div class="control-label">Keterangan</div><div class="controls"><b><textarea name="diketdok[]" tabindex="1" style="width: 400px; height: 90px" class="form-control"> </textarea></b></div></div>',
			'<div id="row4' + i + '"><hr></div>'

			);
		});
		

		$(document).on('click', '.btn_remove', function() {
			var button_id = $(this).attr("id");
			$('#row' + button_id + '').remove();
			$('#row2' + button_id + '').remove();
			$('#row3' + button_id + '').remove();
			$('#row4' + button_id + '').remove();
			$('#row5' + button_id + '').remove();
			$('#row6' + button_id + '').remove();
			$('#row7' + button_id + '').remove();
			$('#row8' + button_id + '').remove();
		});
		$('#submit').click(function() {
			$.ajax({
				url: "aksi.php",
				method: "POST",
				data: $('#form_hasil').serialize(),
				success: function(response) {
					alert(response);
					$('#form_hasil')[0].reset();
					console.log(response);
				},

				error: function(response) {

					Swal.fire({
						icon: 'error',
						title: '3rrrr0rr..!',
						text: 'Server error!'
					});

					console.log(response);

				}
			});
		});

	});
	
	function getdata1(isi) {
		$.ajax({
			url: "include/copy/aksi_sout.php?act=coba&id=" + isi,
			type: "get",
			dataType: "JSON",
			success: function (data) {
				$('#dijudok1').val(data.dijudok);
				$('#direv1').val(data.direv);

			}
		});
	};
	function getdata2(isi) {
		$.ajax({
			url: "include/copy/aksi_sout.php?act=coba&id=" + isi,
			type: "get",
			dataType: "JSON",
			success: function (data) {
				$('#dijudok2').val(data.dijudok);
				$('#direv2').val(data.direv);

			}
		});
	};
	function getdata3(isi) {
		$.ajax({
			url: "include/copy/aksi_sout.php?act=coba&id=" + isi,
			type: "get",
			dataType: "JSON",
			success: function (data) {
				$('#dijudok3').val(data.dijudok);
				$('#direv3').val(data.direv);

			}
		});
	};
	function getdata4(isi) {
		$.ajax({
			url: "include/copy/aksi_sout.php?act=coba&id=" + isi,
			type: "get",
			dataType: "JSON",
			success: function (data) {
				$('#dijudok4').val(data.dijudok);
				$('#direv4').val(data.direv);

			}
		});
	};
	function getdata5(isi) {
		$.ajax({
			url: "include/copy/aksi_sout.php?act=coba&id=" + isi,
			type: "get",
			dataType: "JSON",
			success: function (data) {
				$('#dijudok5').val(data.dijudok);
				$('#direv5').val(data.direv);

			}
		});
	};
</script>