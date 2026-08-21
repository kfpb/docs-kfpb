<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Permintaan Copy Batch Record</title>
    <script>
        function confirmSubmission(event) {
            // Mencegah pengiriman formulir langsung
            event.preventDefault();

            // Tampilkan dialog konfirmasi
            const userConfirmed = confirm("Apakah Anda yakin semua informasi yang dimasukkan sudah benar?");
            if (userConfirmed) {
                // Jika pengguna menyetujui, kirim formulir
                event.target.submit();
            }
        }
    </script>
</head>
<body>
    <legend>Permintaan Copy Batch Record</legend>
    <form method="post" action="include/copy_ebr/aksi_copyebr.php?act=storebatch" enctype="multipart/form-data" class="form-horizontal" onsubmit="confirmSubmission(event)">
        <fieldset>
            <div class="control-group">
                <label class="control-label" for="nama_produk">Nama Produk</label>
                <div class="controls"><input class="input-xxlarge focused" id="nama_produk" type="text" name="nama_produk" required="required"><br>
                <small>Contoh : CLOPIDOGREL 75 MG TSS </small></div>
            </div>

            <div class="control-group">
                <label class="control-label" for="besaran_bets">Besar Bets</label>
                <div class="controls"><input class="input-xxlarge focused" id="besaran_bets" type="text" name="besaran_bets" required="required"><br>
                <small>Contoh : 140 KG (Sertakan Satuan Besaran Bets)</small>
                </div>
            </div>

            <div class="control-group">
                <label class="control-label" for="juduldok">Jenis Dokumen</label>
                <div class="controls">
                    <select class="chzn-select span7" id="jenis_dokumen" name="jenis_dokumen" required="required">
                        <option value="" disabled selected>Pilih Jenis Dokumen</option>
                        <option value="PPI">Prosedur Pengolahan Induk</option>
                        <option value="PGI">Prosedur Pengemasan Induk</option>
                    </select>
                </div>
            </div>

            <div class="control-group">
                <label class="control-label" for="nomor_batch">Nomor Bets</label>
                <div class="controls"><input class="input-xxlarge focused" id="nomor_batch" type="text" name="nomor_batch" required="required"><br>
                <small>Contoh : L25714NX</small></div>
            </div>

            <div class="control-group">
                <label class="control-label" for="catatan">Catatan</label>
                <div class="controls">
                    <textarea name="catatan" id="editor" style="width: 100%; height: 100px;"></textarea>
                </div>
            </div>

            <div class="control-group">
                <label class="control-label" for="fileInput">Upload Lampiran</label>
                <div class="controls">
                    <input class="input-file uniform_on" id="fileInput" type="file" name="fupload"> <small>Max. 15 MB</small>
                </div>
            </div>

            <div class="control-group">
                <div class="controls">
                    <button type="submit" class="btn btn-primary">Simpan</button>
                    <button type="reset" class="btn" onclick="self.history.back()">Batal</button>
                </div>
            </div>
        </fieldset>
    </form>
</body>
</html>
