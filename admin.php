<?php
include("koneksi.php");
$read = mysqli_query($koneksi,"SELECT * FROM pembayaran order by nisn desc");
?>

<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8" />
  <meta http-equiv="X-UA-Compatible" content="IE=edge" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0" />
  <link rel="stylesheet" href="style.css" />
  <title>Admin</title>
</head>

<body>
  <div class="topnav">
    <p>SMP BHAKTI MULYA PURBALINGGA</p>
    <a href="index.php"><button class="button">Beranda</button></a>
    <a href="contact.php"><button class="button">Contact</button></a>
    <a href="petunjuk.php"><button class="button">Petunjuk</button></a>
  </div>
  <div class="section">
    <h1>Menampilkan data siswa</h1>
    <div class="card">
      <table border="1" cellpadding="6">
        <tr>
          <th>NISN</th>
          <th>Nama</th>
          <th>Kelas</th>
          <th>Bank</th>
          <th>Bukti</th>
          <th>Action </th>
        </tr>
        <?php
    while ($row = mysqli_fetch_array($read)) {
      echo "<tr align='center'>";
      echo "<td>".$row['nisn']."</td>";
      echo "<td>".$row['nama']."</td>";
      echo "<td>".$row['kelas']."</td>";
      echo "<td>".$row['bank']."</td>";
      echo "<td><img src='./images/$row[bukti]' width='70' /></td>";

      echo "<td><a href='update.php?nisn=$row[nisn]'><button class='bayar'>Edit</button></a> <br> <br> <a href='delete.php?id_pembayaran=$row[id_pembayaran]'><button class='bayar'>Delete</button></a></td></tr>";
    }
    ?>
    </div>
  </div>
</body>

</html>