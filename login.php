<?php
session_start();

if (isset($_SESSION['login'])) { 
header("Location: index.php"); 
exit;
}

require 'koneksi.php';

if (isset($_POST['submit'])) {
  if ($_POST['nisn'] == 'admin'){
    header("location: admin.php");
  }
  $nisn = $_POST['nisn']; 
  $password = $_POST['password'];
  $result = mysqli_query($koneksi, "SELECT * FROM siswa WHERE nisn = '$nisn'");

  //cek Username
  if (mysqli_num_rows($result) === 1) { 

      //cek password
    $row = mysqli_fetch_array($result); 
    if ($password == $row['password']) {

        //set session$_SESSION["login"] = true;
      $_SESSION["nisn"] = $nisn; 
      $_SESSION["password"] = $password; 
      header("Location: infotagihan.php"); 
      exit;
    } 
  }
  $error = true; 
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8" />
  <meta http-equiv="X-UA-Compatible" content="IE=edge" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0" />
  <link rel="stylesheet" href="style.css" />
  <title>Login</title>
</head>

<body>
  <div class="topnav">
    <p>SMP BHAKTI MULYA PURBALINGGA</p>
    <a href="index.php"><button class="button">Beranda</button></a>
    <a href="contact.php"><button class="button">Contact</button></a>
    <a href="petunjuk.php"><button class="button">Petunjuk</button></a>
  </div>
  <div class="container">
    <div class="card">
      <h1 align="center">SELAMAT DATANG</h1>
      <?php if (isset($error)) : ?>
      <p style="color: red; font-style:italic;">Password atau Username
        yang Anda masukkan salah!</p>
      <?php endif; ?>
      <form action="login.php" method="post" name="login">
        <table cellpadding="6">
          <tr>
            <td><img src="user.png" width="22px" height="22px" /></td>
            <td>
              <input type="text" name="nisn" placeholder="Username..." />
            </td>
          </tr>
          <tr>
            <td><img src="padlock.png" width="22px" height="22px" /></td>
            <td>
              <input type="password" name="password" placeholder="Password..." />
            </td>
          </tr>
          <tr>
            <td colspan="2">
              <input type="submit" name="submit" value="Login" />
            </td>
          </tr>
        </table>
      </form>
    </div>
  </div>
</body>

</html>