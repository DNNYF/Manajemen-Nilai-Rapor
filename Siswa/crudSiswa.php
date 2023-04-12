<?php
$host       = "localhost";
$user       = "root";
$pass       = "";
$db         = "erapor";

$koneksi    = mysqli_connect($host, $user, $pass, $db); //menghubungkan database
if (!$koneksi) {
    die("Tidak dapat terkoneksi ke database");
}
// deklarasi varible data siswa
$nikSiswa   = "";
$nisn       = "";
$namaSiswa  = "";
$jkSiswa    = "";
$tgLahir    = "";
$namaIbu    = "";
$error      = "";
$sukses     = "";
$op         = "";

$idSiswa = "";
if (isset($_GET['idSiswa'])) {
    $idSiswa = $_GET['idSiswa'];
}

if (isset($_GET['op'], $idSiswa) && $_GET['op'] == 'edit') {
    $sql = "SELECT * FROM siswa WHERE idSiswa = ?";
    $stmt = mysqli_prepare($koneksi, $sql);
    mysqli_stmt_bind_param($stmt, 'i', $idSiswa);
    mysqli_stmt_execute($stmt);
    $r1 = mysqli_stmt_get_result($stmt);
    if (mysqli_num_rows($r1) > 0) {
        $siswa = mysqli_fetch_assoc($r1);
        $nisn = $siswa['nisn'];
        $namaSiswa = $siswa['namaSiswa'];
        $jkSiswa = $siswa['jkSiswa'];
        $tgLahir = $siswa['tgLahir'];
        $namaIbu = $siswa['namaIbu'];
        $nikSiswa = $siswa['nikSiswa'];
    } else {
        $error = "Data Tidak Ditemukan";
    }
}


//untuk menangkap nilai yang di inputkan
// input dari elemen name="nisn" dimasukan ke variable $nisn
if (isset($_POST['simpan'])) {
    $nikSiswa   = mysqli_real_escape_string($koneksi, $_POST['nikSiswa']);
    $nisn       = mysqli_real_escape_string($koneksi, $_POST['nisn']);
    $namaSiswa  = mysqli_real_escape_string($koneksi, $_POST['namaSiswa']);
    $jkSiswa    = mysqli_real_escape_string($koneksi, $_POST['jkSiswa']);
    $tgLahir    = mysqli_real_escape_string($koneksi, $_POST['tgLahir']);
    $namaIbu    = mysqli_real_escape_string($koneksi, $_POST['namaIbu']);

    //mengirim variable ke database
    if ($namaSiswa && $jkSiswa && $tgLahir && $namaIbu && $nikSiswa && $nisn) {
        $sql1 = "INSERT INTO siswa (nama, jkSiswa, tglahir, data_ibu, nikSiswa, nisn) VALUES ('$namaSiswa', '$jkSiswa', '$tgLahir', '$namaIbu', '$nikSiswa', '$nisn')";
        try {
            $q1 = mysqli_query($koneksi, $sql1);
            if ($q1) {
                $sukses = "Berhasil memasukan data baru";
            } else {
                $error = "Gagal Menambahkan Data";
            }
        } catch (mysqli_sql_exception $e) {
            if (strpos($e->getMessage(), 'Duplicate entry') !== false) {
                $error = "Gagal Menambahkan data";
            } else {
                $error = $e->getMessage();
            }
        }
    } else {
        $error = "Silahkan masukan Data";
    }
}

?>


<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">

    <style>
        .mx-auto {
            width: 900px;
        }

        .card {
            margin-top: 10px;
        }

        .head {
            text-align: center;
            vertical-align: middle;
            ;
        }

        .table-position {
            vertical-align: middle;
            ;
            text-align: center;
        }

        .data {
            width: 90%;
        }
    </style>

    <title>CRUD</title>
</head>

