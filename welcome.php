<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Card Example</title>
     <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css" ... />
    <style>
        /*body {*/
        /*    font-family: Arial, sans-serif;*/
        /*    display: flex;*/
        /*    justify-content: center;*/
        /*    align-items: center;*/
        /*    min-height: 100vh;*/
        /*    background-color: #f4f4f4;*/
        /*}*/

        .card-container {
            display: flex;
            justify-content: center; /* Center the cards horizontally */
            gap: 20px;
        }

        .card {
            background-color: #fff;
            border-radius: 8px;
            padding: 20px;
            box-shadow: 0 2px 5px rgba(0, 0, 0, 0.1);
            width: 250px;
        }

        .card-icon {
            display: flex;
            justify-content: center;
            align-items: center;
            width: 40px;
            height: 40px;
            border-radius: 50%;
            background-color: #eee;
            margin-bottom: 10px;
        }

        .card-title {
            font-weight: bold;
            margin-bottom: 5px;
        }

        .card-value {
            font-size: 24px;
            font-weight: bold;
            margin-bottom: 5px;
        }

        .card-change {
            display: flex;
            align-items: center;
            font-size: 14px;
        }

        .card-change-icon {
            margin-right: 5px;
        }

        .card-change-value {
            color: #4CAF50; /* Green for positive change */
        }

        .card-change-value.negative {
            color: #f44336; /* Red for negative change */
        }

        .card-options {
            display: flex;
            justify-content: flex-end;
            margin-top: 10px;
        }

        .card-options-button {
            background-color: transparent;
            border: none;
            font-size: 18px;
            cursor: pointer;
            text-decoration: none; /* Remove default button underline */
            color: #333; /* Set button text color */
        }
    </style>
</head>
<body>

<div class="navbar navbar-inner block-header">
    <div class="muted pull-left"><font color=black>Dashboard</font></div>
