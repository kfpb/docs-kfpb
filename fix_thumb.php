<?php
$file = 'config/fungsi_thumb.php';
$content = file_get_contents($file);

// Remove the one we manually added to avoid duplicates
$content = str_replace(
"  if (!is_dir(\$vdir_upload)) {
      mkdir(\$vdir_upload, 0777, true);
  }

  //Simpan file
  move_uploaded_file(\$_FILES[\"fupload\"][\"tmp_name\"], \$vfile_upload);", 
"  //Simpan file
  move_uploaded_file(\$_FILES[\"fupload\"][\"tmp_name\"], \$vfile_upload);", $content);

// Now apply it to ALL functions where move_uploaded_file is called with $vdir_upload
$content = preg_replace(
    '/(\/\/Simpan [a-z]+(\r?\n)\s+move_uploaded_file)/',
    "if (!is_dir(\$vdir_upload)) {\n      mkdir(\$vdir_upload, 0777, true);\n  }\n\n  $1",
    $content
);

file_put_contents($file, $content);
echo "Updated config/fungsi_thumb.php successfully.";
?>
