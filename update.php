<?php
session_start();
include("koneksi.php");

$nisn = $_SESSION['nisn']; 

if($_SESSION['nisn']){
  $result = mysqli_query($koneksi, "SELECT * FROM pembayaran WHERE nisn = '$nisn'");
  $row = mysqli_fetch_array($result);
}

if(isset($_POST['submit'])) {
  $kelas = $_POST['kelas'];
  $bank = $_POST['bank'];

  $target_dir = "images/";
  $bukti = basename($_FILES["bukti"]["name"]);
  
  move_uploaded_file($_FILES["bukti"]["tmp_name"], $target_dir . $bukti);

  $result = mysqli_query($koneksi, "UPDATE pembayaran set bank = '$bank', bukti = '$bukti' where nisn='$nisn'");

  
  header("Location: hasil.php");
}
?>

<html>

<head>
  <meta charset="UTF-8" />
  <meta http-equiv="X-UA-Compatible" content="IE=edge" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0" />
  <link rel="stylesheet" href="style.css" />
  <title>Edit data</title>
</head>

<body>
  <div class="topnav">
    <p>SMP BHAKTI MULYA PURBALINGGA</p>
    <a href="index.php"><button class="button">Beranda</button></a>
    <a href="contact.php"><button class="button">Contact</button></a>
    <a href="petunjuk.php"><button class="button">Petunjuk</button></a>
  </div>
  </br>
  <div class="section">
    <div class="container">
      <div class="card">
        <a href="hasil.php"><button class="btn1">Batal</button></a> </br> <br>
        <h3 class="bouw">Formulir Pembayaran</h3>
        <form action="update.php" method="post" enctype="multipart/form-data">
          NISN <br>
          <?php echo $row['nisn']?>
          <br /><br />
          Nama <br>
          <?php echo $row['nama']?>
          <br /><br />
          Kelas <br>
          <?php echo $row['kelas']?>
          <br /><br />
          Pembayaran Melalui<br>
          <select class="bayar" name="bank" required oninvalid="this.setCustomValidity('Wajib dipilih')"
            oninput="setCustomValidity('')">
            <option value="">-- Pilih --</option>
            <option value="bca" <?php if($row['bank']=="bca") echo "selected"?>>BCA</option>
            <option value="mandiri" <?php if($row['bank']=="mandiri") echo "selected"?>>Mandiri</option>
            <option value="bni" <?php if($row['bank']=="bni") echo "selected"?>>BNI</option>
            <option value="bri" <?php if($row['bank']=="bri") echo "selected"?>>BRI</option>
          </select>

          <br /><br />
          Bukti Transfer <br>
          <img src='./images/<?php echo $row['bukti'];?>' width='70' />
          <input type="file" name="bukti" accept="image/*" />
          <br /><br />
          <button class="bayar" type="submit" name="submit">Kirim File</button>
        </form>
      </div>
    </div>
  </div>
</body>

</html>