</div>
<?php
if($_SESSION[cv]==1 OR $_SESSION[cv]==53 OR $_SESSION[cv]==1051 OR $_SESSION[cv]==1052 OR $_SESSION[cv]==1054 OR $_SESSION[cv]==1055 OR $_SESSION[cv]==1056 OR $_SESSION[cv]==1057 OR $_SESSION[cv]==1058 OR $_SESSION[cv]==1059 OR $_SESSION[cv]==1000){
        $usulanmasuk = mysql_query("SELECT * FROM udokumen WHERE udstatus2='Y' AND udtgl_terima='0000-00-00' AND ccstatus='Y'");
        $j = mysql_num_rows($usulanmasuk);
        
         $permintaancopy = mysql_query("SELECT * FROM copydok WHERE sstatus='N' And kirim_status='Y'");
        $pc = mysql_num_rows($permintaancopy);
        
        $distribusidokumen = mysql_query("SELECT * FROM dister WHERE distatus='N' ");
        $dd = mysql_num_rows($distribusidokumen);

        // Get today's date
        $today = date('Y-m-d');

        // Calculate today's additions for each category
        $usulanmasukToday = 0;
        while ($row = mysql_fetch_assoc($usulanmasuk)) {
            if (date('Y-m-d', strtotime($row['udtgl'])) === $today) {
                $usulanmasukToday++;
            }
        }

        $permintaancopyToday = 0;
        while ($row = mysql_fetch_assoc($permintaancopy)) {
            if (date('Y-m-d', strtotime($row['tgl_kirimajuan'])) === $today) {
                $permintaancopyToday++;
            }
        }

        $distribusidokumenToday = 0;
        while ($row = mysql_fetch_assoc($distribusidokumen)) {
            if (date('Y-m-d', strtotime($row['ditgl'])) === $today) {
                $distribusidokumenToday++;
            }
        }
    ?>
    <div class="navbar navbar-inner block-header">
        <div class="muted pull-left"><font color=black>Dashboard MR</font></div>
    </div>
<div class="card-container">
        <div class="card">
            <div class="card-icon" style="background-color: #e0ffe0;">
                <i class="fas fa-file-import"></i>
            </div>
            <div class="card-title">Usulan Dokumen Masuk</div>
            <?php if($j > 0){ ?>
                <div class="card-value"><?php echo $j ?></div>
            <?php }else{ ?>
                <div class="card-value">0</div>
            <?php } ?>
            <div class="card-change">
                <span class="card-change-icon">+</span>
                <span class="card-change-value"><?php echo $usulanmasukToday; ?>  Pada Hari ini</span>
            </div>
            <div class="card-options">
                <a class="card-options-button" href='?pages=usulandok'><i class="fas fa-arrow-right"></i> Detail</a>
            </div>
        </div>
        <div class="card">
            <div class="card-icon" style="background-color: #e0ffff;">
                <i class="fas fa-copy"></i>
            </div>
            <div class="card-title">Permintaan Copy Dokumen</div>
                <?php if($pc > 0){ ?>
                    <div class="card-value"><?php echo $pc ?></div>
                <?php }else{ ?>
                    <div class="card-value">0</div>
                <?php } ?>
            <div class="card-change">
                <span class="card-change-icon">+</span>
                <span class="card-change-value"><?php echo $permintaancopyToday; ?>  Pada Hari ini</span>
            </div>
            <div class="card-options">
                <a class="card-options-button" href='?pages=copy'><i class="fas fa-arrow-right"></i> Detail</a>
            </div>
        </div>
        <div class="card">
            <div class="card-icon" style="background-color: #ffe0e0;">
                <i class="fas fa-truck"></i>
            </div>
            <div class="card-title">Distribusi Dokumen</div>
             <?php if($dd > 0){ ?>
                    <div class="card-value"><?php echo $dd ?></div>
                <?php }else{ ?>
                    <div class="card-value">0</div>
                <?php } ?>
            <div class="card-change">
                <span class="card-change-icon">+</span>
                <span class="card-change-value"><?php echo $distribusidokumenToday; ?> Pada Hari ini</span>
            </div>
            <div class="card-options">
                <a class="card-options-button" href='?pages=dister'><i class="fas fa-arrow-right"></i> Detail</a>
            </div>
        </div>
       
    </div>
<?php }elseif(in_array($_SESSION['cv'], [55, 81, 99, 1060, 1109]) || (isset($_SESSION['nppcv']) && $_SESSION['nppcv'] == 'pmps1')){?>
<?php 
    $sql = mysql_query("SELECT * FROM udokumen WHERE udstatus2='Y' AND ccstatus='N'");
    $j = mysql_num_rows($sql);
    $sql_spek = mysql_query("SELECT * FROM udokumen WHERE udstatus2='Y' AND ccstatus='N' AND (ukodok LIKE 'S-%' OR ujudok LIKE '%spesifikasi%' OR ujudok LIKE '%Spesifikasi%')");
    $j_spek = mysql_num_rows($sql_spek);
    $smasuk_pmp = mysql_query("
        SELECT a.suid 
        FROM dister a 
        INNER JOIN disin b ON a.suid_dinter = b.suid 
        WHERE b.cId = '$_SESSION[cv]' 
        AND a.suid = (SELECT MAX(d2.suid) FROM dister d2 WHERE d2.suid_dinter = b.suid)
        AND b.distatus = 'N'
    ");
    $j_dist = @mysql_num_rows($smasuk_pmp);
?>
<div class="card-container">
        <div class="card">
            <div class="card-icon" style="background-color: #e0ffe0;">
                <i class="fas fa-file-import"></i>
            </div>
            <div class="card-title">Usulan Dokumen Masuk (CC)</div>
            <?php if($j > 0){ ?>
                <div class="card-value"><?php echo $j ?></div>
            <?php }else{ ?>
                <div class="card-value">0</div>
            <?php } ?>
            <div class="card-options">
                <a class="card-options-button" href='?pages=usulandok'><i class="fas fa-arrow-right"></i> Detail</a>
            </div>
        </div>
        <div class="card">
            <div class="card-icon" style="background-color: #e0f2fe;">
                <i class="fas fa-file-alt" style="color: #0284c7;"></i>
            </div>
            <div class="card-title">Usulan Spesifikasi Baru</div>
            <?php if($j_spek > 0){ ?>
                <div class="card-value"><?php echo $j_spek ?></div>
            <?php }else{ ?>
                <div class="card-value">0</div>
            <?php } ?>
            <div class="card-options">
                <a class="card-options-button" href='?pages=usulandok'><i class="fas fa-arrow-right"></i> Detail</a>
            </div>
        </div>
        <div class="card">
            <div class="card-icon" style="background-color: #fef3c7;">
                <i class="fas fa-truck" style="color: #d97706;"></i>
            </div>
            <div class="card-title">Distribusi Dokumen Masuk</div>
            <?php if($j_dist > 0){ ?>
                <div class="card-value"><?php echo $j_dist ?></div>
            <?php }else{ ?>
                <div class="card-value">0</div>
            <?php } ?>
            <div class="card-options">
                <a class="card-options-button" href='?pages=usrd'><i class="fas fa-arrow-right"></i> Detail</a>
            </div>
        </div>
</div>
<?php } else {
    $is_pkpa = (isset($_SESSION['is_pkpa']) && $_SESSION['is_pkpa'] == 'Y') || (isset($_SESSION['nppcv']) && stripos($_SESSION['nppcv'], 'pkpa') !== false);
    
    // Hitung Dokumen Internal Aktif
    $q_aktif = mysql_query("SELECT COUNT(*) as total FROM dinter WHERE distatus='Y'");
    $d_aktif = mysql_fetch_assoc($q_aktif);
    $total_aktif = $d_aktif ? $d_aktif['total'] : 0;
    
    // Hitung Distribusi Dokumen Terkini
    $q_dist = mysql_query("SELECT COUNT(*) as total FROM dister WHERE distatus='Y'");
    $d_dist = mysql_fetch_assoc($q_dist);
    $total_dist = $d_dist ? $d_dist['total'] : 0;
    
    // Hitung Dokumen Obsolete
    $q_obs = mysql_query("SELECT COUNT(*) as total FROM dinter WHERE distatus='N'");
    $d_obs = mysql_fetch_assoc($q_obs);
    $total_obs = $d_obs ? $d_obs['total'] : 0;
?>
    <?php if ($is_pkpa) { 
        $tgl_exp = !empty($_SESSION['tgl_expired']) ? tgl_indo($_SESSION['tgl_expired']) : '-';
    ?>
    <div class="alert alert-info" style="margin: 15px 20px 25px 20px; font-size: 14px; line-height: 1.6; border-left: 5px solid #0088cc;">
        <h4 style="margin-top: 0; color: #005580;"><i class="fas fa-user-graduate"></i> Selamat Datang di Portal Dokumen KFPB (Akses PKPA)</h4>
        Akun Anda aktif untuk keperluan <strong>Praktek Kerja Profesi Apoteker (PKPA)</strong>.<br />
        Anda memiliki hak akses membaca seluruh dokumen internal terkendali yang berlaku.<br />
        <span style="font-size: 13px; color: #555;">Masa berlaku akun s/d: <strong><?php echo $tgl_exp; ?></strong></span>
    </div>
    <?php } ?>

    <div class="card-container">
        <div class="card">
            <div class="card-icon" style="background-color: #e0ffe0;">
                <i class="fas fa-file-alt" style="color: #2e7d32;"></i>
            </div>
            <div class="card-title">Dokumen Internal Aktif</div>
            <div class="card-value"><?php echo $total_aktif; ?></div>
            <div class="card-change">
                <span class="card-change-icon"><i class="fas fa-check-circle" style="color: #4CAF50;"></i></span>
                <span class="card-change-value">Siap dibaca</span>
            </div>
            <div class="card-options">
                <a class="card-options-button" href='?pages=usrdin'><i class="fas fa-arrow-right"></i> Buka Dokumen</a>
            </div>
        </div>

        <div class="card">
            <div class="card-icon" style="background-color: #fef3c7;">
                <i class="fas fa-truck" style="color: #d97706;"></i>
            </div>
            <div class="card-title">Distribusi Dokumen Masuk</div>
            <div class="card-value"><?php echo $total_dist; ?></div>
            <div class="card-change">
                <span class="card-change-icon"><i class="fas fa-clock" style="color: #d97706;"></i></span>
                <span class="card-change-value">Terkendali</span>
            </div>
            <div class="card-options">
                <a class="card-options-button" href='?pages=usrd'><i class="fas fa-arrow-right"></i> Lihat Distribusi</a>
            </div>
        </div>

        <div class="card">
            <div class="card-icon" style="background-color: #fee2e2;">
                <i class="fas fa-archive" style="color: #dc2626;"></i>
            </div>
            <div class="card-title">Dokumen Obsolete</div>
            <div class="card-value"><?php echo $total_obs; ?></div>
            <div class="card-change">
                <span class="card-change-icon"><i class="fas fa-ban" style="color: #dc2626;"></i></span>
                <span class="card-change-value" style="color: #dc2626;">Tidak berlaku</span>
            </div>
            <div class="card-options">
                <a class="card-options-button" href='?pages=usrdin&act=dokinterobsolate'><i class="fas fa-arrow-right"></i> Detail</a>
            </div>
        </div>
    </div>
<?php } ?>
</body>
</html>