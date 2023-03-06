<?php
// detel data
session_start();
include("koneksi.php");
$id_pembayaran=$_GET['id_pembayaran'];
$stmt=mysqli_query($koneksi,"delete from pembayaran where id_pembayaran='$id_pembayaran'");
header("Location:admin.php");
?>