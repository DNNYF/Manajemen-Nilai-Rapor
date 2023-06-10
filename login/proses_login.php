<?php
    if(isset($_POST['submit'])){
        $email = mysqli_real_escape_string($koneksi,$_POST['email']);
        $pass = mysqli_real_escape_string($koneksi,$_POST['pass']);
        $query = mysqli_query($koneksi,"SELECT * FROM user WHERE email='$email'");
        $data = mysqli_fetch_array($query);
        if(mysqli_num_rows($query) > 0){
            if($pass == $data['pass']){
                $_SESSION['logged_in'] = true ;
                $_SESSION['sebagai'] = $data['sebagai'];
                if($_SESSION['sebagai'] == "Admin"){
                    header("location:../siswa/crudSiswa.php");
                    }elseif($_SESSION['sebagai'] == "Guru"){
                        header("location:../user/index.php");
                        };
            }else{
                echo "<script>alert('Email atau Password Anda Salah')</script>";
            }
        }
        else{
            echo "<script>alert('Akun Tidak Tersedia')</script>";
            echo "<script>window.location='login.php'</script>";
        }
    }
?>
