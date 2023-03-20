<?php
    session_start();
    if(empty($_SESSION['username']))
    {
    header("location:login.php?pesan=belum_login");
    }
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>INPUT DATA</title>
   
<link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.1/css/all.min.css" rel="stylesheet" />
<link href="https://fonts.googleapis.com/css?family=Roboto:300,400,500,700&display=swap" rel="stylesheet"/>
<link href="https://cdnjs.cloudflare.com/ajax/libs/mdb-ui-kit/3.6.0/mdb.min.css" rel="stylesheet" /> 
<link rel="stylesheet" href="aset/style/pages.css">
<link rel="icon" href="aset/images/input.png" type="image/png">
</head>
<body>
<nav class="navbar navbar-expand-lg navbar-light shadow-5-strong">
 
  <div class="container">
   
    KRIPTOGRAFI / Ardhian Kusumayuda - 123200144
    <div class="collapse navbar-collapse" id="navbarButtonsExample">
    <ul class="navbar-nav ms-auto mb-2 mb-lg-0">
        <li class="nav-item text-white">
          <a class="nav-link active " aria-current="page">
          <?php
              $date = date('l, d/m/Y', time());
              echo " $date";
          ?>
          </a>
        </li>
      </ul>
      
      <div class="d-flex align-items-center p-3">
        <a type="button" class="btn btn-dark px-3 me-2" href="halaman_input_enkripsi.php">Enkripsi</a>
        <a type="button" class="btn btn-primary me-3"href="logout.php"> Logout</a>
      </div>
    </div>
  </div>
</nav>

<div class="container">
    <div class="row">
      <div class="col-lg-10 col-xl-9 mx-auto">
        <div class="card flex-row my-5 border-0 shadow rounded-3 overflow-hidden">
          <div class="card-body p-4 p-sm-5">
            <h5 class="card-title text-center mb-5 fw-dark fs-2">Data Diri Calon Ketua</h5>
            <hr>
            <form method="POST" action="">               
                <div class="form-floating mb-3">
                    <input type="id" class="form-control" id="id" name="id" required autofocus>
                    <label for="id">ID</label>
                </div>
                <div class="d-grid mb-2">
                    <button class="btn btn-lg btn-primary btn-login fw-bold text-uppercase" type="submit" name="submit">Input</button>
                </div>
            </form>
            <br><br>
            <?php
                if(isset($_POST['submit'])){ 
                    include "koneksi.php";  
                    include "aes.php";
                    include "aes-file.php";
                    $id = $_POST['id'];
                    $query = mysqli_query($koneksi, "SELECT * FROM data_input WHERE id=$id")
                    or die(mysqli_error($koneksi));
                    $query1     = "SELECT * FROM data_image WHERE id='$id'";
                    $sql1       = mysqli_query($koneksi,$query1);
                    $data       = mysqli_fetch_assoc($sql1);
                
                    $file_path  = $data['image'];
                    $key        = "abcdefghijuklmno0123456789012345";
                    $file_name  = $data['nama'];
                
                    $file_size  = filesize($file_path);
                
                
                    $mod        = $file_size%16;
                
                    $aes        = new AES($key);
                    $fopen1     = fopen($file_path, "rb");
                    $plain      = "";
                    $cache      = "file_dekrip/$file_name";
                    $fopen2     = fopen($cache, "wb");
                
                    if($mod==0){
                    $banyak = $file_size / 16;
                     }else{
                    $banyak = ($file_size - $mod) / 16;
                    $banyak = $banyak+1;
                    }
                
                    ini_set('max_execution_time', -1);
                    ini_set('memory_limit', -1);
                    for($bawah=0;$bawah<$banyak;$bawah++){
                
                      $filedata    = fread($fopen1, 16);
                      $plain       = $aes->decrypt($filedata);
                      fwrite($fopen2, $plain);
                   }                  
                  while ($data = mysqli_fetch_array($query)) { 
            ?>
            <table>
              <tbody>
                <tr>
                    <td>Nama</td>
                    <td width=100px align=right>:</td>
                    <td width=20>
                    <td>
                      <?php 
                        $aes = decrypt($data['nama']);
                        $rot = str_rot13($aes);
                        echo $rot;
                      ?>
                    </td> 
                </tr>

                <tr>
                  <td>Jenis Kelamin</td>
                  <td width=100px align=right>:</td>
                  <td width=20>
                  <td>
                    <?php 
                      $aes = decrypt($data['jk']);
                      $rot = str_rot13($aes);
                      echo $rot;
                    ?>
                  </td> 
                </tr>

                <tr>
                  <td>Umur</td>
                  <td width=100px align=right>:</td>
                  <td width=20>
                  <td>
                    <?php 
                      $aes = decrypt($data['umur']);
                      echo $aes;
                    ?>
                  </td> 
                </tr>

                <tr>
                  <td>Tempat Lahir</td>
                  <td width=100px align=right>:</td>
                  <td width=20>
                  <td>
                    <?php 
                      $aes = decrypt($data['tempat_lahir']);
                      $rot = str_rot13($aes);
                      echo $rot;
                    ?>
                  </td> 
                </tr>

                <tr>
                  <td>Tanggal Lahir</td>
                  <td width=100px align=right>:</td>
                  <td width=20>
                  <td>
                    <?php 
                      $aes = decrypt($data['tanggal_lahir']);
                      $rot = str_rot13($aes);
                      echo $rot;
                    ?>
                  </td>  
                </tr>
                     
                <tr>
                  <td>Foto</td>
                  <td width=100px align=right>:</td>
                  <td width=20>
                  <td>
                    <img src="file_dekrip/<?$file_name?>"
                  </td> 
                </tr>

              </tbody>
              </table>
              <?php }} ?>
          </div>
        </div>
      </div>
    </div>
  </div>
</body>
</html>
