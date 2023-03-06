<?php
$koneksi = mysqli_connect("localhost","root","","bayar_spp") or die("gagal koneksi");
function registrasi($data) 
{
  global $koneksi;
  $nisn = strtolower(stripslashes($data["nisn"])); 
  $password = $data['password'];

  //cek username sudah ada atau belum di database
  $result = mysqli_query($koneksi, "SELECT nisn FROM siswa WHERE 
  nisn='$nisn'");

  if (mysqli_fetch_array($result)) { 
  echo "<script>
  alert('Username sudah pernah terdaftar!'); 
  </script>";
  return false; 
  }
}
?>