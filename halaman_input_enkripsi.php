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
        <a type="button" class="btn btn-dark px-3 me-2" href="halaman_input_dekripsi.php">Dekripsi</a>
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
            <h5 class="card-title text-center mb-5 fw-dark fs-2">Input Data Diri Calon Ketua</h5>
            <hr>
            <form method="POST" action="data_input.php" enctype="multipart/form-data">  
              <div class="form-floating mb-3">
                    <input type="text" class="form-control" id="id" name="id" required autofocus readonly value="<?php echo(rand(1,10)); ?>">
                    <label for="id">ID</label>
                </div>             
                <div class="form-floating mb-3">
                    <input type="text" class="form-control" id="nama" name="nama" required autofocus>
                    <label for="nama">Nama Lengkap</label>
                </div>
                <div class="form-floating mb-3">
                    <select name="jk" class="form-select">
                      <option value="Laki-Laki">Laki-laki</option>
                      <option value="Perempuan">Perempuan</option>
                    </select>
                    <label for="Select" class="form-label">Jenis Kelamin</label>
                </div>
                <div class="form-floating mb-3">
                    <input type="text" class="form-control" id="umur" name="umur" required autofocus>
                    <label for="umur">Umur</label>
                </div>
                <div class="form-floating mb-3">
                    <input type="text" class="form-control" id="tempat_lahir" name="tempat_lahir" required autofocus>
                    <label for="tempat_lahir">Tempat Lahir</label>
                </div>
                <div class="form-floating mb-3">
                    <input type="text" class="form-control" id="tanggal_lahir" name="tanggal_lahir" required autofocus>
                    <label for="tanggal_lahir">Tanggal Lahir</label>
                </div>
                <div class="form-group mb-4">
                    <label for="foto">Foto KTP</label>
                    <input class="form-control mt-2" type="file" name="file" value="" />
                </div>
                <div class="d-grid mb-2">
                    <button class="btn btn-lg btn-primary btn-login fw-bold text-uppercase" name="submit" type="submit">Input</button>
                </div>

              <hr class="my-4">
            </form>
          </div>
        </div>
      </div>
    </div>
  </div>
</body>
</html>
