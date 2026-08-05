<?php
session_start();

$act = isset($_GET['act']) ? $_GET['act'] : '';

// 1. Endpoint AJAX untuk Form dinamik (Auto-fill Judul & Revisi)
if ($act == 'get_data') {
    $data = array();
    
    if (isset($_GET['id'])) {
        $id = mysql_real_escape_string($_GET['id']);
        
        $query = mysql_query("SELECT dikodok, dijudok, direv FROM dinter_ebr WHERE dikodok LIKE '%" . $id . "%'");
        if ($query) {
            $hasil = mysql_fetch_array($query);
            if ($hasil) {
                $data['dikodok'] = $hasil['dikodok'];
                $data['dijudok'] = $hasil['dijudok'];
                $data['direv']   = $hasil['direv'];
            } else {
                $data['dikodok'] = '';
                $data['dijudok'] = '';
                $data['direv']   = '';
            }
        }
    }
    
    header('Content-Type: application/json');
    echo json_encode($data);
    exit;
}

// 2. Tampilan Pencarian / Master Table dinter_ebr
if (empty($act)) {
?>
    <div class="row-fluid">
        <div class="span12">
            <div class="block">
                <div class="navbar navbar-inner block-header">
                    <div class="muted pull-left">Master Data Dokumen EBR (Dinter EBR)</div>
                </div>
                <div class="block-content collapse in">
                    <div class="span12">
                        <table class="table table-striped table-bordered" id="example">
                            <thead>
                                <tr>
                                    <th>No</th>
                                    <th>Kode Dokumen</th>
                                    <th>Judul Dokumen / Nama Produk</th>
                                    <th>Revisi</th>
                                    <th>Status</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php
                                $no = 1;
                                $query_master = mysql_query("SELECT * FROM dinter_ebr ORDER BY dikodok ASC");
                                while ($r = mysql_fetch_array($query_master)) {
                                    echo "<tr>
                                            <td>$no</td>
                                            <td>$r[dikodok]</td>
                                            <td>$r[dijudok]</td>
                                            <td>$r[direv]</td>
                                            <td>" . ($r['status'] == '1' ? 'Aktif' : 'Non-Aktif') . "</td>
                                          </tr>";
                                    $no++;
                                }
                                ?>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
<?php
}
?>