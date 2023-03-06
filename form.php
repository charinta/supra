<?php
session_start();
include("koneksi.php");

if($_SESSION['nisn']){
  $nisn = $_SESSION['nisn']; 
  $result = mysqli_query($koneksi, "SELECT * FROM infotagihan WHERE nisn = '$nisn'");
  $row = mysqli_fetch_array($result);
} 

if(isset($_POST['submit'])){
  $nisn = $row['nisn'];
  $nama = $row['nama'];
  $kelas = $row['kelas'];
  $bank = $_POST['bank'];
  
  $target_dir = "images/";
  $bukti = basename($_FILES["bukti"]["name"]);
  
  move_uploaded_file($_FILES["bukti"]["tmp_name"], $target_dir . $bukti);


  $result = mysqli_query($koneksi, "INSERT INTO pembayaran(nisn, nama, kelas, bank, bukti)
  VALUES('$nisn', '$nama', '$kelas', '$bank', '$bukti')");

  $read = mysqli_query($koneksi,"SELECT * FROM pembayaran where nisn='$nisn'");

  header("Location:hasil.php");
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8" />
  <meta http-equiv="X-UA-Compatible" content="IE=edge" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0" />
  <link rel="stylesheet" href="style.css" />
  <title>Formulir Pembayaran SPP </title>
</head>

<body>
  <div class="topnav">
    <p>SMP BHAKTI MULYA PURBALINGGA</p>
    <a href="index.php"><button class="button">Beranda</button></a>
    <a href="contact.php"><button class="button">Contact</button></a>
    <a href="petunjuk.php"><button class="button">Petunjuk</button></a>
  </div>
  <div class="section">
    <div>
      <div class="container">
        <div class="card">
          <h3>Formulir Pembayaran</h3>
          <form action="#" method="post" enctype="multipart/form-data">
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
              <option value="bca">BCA</option>
              <option value="mandiri">Mandiri</option>
              <option value="bni">BNI</option>
              <option value="bri">BRI</option>
            </select>

            <br /><br />
            Bukti Transfer <br>
            <input type="file" name="bukti" accept="image/*" />
            <br /><br />
            <button class="bayar" type="submit" name="submit">Kirim File</button>
          </form>
        </div>
      </div>
      <?php
        if(isset($pembayaran)){
          while ($pembayaran = mysqli_fetch_array($read)){
            echo "<div class='card'>";
            echo "<h1>Berhasil Membayar</h1>";
            echo "<ul>";
            echo "<li>NISN: " . $_POST['nisn'] . "</li>";
            echo "<li>Nama: " . $_POST['nama'] . "</li>";
            echo "<li>Kelas: " . $_POST['kelas'] . "</li>";
            echo "<li>Melalui: " . $_POST['bank'] . "</li>";
            echo "<li></li><img src='./images/$pembayaran[bukti]' width='70' /></li>";
            echo "</ul";
            echo "<p>Mau diedit?</p>";
            echo "<a href='update.php?nisn=$pembayaran[nisn]'>Edit</a>";
            echo "</div>";
          }
        }
        ?>
    </div>


    <?php
//error_reporting(E_ERROR | E_PARSE);
  
// if(isset($_POST['btn-upload']))
// {
// $bukti = date("d-m-Y h:i:s a")."-".$_POST['nama']."-".$_POST['namaBarang']."-".$_POST['bank']."-".$_FILES['bukti']['name'];
// $bukti_loc = $_FILES['bukti']['tmp_name'];
// $folder="images/";
// if(move_uploaded_file($bukti_loc,$folder.$bukti)){
// ?><script>
    //     alert('Upload file berhasil');
    //     
    </script><?php
// }else {
// ?><script>
    //     alert('Gagal upload, silakan ulangi kembali');
    //     
    </script><?php
// }
// }
// ?>

</body>

</html>