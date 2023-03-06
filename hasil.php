<?php
session_start();

include("koneksi.php"); 
  $nisn = $_SESSION['nisn'];
  $read = mysqli_query($koneksi,"SELECT * FROM pembayaran where nisn='$nisn'");
?>

<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8" />
  <meta http-equiv="X-UA-Compatible" content="IE=edge" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0" />
  <link rel="stylesheet" href="style.css" />
  <title>Hasil Pembayaran</title>
</head>

<body>
  <div class="topnav">
    <p>SMP BHAKTI MULYA PURBALINGGA</p>
    <a href="index.php"><button class="button">Beranda</button></a>
    <a href="contact.php"><button class="button">Contact</button></a>
    <a href="petunjuk.php"><button class="button">Petunjuk</button></a>
  </div>
  <br>
  <div class="section">
    <div class="container">
      <?php
      while ($row = mysqli_fetch_array($read)){
        echo "<div class='card'>";
        echo "<h1>Berhasil Membayar</h1>";
        echo "<ul>";
        echo "<li>NISN: " . $row['nisn'] . "</li>";
        echo "<li>Nama: " . $row['nama'] . "</li>";
        echo "<li>Kelas: " . $row['kelas'] . "</li>";
        echo "<li>Melalui: " . $row['bank'] . "</li>";
        echo "<li>Bukti: </li>";
        echo "<img src='./images/$row[bukti]' width='70' />";
        echo "</ul>";
        echo "<a href='update.php?nisn=$row[nisn]'><button class='btn1'>Edit</button></a>";
        echo "<a href='index.php'><button class='btn1'>Selesai</button></a>";
        echo "</div>";
      }
      ?>
    </div>
  </div>
</body>

</html>