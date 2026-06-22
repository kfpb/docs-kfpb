<?php
session_start();
if(!isset($_SESSION['loginefile']))
{
   echo "<script>parent.location = '../../index.php';</script>";
   exit;
}
?>