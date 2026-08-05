<?php
$file = 'config/fungsi_thumb.php';
$content = file_get_contents($file);

$search = '//Simpan gambar dalam ukuran sebenarnya

  move_uploaded_file($_FILES["fupload"]["tmp_name"], $vfile_upload);';

$replace = 'if (!is_dir($vdir_upload)) {
      mkdir($vdir_upload, 0777, true);
  }

  //Simpan gambar dalam ukuran sebenarnya

  move_uploaded_file($_FILES["fupload"]["tmp_name"], $vfile_upload);';

$content = str_replace($search, $replace, $content);
file_put_contents($file, $content);
echo "Updated UploadFoto successfully.";
?>
