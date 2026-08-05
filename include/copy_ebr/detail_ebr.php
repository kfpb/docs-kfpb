<?php
// Pastikan session sudah aktif dan ID permohonan tersedia
if (isset($_GET['id'])) {
    $id_ebr = mysql_real_escape_string($_GET['id']);

    // Query Data Utama Permohonan EBR
    $query_utama = mysql_query("SELECT a.*, b.cNama FROM copydok_ebr a 
                                LEFT JOIN users b ON a.opengirim = b.cId 
                                WHERE a.oid = '$id_ebr'");
    $d = mysql_fetch_array($query_utama);

    if (!$d) {
        echo "<div class='alert alert-error'>Data Permohonan EBR tidak ditemukan!</div>";
        exit;
    }
?>

<div class="row-fluid">
    <div class="span12">
        <div class="block">
            <div class="navbar navbar-inner block-header">
                <div class="muted pull-left">Detail Permohonan Copy EBR - <b>#<?php echo $d['oid']; ?></b></div>
                <div class="pull-right">
                    <a href="javascript:history.back()" class="btn btn-mini btn-warning"><i class="icon-arrow-left icon-white"></i> Kembali</a>
                </div>
            </div>
            <div class="block-content collapse in">
                <div class="span12">
                    <table class="table table-bordered">
                        <tr>
                            <td width="20%"><b>Tanggal Permohonan</b></td>
                            <td>: <?php echo isset($d['otgl']) ? tgl_indo($d['otgl']) : '-'; ?></td>
                        </tr>
                        <tr>
                            <td><b>Yang Bertanda Tangan</b></td>
                            <td>: <?php echo $d['cNama']; ?></td>
                        </tr>
                        <tr>
                            <td><b>Keterangan Permohonan</b></td>
                            <td>: <?php echo nl2br($d['oket']); ?></td>
                        </tr>
                        <tr>
                            <td><b>Lampiran File</b></td>
                            <td>: 
                                <?php 
                                if (!empty($d['ofile'])) {
                                    echo "<a href='scopy/$d[ofile]' target='_blank' class='btn btn-mini btn-info'><i class='icon-download-alt icon-white'></i> Download $d[ofile]</a>";
                                } else {
                                    echo "<span class='label label-important'>Tidak ada lampiran</span>";
                                }
                                ?>
                            </td>
                        </tr>
                    </table>

                    <br>
                    <h4>Daftar Dokumen EBR yang Diminta:</h4>
                    <table class="table table-striped table-bordered">
                        <thead>
                            <tr class="info">
                                <th width="5%">No</th>
                                <th width="20%">Kode Dokumen</th>
                                <th width="30%">Judul Dokumen / Nama Produk</th>
                                <th width="10%">Revisi</th>
                                <th width="10%">Jumlah</th>
                                <th width="15%">Lokasi</th>
                                <th width="10%">Keterangan</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php
                            $no_item = 1;
                            // Query Item Lampiran EBR dari tabel copydok_ebr_lampiran (atau copydok_lampiran_ebr)
                            $q_detail = mysql_query("SELECT * FROM copydok_ebr_lampiran WHERE copydok_id = '$id_ebr' ORDER BY clid ASC");
                            
                            if (mysql_num_rows($q_detail) > 0) {
                                while ($item = mysql_fetch_array($q_detail)) {
                                    echo "<tr>
                                            <td align='center'>$no_item</td>
                                            <td>$item[dinmr]</td>
                                            <td>$item[dijudok]</td>
                                            <td align='center'>$item[direv]</td>
                                            <td align='center'>$item[dijumlah]</td>
                                            <td>$item[dilokasi]</td>
                                            <td>$item[diketdok]</td>
                                          </tr>";
                                    $no_item++;
                                }
                            } else {
                                echo "<tr><td colspan='7' align='center'><em>Belum ada rincian dokumen EBR.</em></td></tr>";
                            }
                            ?>
                        </tbody>
                    </table>

                    <div class="form-actions">
                        <button type="button" class="btn btn-primary" onclick="window.print();"><i class="icon-print icon-white"></i> Cetak Detail</button>
                    </div>

                </div>
            </div>
        </div>
    </div>
</div>

<?php
} else {
    echo "<div class='alert alert-error'>Parameter ID tidak valid.</div>";
}
?>