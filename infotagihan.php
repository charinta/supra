<?php
  session_start();
  require 'koneksi.php';

  if($_SESSION['nisn']){
    $nisn = $_SESSION['nisn']; 
    $result = mysqli_query($koneksi, "SELECT * FROM infotagihan WHERE nisn = '$nisn'");
  }
?>

<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8" />
  <meta http-equiv="X-UA-Compatible" content="IE=edge" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0" />
  <link rel="stylesheet" href="style.css" />
  <title>Informasi Tagihan</title>
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
      <table cellpadding="6">
        <?php while($row = mysqli_fetch_array($result)){?>
        <tr>
          <td>NISN</td>
          <td><?php echo $row["nisn"] ?></td>
        </tr>
        <tr>
          <td>Nama</td>
          <td><?php echo $row["nama"] ?></td>
        </tr>
        <tr>
          <td>Kelas</td>
          <td><?php echo $row["kelas"] ?></td>
        </tr>
        <tr>
          <td>Total</td>
          <td><?php echo $row["total"] ?></td>
        </tr>
        <tr>
          <td colspan="2">
            <a href="form.php"><button class="bayar">Bayar</button></a>
          </td>
        </tr>
        <?php }?>
      </table>
    </div>
  </div>
</body>

</html>