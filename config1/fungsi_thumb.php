<?php
function UploadFile($fupload_name){
  //direktori file
  $vdir_upload = "../../file_upd/";
  $vfile_upload = $vdir_upload . $fupload_name;

  //Simpan file dalam ukuran sebenarnya
  move_uploaded_file($_FILES["fupload"]["tmp_name"], $vfile_upload);
}

function UploadFile1($fupload_name){
  //direktori file
  $vdir_upload = "../../file_memo/";
  $vfile_upload = $vdir_upload . $fupload_name;

  //Simpan file dalam ukuran sebenarnya
  move_uploaded_file($_FILES["fupload"]["tmp_name"], $vfile_upload);
}

function UploadFile2($fupload_name){
  //direktori file
  $vdir_upload = "../../file_koreksi/";
  $vfile_upload = $vdir_upload . $fupload_name;

  //Simpan file dalam ukuran sebenarnya
  move_uploaded_file($_FILES["fupload"]["tmp_name"], $vfile_upload);
}

function UploadFile3($fupload_name){
  //direktori file
  $vdir_upload = "../../file_sosial/";
  $vfile_upload = $vdir_upload . $fupload_name;

  //Simpan file dalam ukuran sebenarnya
  move_uploaded_file($_FILES["fupload"]["tmp_name"], $vfile_upload);
}




?>
