<?php

function UploadFoto($fupload_name){

  //direktori gambar

  $vdir_upload = "../../foto/";

  $vfile_upload = $vdir_upload . $fupload_name;

  $tipe_file   = $_FILES['fupload']['type'];


  //Simpan gambar dalam ukuran sebenarnya

  move_uploaded_file($_FILES["fupload"]["tmp_name"], $vfile_upload);



  //identitas file asli  

  if ($tipe_file=="image/jpeg" ){

      $im_src = imagecreatefromjpeg($vfile_upload);

      }elseif ($tipe_file=="image/png" ){

      $im_src = imagecreatefrompng($vfile_upload);

      }elseif ($tipe_file=="image/gif" ){

      $im_src = imagecreatefromgif($vfile_upload);

      }elseif ($tipe_file=="image/wbmp" ){

      $im_src = imagecreatefromwbmp($vfile_upload);

    }
  $src_width = imageSX($im_src);

  $src_height = imageSY($im_src);


  //Hapus gambar di memori komputer
  imagedestroy($im_src);

}



function UploadSMasuk($fupload_name){
  //direktori file
  $vdir_upload = "../../smasuk/";
  $vfile_upload = $vdir_upload . $fupload_name;

  //Simpan file
  move_uploaded_file($_FILES["fupload"]["tmp_name"], $vfile_upload);
}

function UploadUdmasuk($fupload_name){
  //direktori file
  $vdir_upload = "../../udmasuk/";
  $vfile_upload = $vdir_upload . $fupload_name;

  //Simpan file
  move_uploaded_file($_FILES["fupload"]["tmp_name"], $vfile_upload);
}

function UploadSCopy($fupload_name){
  //direktori file
  $vdir_upload = "../../scopy/";
  $vfile_upload = $vdir_upload . $fupload_name;

  //Simpan file
  move_uploaded_file($_FILES["fupload"]["tmp_name"], $vfile_upload);
}

function UploadSinter($fupload_name){
  //direktori file
  $vdir_upload = "../../sinternal/";
  $vfile_upload = $vdir_upload . $fupload_name;

  //Simpan file
  move_uploaded_file($_FILES["fupload"]["tmp_name"], $vfile_upload);
}

function UploadLinter($fupload_name){
  //direktori file
  $vdir_upload = "../../linternal/";
  $vfile_upload = $vdir_upload . $fupload_name;

  //Simpan file
  move_uploaded_file($_FILES["fupload"]["tmp_name"], $vfile_upload);
}

function UploadDinter($fupload_name){
  //direktori file
  $vdir_upload = "../../fdok/";
  $vfile_upload = $vdir_upload . $fupload_name;

  //Simpan file
  move_uploaded_file($_FILES["fupload"]["tmp_name"], $vfile_upload);
}

function UploadDointer($fupload_name){
  //direktori file
  $vdir_upload = "../../sosialisasidok/";
  $vfile_upload = $vdir_upload . $fupload_name;

  //Simpan file
  move_uploaded_file($_FILES["fupload"]["tmp_name"], $vfile_upload);
}

function UploadDisp($fupload_name){
  //direktori file
  $vdir_upload = "../../disposisi/";
  $vfile_upload = $vdir_upload . $fupload_name;

  //Simpan file
  move_uploaded_file($_FILES["fupload"]["tmp_name"], $vfile_upload);
}

function UploadDist($fupload_name){
  //direktori file
  $vdir_upload = "../../disposisidok/";
  $vfile_upload = $vdir_upload . $fupload_name;

  //Simpan file
  move_uploaded_file($_FILES["fupload"]["tmp_name"], $vfile_upload);
}


function Uploadrtcc($fupload_name){
  //direktori file
  $vdir_upload = "../../rtcc/";
  $vfile_upload = $vdir_upload . $fupload_name;

  //Simpan file
  move_uploaded_file($_FILES["fupload"]["tmp_name"], $vfile_upload);
}

function UploadDispdok($fupload_name){
  //direktori file
  $vdir_upload = "../../infodokumen/";
  $vfile_upload = $vdir_upload . $fupload_name;

  //Simpan file
  move_uploaded_file($_FILES["fupload"]["tmp_name"], $vfile_upload);
}

function UploadAlur($fupload_name){
  //direktori file
  $vdir_upload = "../../konsep_kirim/";
  $vfile_upload = $vdir_upload . $fupload_name;

  //Simpan file
  move_uploaded_file($_FILES["fupload"]["tmp_name"], $vfile_upload);
}


function UploadDokint($fupload_name){
  //direktori file
  $vdir_upload = "../../master_pdf/";
  $vfile_upload = $vdir_upload . $fupload_name;

  //Simpan file
  move_uploaded_file($_FILES["fupload"]["tmp_name"], $vfile_upload);
}

function Uploadcc($fupload_name){
  //direktori file
  $vdir_upload = "../../usulancc/";
  $vfile_upload = $vdir_upload . $fupload_name;

  //Simpan file
  move_uploaded_file($_FILES["fupload"]["tmp_name"], $vfile_upload);
}