<body>
    <div class="mx-auto">
        <div class="card">
            <!-- memasukan data siswa -->
            <h5 class="card-header">Create/Edit Data</h5>
            <!-- menampilkan berhasil atau gagal menambahkan data -->
            <?php
            if ($error) {
                echo '<div class="alert alert-danger" role="alert">' . $error . '</div>';
            }
            if ($sukses) {
                echo '<div class="alert alert-success" role="alert">' . $sukses . '</div>';
            }
            ?>
            <div class="card-body">
                <form action="" method="POST">
                    <div class="mb-3 row">
                        <label for="nikSiswa" class="col-sm-2 col-form-label">NIK</label>
                        <div class="col-sm-10">
                            <input type="text" class="form-control" placeholder="NIK" name="nikSiswa" value="<?php echo $nikSiswa ?>">
                        </div>
                    </div>
                    <div class="mb-3 row">
                        <label for="nisn" class="col-sm-2 col-form-label">NISN</label>
                        <div class="col-sm-10">
                            <input type="text" class="form-control" placeholder="NISN" name="nisn" value="<?php echo $nisn ?>">
                        </div>
                    </div>
                    <div class="mb-3 row">
                        <label for="namaSiswa" class="col-sm-2 col-form-label">Nama</label>
                        <div class="col-sm-10">
                            <input type="text" class="form-control" placeholder="Nama" name="namaSiswa" value="<?php echo $namaSiswa ?>">
                        </div>
                    </div>
                    <div class="mb-3 row">
                        <label for="jkSiswa" class="col-sm-2 col-form-label">Jenis Kelamin</label>
                        <div class="col-sm-10">
                            <select class="form-control" name="jkSiswa">
                                <option value="">- Jenis kelamin -</option>
                                <option value="L" <?php if ($jkSiswa == "L") echo "Selected" ?>>Laki-Laki</option>
                                <option value="P" <?php if ($jkSiswa == "P") echo "Selected" ?>>Perempuan</option>
                            </select>

                        </div>
                    </div>
                    <div class="mb-3 row">
                        <label for="tgLahir" class="col-sm-2 col-form-label">Tanggal Lahir</label>
                        <div class="col-sm-10">
                            <input type="date" class="form-control" name="tgLahir">
                        </div>
                    </div>
                    <div class="mb-3 row">
                        <label for="dataIbu" class="col-sm-2 col-form-label">Data Ibu</label>
                        <div class="col-sm-10">
                            <input type="text" class="form-control" name="namaIbu" placeholder="Data Ibu">
                        </div>
                    </div>
                    <div class="button col-12">
                        <input type="submit" name="simpan" value="Simpan Data" class="btn btn-primary">
                    </div>
                </form>
            </div>
        </div>
    </div>
    </div>
    <!-- menampilkan data siswa -->
    <div class="data mx-auto">
        <div class="card">
            <h5 class="card-header  text-white bg-primary">Data Siswa</h5>
            <div class="card-body">
                <table class="table table-bordered table-hover">
                    <thead>
                        <tr class="head">
                            <th scope="col">#</th>
                            <th scope="col">NAMA</th>
                            <th scope="col">JENIS KELAMIN</th>
                            <th scope="col">TANGGAL LAHIR</th>
                            <th scope="col">DATA IBU</th>
                            <th scope="col">NIK</th>
                            <th scope="col">NISN</th>
                            <th scope="col">AKSI</th>
                        </tr>
                    <tbody class="table-position">
                        <?php
                        $sql2   = "SELECT * FROM siswa order by idSiswa asc";
                        $q2     = mysqli_query($koneksi, $sql2);
                        $urut   = 1;
                        while ($r2 = mysqli_fetch_array($q2)) {
                            $idSiswa    = $r2['idSiswa'];
                            $namaSiswa  = $r2['namaSiswa'];
                            $jkSiswa    = $r2['jkSiswa'];
                            $tgLahir    = $r2['tgLahir'];
                            $namaIbu    = $r2['namaIbu'];
                            $nikSiswa   = $r2['nikSiswa'];
                            $nisn       = $r2['nisn'];
                        ?>

                            <tr>
                                <th scope="row"><?php echo $urut++ ?></th>
                                <td scope="row"><?php echo $namaSiswa ?></td>
                                <td scope="row" class="jk"><?php echo $jkSiswa ?></td>
                                <td scope="row"><?php echo $tgLahir ?></td>
                                <td scope="row"><?php echo $namaIbu ?></td>
                                <td scope="row"><?php echo $nikSiswa ?></td>
                                <td scope="row"><?php echo $nisn ?></td>
                                <td scope="row">
                                    <a href="crudSiswa.php?op=edit&id=<?php echo $idSiswa ?>"><button type="button" class="btn btn-warning">Edit</button></a>
                                    <a href="crudSiswa.php?op=edit&id=<?php echo $idSiswa ?>"><button type="button" class="btn btn-danger">Delete</button></a>
                                </td>

                            </tr>

                        <?php
                        }
                        ?>
                    </tbody>
                    </thead>
                </table>
            </div>
        </div>
</body>

</html>