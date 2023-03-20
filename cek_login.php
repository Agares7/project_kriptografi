<?php
    session_start();

    $query=new mysqli('localhost', 'root', '', 'karang_taruna');

    $username = $_POST['username'];
    $password = md5($_POST['password']);

    $data = mysqli_query($query,"select * from data where username='$username' and password='$password'")
    or die (mysqli_error($query));
    $cek = mysqli_num_rows($data);

    if($cek > 0)
    {
        $login = mysqli_fetch_assoc($data);
        $_SESSION['username'] = $username;
        header("location:halaman_input_enkripsi.php");        
    }
    else
    {
        header("location:login.php?pesan=gagal");
    } 
?>