function Uploadrisk($fupload_name){
  //direktori file
  $vdir_upload = "../../kajianresiko/";
  $vfile_upload = $vdir_upload . $fupload_name;

  //Simpan file
  move_uploaded_file($_FILES["fupload1"]["tmp_name"], $vfile_upload);
}

function UploadSCAPA($fupload_name){
  //direktori file
  $vdir_upload = "../../scapa/";
  $vfile_upload = $vdir_upload . $fupload_name;

  //Simpan file
  move_uploaded_file($_FILES["fupload"]["tmp_name"], $vfile_upload);
}

function UploadCAPA($fupload_name){
  //direktori file
  $vdir_upload = "../../capa/";
  $vfile_upload = $vdir_upload . $fupload_name;

  //Simpan file
  move_uploaded_file($_FILES["fupload"]["tmp_name"], $vfile_upload);
}

function UploadJCAPA($fupload_name){
  //direktori file
  $vdir_upload = "../../jwb_capa/";
  $vfile_upload = $vdir_upload . $fupload_name;

  //Simpan file
  move_uploaded_file($_FILES["fupload"]["tmp_name"], $vfile_upload);
}

function thread_create() {
    $user = mysql_fetch_array(mysql_query(
        sprintf("SELECT cSession AS session FROM users WHERE cUser = '%s' LIMIT 1", $_SESSION['nppcv'])
    ));
    $cc = mysql_fetch_array(mysql_query(
        "SELECT ccid as id, ccperihal1 as name FROM ccinter ORDER BY ccid DESC LIMIT 1"
    ));
    
    if (empty($cc)) {
        return;
    }
    
    $post = array(
        'name' => $cc['name'],
        'id' => $cc['id'],
        'mod' => 'cc',
    );
    
    $curl = curl_init(sprintf("https://thread.ekfpb.com/api/v1/sso/ekfpb/store?s=%s", $user['session']));
    curl_setopt($curl, CURLOPT_RETURNTRANSFER, 1);
    curl_setopt($curl, CURL_POST, 1);
    curl_setopt($curl, CURLOPT_POSTFIELDS, $post);
    $response = curl_exec($curl);
    curl_close($curl);
}

function thread_sync_participants($id) {
    $user = mysql_fetch_array(mysql_query(
        sprintf("SELECT cSession AS session FROM users WHERE cUser = '%s' LIMIT 1", $_SESSION['nppcv'])
    ));
    
    $cc = mysql_fetch_array(mysql_query(
        sprintf("SELECT ccid as id FROM ccinter WHERE ccid = %d", $id)
    ));
    
    if (empty($cc)) {
        return;
    }
    
    $participants = [];
    
    $statement = mysql_query(sprintf(
        "SELECT users.cUser as username FROM ccsin JOIN users ON ccsin.cId = users.cId WHERE ccid = %d", $id
    ));
    
    while (true) {
        $participant = mysql_fetch_array($statement);
        
        if ($participant) {
            $participants[] = $participant['username'];
        } else {
            break;
        }
    }
    
    $statement = mysql_query(sprintf(
        "SELECT users.cUser as username FROM csin JOIN users ON csin.cId = users.cId WHERE ccid = %d", $id
    ));
    
    while (true) {
        $participant = mysql_fetch_array($statement);
        
        if ($participant) {
            $participants[] = $participant['username'];
        } else {
            break;
        }
    }
    
    $post = [
        'id' => $id,
        'mod' => 'cc',
    ];
    
    foreach ($participants as $i => $participant) {
        $post["participants[$i]"] = strtolower($participant);
    }
    
    $curl = curl_init(sprintf("https://thread.ekfpb.com/api/v1/sso/ekfpb/participants?s=%s", $user['session']));
    curl_setopt($curl, CURLOPT_RETURNTRANSFER, 1);
    curl_setopt($curl, CURL_POST, 1);
    curl_setopt($curl, CURLOPT_POSTFIELDS, $post);
    $response = curl_exec($curl);
    curl_close($curl);
}

function thread_set_status($id, $open) {
    $user = mysql_fetch_array(mysql_query(
        sprintf("SELECT cSession AS session FROM users WHERE cUser = '%s' LIMIT 1", $_SESSION['nppcv'])
    ));
    
    $cc = mysql_fetch_array(mysql_query(
        sprintf("SELECT ccid as id FROM ccinter WHERE ccid = %d", $id)
    ));
    
    if (empty($cc)) {
        return;
    }
    
    $post = array(
        'id' => $cc['id'],
        'mod' => 'cc',
        'open' => $open ? 1 : 0,
    );
    
    $curl = curl_init(sprintf("https://thread.ekfpb.com/api/v1/sso/ekfpb/status?s=%s", $user['session']));
    curl_setopt($curl, CURLOPT_RETURNTRANSFER, 1);
    curl_setopt($curl, CURL_POST, 1);
    curl_setopt($curl, CURLOPT_POSTFIELDS, $post);
    $response = curl_exec($curl);
    curl_close($curl);
}

