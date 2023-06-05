<?php
$host       = "localhost";
$user       = "root";
$pass       = "";
$db         = "erapor";

$koneksi    = mysqli_connect($host, $user, $pass, $db);
if (!$koneksi) { //cek koneksi
    die("Tidak bisa terkoneksi ke database");
}
$nama_user   = "";
$email       = "";
$pass        = "";
$sebagai     = "";
$sukses      = "";
$error       = "";

if (isset($_GET['op'])) {
    $op = $_GET['op'];
} else {
    $op = "";
}
if($op == 'delete'){
    $id_user    = $_GET['id_user'];
    $sql1       = "delete from user where id_user = '$id_user'";
    $q1         = mysqli_query($koneksi,$sql1);
    if($q1){
        $sukses = "Berhasil hapus data";
    }else{
        $error  = "Gagal melakukan delete data";
    }
}
if ($op == 'edit') {
    $id_user    = $_GET['id_user'];
    $sql1       = "select * from user where id_user = '$id_user'";
    $q1         = mysqli_query($koneksi, $sql1);
    $r1         = mysqli_fetch_array($q1);
    $nama_user  = $r1['nama_user'];
    $email      = $r1['email'];
    $pass       = $r1['pass'];
    $sebagai    = $r1['sebagai'];

    if ($nama_user == '') {
        $error = "Data tidak ditemukan";
    }
}
if (isset($_POST['simpan'])) { //untuk create
    $nama_user   = $_POST['nama_user'];
    $email       = $_POST['email'];
    $pass        = $_POST['pass'];
    $sebagai     = $_POST['sebagai'];

    if ($nama_user && $email && $pass && $sebagai) {
        if ($op == 'edit') { //untuk update
            $sql1       = "update user set nama_user = '$nama_user',email='$email',pass= '$pass', sebagai= '$sebagai' where id_user = '$id_user'";
            $q1         = mysqli_query($koneksi, $sql1);
            if ($q1) {
                $sukses = "Data berhasil diupdate";
            } else {
                $error  = "Data gagal diupdate";
            }
        } else { //untuk insert
            $sql1   = "insert into user(nama_user,email,pass,sebagai) values ('$nama_user','$email','$pass','$sebagai')";
            $q1     = mysqli_query($koneksi, $sql1);
            if ($q1) {
                $sukses     = "Berhasil memasukkan data baru";
            } else {
                $error      = "Gagal memasukkan data";
            }
        }
    } else {
        $error = "Silahkan masukkan semua data";
    }
}
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>DATA USER</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-BmbxuPwQa2lc/FVzBcNJ7UAyJxM6wuqIj61tLrc4wSX0szH/Ev+nYRRuWlolflfl" crossorigin="anonymous">
    <style>
        .mx-auto {
            width: 800px
        }

        .card {
            margin-top: 30px;
        }
    </style>
</head>

<body>
    <button onclick="Back()">Back</button>
    <script>
        function Back() {
            window.history.back();
        }
    </script>
    <div class="mx-auto">
        <!-- untuk memasukkan data -->
        <div class="card">
            <div class="card-header">
                Create / Edit Data
            </div>
            <div class="card-body">
                <?php
                if ($error) {
                ?>
                    <div class="alert alert-danger" role="alert">
                        <?php echo $error ?>
                    </div>
                <?php
                    header("refresh:5;url=index.php");//5 : detik
                }
                ?>
                <?php
                if ($sukses) {
                ?>
                    <div class="alert alert-success" role="alert">
                        <?php echo $sukses ?>
                    </div>
                <?php
                    header("refresh:5;url=index.php");
                }

                ?>
                <form action="" method="POST">
                    <div class="mb-3 row">
                        <label for="nama_user" class="col-sm-2 col-form-label">NAMA</label>
                        <div class="col-sm-10">
                            <input type="text" class="form-control" id="nama_user" name="nama_user" value="<?php echo $nama_user ?>">
                        </div>
                    </div>
                    <div class="mb-3 row">
                        <label for="email" class="col-sm-2 col-form-label">EMAIL</label>
                        <div class="col-sm-10">
                            <input type="text" class="form-control" id="email" name="email" value="<?php echo $email ?>">
                        </div>
                    </div>
                    <div class="mb-3 row">
                        <label for="pass" class="col-sm-2 col-form-label">PASSWORD</label>
                        <div class="col-sm-10">
                            <input type="text" class="form-control" id="pass" name="pass" value="<?php echo $pass ?>">
                        </div>
                    </div>
                    <div class="mb-3 row">
                        <label for="sebagai" class="col-sm-2 col-form-label">SEBAGAI</label>
                        <div class="col-sm-10">
                            <input type="text" class="form-control" id="sebagai" name="sebagai" value="<?php echo $sebagai ?>">
                        </div>
                    </div>
                    <div class="col-12">
                        <input type="submit" name="simpan" value="Simpan Data" class="btn btn-primary" />
                    </div>
                </form>
            </div>
        </div>

        <!-- untuk mengeluarkan data -->
        <div class="card">
            <div class="card-header text-white bg-secondary">
                Data User
            </div>
            <div class="card-body">
                <table class="table">
                    <thead>
                        <tr>
                            <th scope="col">NO</th>
                            <th scope="col">NAMA</th>
                            <th scope="col">EMAIL</th>
                            <th scope="col">PASSWORD</th>
                            <th scope="col">SEBAGAI</th>
                            <th scope="col">AKSI</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php
                        $sql2   = "select * from user order by id_user desc";
                        $q2     = mysqli_query($koneksi, $sql2);
                        $urut   = 1;
                        while ($r2 = mysqli_fetch_array($q2)) {
                            $id_user    = $r2['id_user'];
                            $nama_user  = $r2['nama_user'];
                            $email      = $r2['email'];
                            $pass       = $r2['pass'];
                            $sebagai    = $r2['sebagai'];
                        ?>
                            <tr>
                                <th scope="row"><?php echo $urut++ ?></th>
                                <td scope="row"><?php echo $nama_user ?></td>
                                <td scope="row"><?php echo $email ?></td>
                                <td scope="row"><?php echo $pass ?></td>
                                <td scope="row"><?php echo $sebagai ?></td>
                                <td scope="row">
                                    <a href="index.php?op=edit&id=<?php echo $id_user ?>"><button type="button" class="btn btn-warning">Edit</button></a>
                                    <a href="index.php?op=delete&id=<?php echo $id_user ?>" onclick="return confirm('Yakin mau delete data?')"><button type="button" class="btn btn-danger">Delete</button></a>            
                                </td>
                            </tr>
                        <?php
                        }
                        ?>
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</body>
</html>