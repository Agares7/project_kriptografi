<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Registrasi Pegwawai</title>
    <link rel="stylesheet" href="css_datamahasiswa.css">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3" crossorigin="anonymous">
</head>
<body>

<?php
    include "koneksi.php";
    include "aes.php";
    include "aes-file.php";

    $id = $_POST['id'];

    if (isset($_POST['submit'])) {
        $file_tmpname   = $_FILES['file']['tmp_name'];
        //untuk nama file url
        $file           = rand(1000,100000)."-".$_FILES['file']['name'];
        $new_file_name  = strtolower($file);
        $final_file     = str_replace(' ','-',$new_file_name);
        //untuk nama file
        $filename       = rand(1000,100000)."-".pathinfo($_FILES['file']['name'], PATHINFO_FILENAME);
        $new_filename  = strtolower($filename);
        $finalfile     = str_replace(' ','-',$new_filename);
        $size           = filesize($file_tmpname);
        $file_source		= fopen($file_tmpname, 'rb');
  
        $sql   = "INSERT INTO data_image VALUES ('$id', '$final_file','')";
        $query  = mysqli_query($koneksi,$sql) or die(mysqli_error($koneksi));

        $url   = $finalfile.".rda";
        $file_url = "file_enkrip/$url";

        $sql3   = "UPDATE data_image SET image ='$file_url' WHERE image =''";
        $query3  = mysqli_query($koneksi,$sql3) or die(mysqli_error($koneksi));
  
        $file_output = fopen($file_url, 'wb');
  
        $mod = $size%16;
        if($mod==0){
            $banyak = $size / 16;
        }else{
            $banyak = ($size - $mod) / 16;
            $banyak = $banyak+1;
        }
        $key = "abcdefghijuklmno0123456789012345";
        if(is_uploaded_file($file_tmpname)){
            ini_set('max_execution_time', -1);
            ini_set('memory_limit', -1);
            $aes = new AES($key);
  
           for($bawah=0;$bawah<$banyak;$bawah++){
               $data    = fread($file_source, 16);
               $cipher  = $aes->encrypt($data);
               fwrite($file_output, $cipher);
           }
           fclose($file_source);
           fclose($file_output);
  
           echo("<script language='javascript'>
            window.location.href='halaman_input_enkripsi.php';
            window.alert('Enkripsi Berhasil..');
            </script>");
        }else{
           echo("<script language='javascript'>
           window.location.href='halaman_input_enkripsi.php';
            window.alert('Encrypt file mengalami masalah..');
            </script>");
        }
    }

    $nama_rot = str_rot13($_POST['nama']);
    $nama = encrypt($nama_rot);

    $jk_rot = str_rot13($_POST['jk']);
    $jk = encrypt($jk_rot);

    $umur_ori = $_POST['umur'];
    $umur = encrypt($umur_ori);

    $tempat_lahir_rot = str_rot13($_POST['tempat_lahir']);
    $tempat_lahir = encrypt($tempat_lahir_rot);

    $tanggal_lahir_rot = str_rot13($_POST['tanggal_lahir']);
    $tanggal_lahir = encrypt($tanggal_lahir_rot);
    
    $query = mysqli_query($koneksi, "INSERT INTO data_input VALUES ('$id','$nama','$jk ','$umur','$tempat_lahir','$tanggal_lahir')")
    or die(mysqli_error($koneksi));

    if(!$query)
    {
        echo '<script> alert("Input gagl!") </script>';
        header("location:halaman_input_enkripsi.php");
    }
    else
    {
        echo '<script> alert("Input berhasil!") 
        window.location.href = "halaman_input_enkripsi.php";
        </script>';
    }
       
?>

</body>
</html>