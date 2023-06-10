<?php
require "../connection/koneksi.php";
require "../connection/session.php";
require "proses.php";
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>DATA USER</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-BmbxuPwQa2lc/FVzBcNJ7UAyJxM6wuqIj61tLrc4wSX0szH/Ev+nYRRuWlolflfl" crossorigin="anonymous">
    <link rel="stylesheet" href="style.css">
</head>

<body>
    <div class="mx-auto">
        <!-- untuk memasukkan data -->
        <div class="card">
            <div class="card-header">
                Registrasi Akun
            </div>
            <div class="card-body">
                <?php if ($error) { ?>
                    <div class="alert alert-danger" role="alert">
                        <?php echo $error ?>
                    </div>
                    <?php header("refresh:2;url=index.php"); //5 : detik
                    ?>
                <?php } ?>
                <?php if ($sukses) { ?>
                    <div class="alert alert-success" role="alert">
                        <?php echo $sukses ?>
                    </div>
                    <?php header("refresh:2;url=index.php");
                    ?>
                <?php } ?>
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
                            <input type="text" class="form-control" id="email" name="email" value="<?php echo $email ?>" require>
                        </div>
                    </div>
                    <div class="pw mb-3 row">
                        <label for="pass" class="col-sm-2 col-form-label">PASSWORD</label>
                        <div class="len-pw col-sm-10">
                            <input type="password" class="form-control" id="password" name="pass" value="<?php echo $password ?>" require>  
                            <i class="fa fa-eye" aria-hidden="true"></i>
                        </div>
                    </div>
                    <div class="mb-3 row">
                        <label for="sebagai" class="col-sm-2 col-form-label">SEBAGAI</label>
                        <div class="col-sm-10">
                            <select class="form-control" name="sebagai" require>
                                <option value="" hidden></option>
                                <option value="Admin" <?php if ($sebagai == 'Admin') echo 'selected' ?>>Admin</option>
                                <option value="Guru" <?php if ($sebagai == 'Guru') echo 'selected' ?>>Guru</option>
                            </select>
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
                        $sql2 = "SELECT * FROM user ORDER BY id_user ASC";
                        $q2 = mysqli_query($koneksi, $sql2);
                        $urut = 1;
                        while ($r2 = mysqli_fetch_array($q2)) {
                            $id_user = $r2['id_user'];
                            $nama_user = $r2['nama_user'];
                            $email = $r2['email'];
                            $pass = $r2['pass'];
                            $sebagai = $r2['sebagai'];
                        ?>
                            <tr>
                                <th scope="row"><?php echo $urut++ ?></th>
                                <td scope="row"><?php echo $nama_user ?></td>
                                <td scope="row"><?php echo $email ?></td>
                                <td scope="row"><?php echo $pass ?></td>
                                <td scope="row"><?php echo $sebagai ?></td>
                                <td scope="row">
                                    <a href="index.php?op=edit&id_user=<?php echo $id_user ?>"><button type="button" class="btn btn-warning">Edit</button></a>
                                    <a href="index.php?op=delete&id_user=<?php echo $id_user ?>" onclick="return confirm('Yakin mau delete data?')"><button type="button" class="btn btn-danger">Delete</button></a>
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
    <script src="https://unpkg.com/@popperjs/core@2.10.2/dist/umd/popper.min.js"></script>
    <script src="https://unpkg.com/bootstrap@5.0.0-beta2/dist/js/bootstrap.min.js"></script>
    <script>
        function togglePasswordVisibility() {
            var passwordInput = document.getElementById("password");
            var passwordEye = document.querySelector(".password-eye");
            if (passwordInput.type === "password") {
                passwordInput.type = "text";
                passwordEye.innerHTML = '<i class="bi bi-eye-slash"></i>';
            } else {
                passwordInput.type = "password";
                passwordEye.innerHTML = '<i class="bi bi-eye"></i>';
            }
        }
    </script>
</body>

</html>