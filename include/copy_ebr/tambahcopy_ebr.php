<?php
// Pastikan session sudah aktif dan koneksi MySQL global ($koneksi) sudah tersedia sebelum file ini dimuat

if ($_SESSION['cv'] == 0 OR $_SESSION['cv'] == 1 OR $_SESSION['cv'] == 53 OR $_SESSION['cv'] == 1051 OR $_SESSION['cv'] == 1054 OR $_SESSION['cv'] == 1055 OR $_SESSION['cv'] == 1056 OR $_SESSION['cv'] == 1057 OR $_SESSION['cv'] == 1058 OR $_SESSION['cv'] == 1000) {
?>

<form method="post" action="include/copy_ebr/aksi_ebr.php?act=tambah" enctype="multipart/form-data" class="form-horizontal" id="form_tambah_ebr">
<fieldset>
<legend>Permohonan Copy EBR Baru</legend>

    <div class="control-group">
        <label class="control-label" for="tgl">Tanggal Permohonan</label>
        <div class="controls">
            <input class="input-small datepicker" id="tgl" type="text" name="tgl" value="<?php echo date('Y-m-d'); ?>" required="required">
        </div>
    </div>

    <div class="control-group">
        <label class="control-label" for="pengirim">Yang Bertanda Tangan</label>
        <div class="controls">
            <select id="pengirim" class="chzn-select" name="pengirim" required="required">
                <option value="">-- Pilih Penanggung Jawab --</option>
                <?php
                $cv = mysql_query("SELECT cId, cNama FROM users ORDER BY cNama ASC");
                while ($dcv = mysql_fetch_array($cv)) {
                    echo "<option value='$dcv[cId]'>$dcv[cNama]</option>";
                }
                ?>
            </select>
        </div> 
    </div>

    <div class="control-group">
        <label class="control-label" for="ket">Isi / Keterangan Permohonan</label>
        <div class="controls">
            <textarea name="ket" id="editor" class="form-control" style="width: 400px; height: 90px;"></textarea>
        </div>
    </div>

    <hr>
    <h4>Detail Dokumen EBR yang Di-copy</h4>
    
    <div class="dynamic_form_ebr">
        <div id="row-ebr-1" class="control-group-wrapper">
            <div class="control-group">
                <label class="control-label">Kode Dokumen EBR</label>
                <div class="controls">
                    <b>
                        <input type="text" onchange="getdataEbr(this.value, 1)" placeholder="Pilih / Tulis Kode" id="dinmr1" name="dinmr[]" autofocus tabindex="1" class="chzn-select open-data" list="datalist_ebr" required="required">
                    </b>
                </div>
            </div>

            <div class="control-group">
                <label class="control-label">Judul Dokumen / Nama Produk</label>
                <div class="controls">
                    <b><input type="text" id="dijudok1" name="dijudok[]" class="input-xlarge form-control dijudok" required="required"></b>
                </div>
            </div>

            <div class="control-group">
                <label class="control-label">Revisi Dokumen Ke</label>
                <div class="controls">
                    <b><input type="text" id="direv1" name="direv[]" class="input-xlarge form-control direv"></b>
                </div>
            </div>

            <div class="control-group">
                <label class="control-label">Jumlah Permintaan</label>
                <div class="controls">
                    <b><input type="number" id="dijumlah1" name="dijumlah[]" class="input-xlarge form-control dijumlah" value="1" min="1" required="required"></b><br>
                    <small style="color: red;">Isi Hanya Angka, Contoh: 1.</small>
                </div>
            </div>

            <div class="control-group">
                <label class="control-label">Lokasi Penggunaan</label>
                <div class="controls">
                    <b><input type="text" id="dilokasi1" name="dilokasi[]" class="input-xlarge form-control lokasi"></b><br>
                    <small style="color: red;">Lokasi Penggunaan Dokumen EBR</small>
                </div>
            </div>

            <div class="control-group">
                <label class="control-label">Keterangan Item</label>
                <div class="controls">
                    <b><textarea name="diketdok[]" style="width: 400px; height: 90px" class="form-control"></textarea></b>
                </div>
            </div>
            <div class="separator-line"><hr></div>
        </div>
    </div>

    <div class="control-group">
        <div class="controls">
            <button type="button" class="btn btn-info tambahin_ebr"><i class="icon-plus"></i> Tambah Dokumen EBR</button>
        </div>
    </div>

    <hr>

    <div class="control-group">
        <label class="control-label" for="fileInput">Lampiran Permohonan EBR</label>
        <div class="controls">
            <input class="input-file uniform_on" id="fileInput" type="file" name="fupload"> Max. 15 MB<br>
            <small style="color: gray;">(Jika lampiran lebih dari 2, scan/satukan jadi 1 file PDF/ZIP)</small>
        </div>
    </div>

    <div class="control-group">
        <div class="controls">
            <button type="submit" class="btn btn-primary" id="submit_ebr"><i class="icon-save"></i> Simpan Permohonan</button> 
            <button type="reset" class="btn" onclick="self.history.back()"><i class="icon-remove"></i> Batal</button>
        </div>
    </div>
</fieldset>
</form>

<?php
// Pre-load data master dinter EBR ke datalist
$datalist_html = '<datalist id="datalist_ebr">';
$q_ebr = mysql_query("SELECT dikodok, dijudok, direv FROM dinter_ebr ORDER BY dikodok ASC");
if ($q_ebr) {
    while ($a_ebr = mysql_fetch_array($q_ebr)) {
        if (!empty($a_ebr['dikodok'])) {
            $datalist_html .= '<option value="' . htmlspecialchars($a_ebr['dikodok']) . '">' . htmlspecialchars($a_ebr['dikodok']) . ' - Revisi (' . htmlspecialchars($a_ebr['direv']) . ') - ' . htmlspecialchars($a_ebr['dijudok']) . '</option>';
        }
    }
}
$datalist_html .= '</datalist>';
echo $datalist_html;
?>

<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
<script>
$(document).ready(function() {
    var count = 1;

    // Fungsi Tambah Baris Dinamis
    $('.tambahin_ebr').click(function() {
        count++;
        var new_row = 
            '<div id="row-ebr-' + count + '" class="control-group-wrapper">' +
                '<div class="control-group">' +
                    '<label class="control-label">Kode Dokumen EBR</label>' +
                    '<div class="controls"><b>' +
                        '<input type="text" onchange="getdataEbr(this.value, ' + count + ')" placeholder="Pilih / Tulis Kode" id="dinmr' + count + '" name="dinmr[]" autofocus tabindex="1" class="chzn-select open-data" list="datalist_ebr" required="required"> ' +
                        '<button type="button" name="remove" id="' + count + '" class="btn btn-danger btn_remove_ebr">Hapus</button>' +
                    '</b></div>' +
                '</div>' +
                '<div class="control-group">' +
                    '<label class="control-label">Judul Dokumen / Nama Produk</label>' +
                    '<div class="controls"><b><input type="text" id="dijudok' + count + '" name="dijudok[]" class="input-xlarge form-control dijudok" required="required"></b></div>' +
                '</div>' +
                '<div class="control-group">' +
                    '<label class="control-label">Revisi Dokumen Ke</label>' +
                    '<div class="controls"><b><input type="text" id="direv' + count + '" name="direv[]" class="input-xlarge form-control direv"></b></div>' +
                '</div>' +
                '<div class="control-group">' +
                    '<label class="control-label">Jumlah Permintaan</label>' +
                    '<div class="controls"><b><input type="number" id="dijumlah' + count + '" name="dijumlah[]" class="input-xlarge form-control dijumlah" value="1" min="1" required="required"></b><br><small style="color: red;">Isi Hanya Angka, Contoh: 1.</small></div>' +
                '</div>' +
                '<div class="control-group">' +
                    '<label class="control-label">Lokasi Penggunaan</label>' +
                    '<div class="controls"><b><input type="text" id="dilokasi' + count + '" name="dilokasi[]" class="input-xlarge form-control lokasi"></b><br><small style="color: red;">Lokasi Penggunaan Dokumen EBR</small></div>' +
                '</div>' +
                '<div class="control-group">' +
                    '<label class="control-label">Keterangan Item</label>' +
                    '<div class="controls"><b><textarea name="diketdok[]" style="width: 400px; height: 90px" class="form-control"></textarea></b></div>' +
                '</div>' +
                '<div class="separator-line"><hr></div>' +
            '</div>';

        $('.dynamic_form_ebr').append(new_row);
    });

    // Fungsi Hapus Baris
    $(document).on('click', '.btn_remove_ebr', function() {
        var button_id = $(this).attr("id");
        $('#row-ebr-' + button_id).remove();
    });

    // Submisi Ajax Form Tambah
    $('#form_tambah_ebr').submit(function(e) {
        e.preventDefault();
        var formData = new FormData(this);

        $.ajax({
            url: $(this).attr('action'),
            type: "POST",
            data: formData,
            contentType: false,
            processData: false,
            success: function(response) {
                alert(response);
                window.location = "home.php?pages=copy_ebr";
            },
            error: function(xhr, status, error) {
                alert("Terjadi kesalahan saat menyimpan data EBR!");
                console.log(xhr.responseText);
            }
        });
    });
});

// Fungsi AJAX Ambil Data Master EBR
function getdataEbr(isi, idx) {
    if (!isi) {
        $('#dijudok' + idx).val('');
        $('#direv' + idx).val('');
        return;
    }

    $.ajax({
        url: "include/copy_ebr/dinter_ebr.php?act=get_data&id=" + encodeURIComponent(isi),
        type: "GET",
        dataType: "JSON",
        success: function(data) {
            if (data) {
                $('#dijudok' + idx).val(data.dijudok);
                $('#direv' + idx).val(data.direv);
            } else {
                $('#dijudok' + idx).val('');
                $('#direv' + idx).val('');
            }
        },
        error: function(xhr, status, error) {
            console.log(xhr.responseText);
        }
    });
}
</script>

<?php
} else {
    echo "<script>window.alert('Anda tidak memiliki akses ke halaman ini.');window.location='home.php';</script>";
}
?>