function thread_create_teknik() {
    $user = mysql_fetch_array(mysql_query(
        sprintf("SELECT cSession AS session FROM users WHERE cUser = '%s' LIMIT 1", $_SESSION['nppcv'])
    ));
    
    $spptek = mysql_fetch_array(mysql_query(
        "SELECT siid as id, keluhan as name, spptek.* FROM spptek ORDER BY siid DESC LIMIT 1"
    ));
    
    
    if (empty($spptek)) {
        return;
    }
    
    $post = array(
        'name' => $spptek['name'],
        'id' => $spptek['id'],
        'mod' => 'teknik',
    );
    
    $curl = curl_init(sprintf("https://thread.ekfpb.com/api/v1/sso/ekfpb/store?s=%s", $user['session']));
    curl_setopt($curl, CURLOPT_RETURNTRANSFER, 1);
    curl_setopt($curl, CURL_POST, 1);
    curl_setopt($curl, CURLOPT_POSTFIELDS, $post);
    $response = curl_exec($curl);
    curl_close($curl);
    
    $participants = [];
    $statement = mysql_query(sprintf("select cUser as username from users where cId in (%d, %d, %d)", $spptek['sipengirim'], $spptek['sipengirim1'], $spptek['sipengirim2']));
    
    while (true) {
        $participant = mysql_fetch_array($statement);
        
        if ($participant) {
            $participants[] = $participant['username'];
        } else {
            break;
        }
    }
    
    $post = [
        'id' => $spptek['id'],
        'mod' => 'teknik',
    ];
    
    foreach ($participants as $i => $participant) {
        $post["participants[$i]"] = strtolower($participant);
    }
    
    $curl = curl_init(sprintf("https://thread.ekfpb.com/api/v1/sso/ekfpb/participants?s=%s", $user['session']));
    curl_setopt($curl, CURLOPT_RETURNTRANSFER, 1);
    curl_setopt($curl, CURL_POST, 1);
    curl_setopt($curl, CURLOPT_POSTFIELDS, $post);
    $response = curl_exec($curl);
    curl_close($curl);
}

function thread_sync_participant($id) {
    $user = mysql_fetch_array(mysql_query(
        sprintf("SELECT cSession AS session FROM users WHERE cUser = '%s' LIMIT 1", $_SESSION['nppcv'])
    ));
    
    $spptek = mysql_fetch_array(mysql_query(
        "SELECT siid as id, keluhan as name, spptek.* FROM spptek WHERE siid = $id ORDER BY siid DESC LIMIT 1"
    ));
    
    
    if (empty($spptek)) {
        return;
    }
    $append = '';
    $participants = ['a02','a03'];
    switch ($spptek['jenispptek']) {
        case 'MP':
            $append = 13; break;
        case 'LAL':
            $append = 14; break;
        case 'LAK':
            $append = 15; break;
        case 'APL':
            $append = 12; break;
        case 'BS':
            $append = 19; break;
        case 'SB':
            $append = 20; break;
        case 'STUDC':
            $append = 18; break;
        case 'PA':
            $append = 21; break;
        case 'PBT':
            $append = 16; break;
        case 'GTK':
            $append = 16; break;
        case 'SPV':
            $append = 11; break;
    }
    if(!empty($append)){
        $stmt = mysql_query(sprintf("select cUser as username from users where cId in (%d, %d, %d, %d)", $spptek['sipengirim'], $spptek['sipengirim1'], $spptek['sipengirim2'], $append));
    
        while (true) {
            $participant = mysql_fetch_array($stmt);
            
            if ($participant) {
                $participants[] = $participant['username'];
            } else {
                break;
            }
        }
    }
    
    
    $post = [
        'id' => $spptek['id'],
        'mod' => 'teknik',
    ];
    
    foreach ($participants as $i => $participant) {
        $post["participants[$i]"] = strtolower($participant);
    }
    
    $curl = curl_init(sprintf("https://thread.ekfpb.com/api/v1/sso/ekfpb/participants?s=%s", $user['session']));
    curl_setopt($curl, CURLOPT_RETURNTRANSFER, 1);
    curl_setopt($curl, CURL_POST, 1);
    curl_setopt($curl, CURLOPT_POSTFIELDS, $post);
    $response = curl_exec($curl);
    curl_close($curl);
}

function thread_set_status_teknik($id, $open) {
    $user = mysql_fetch_array(mysql_query(
        sprintf("SELECT cSession AS session FROM users WHERE cUser = '%s' LIMIT 1", $_SESSION['nppcv'])
    ));
    
    $post = array(
        'id' => $id,
        'mod' => 'teknik',
        'open' => $open ? 1 : 0,
    );
    
    $curl = curl_init(sprintf("https://thread.ekfpb.com/api/v1/sso/ekfpb/status?s=%s", $user['session']));
    curl_setopt($curl, CURLOPT_RETURNTRANSFER, 1);
    curl_setopt($curl, CURL_POST, 1);
    curl_setopt($curl, CURLOPT_POSTFIELDS, $post);
    $response = curl_exec($curl);
    curl_close($curl);
}


?>

