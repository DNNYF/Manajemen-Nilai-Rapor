<?php
include "../connection/koneksi.php";

// deklarasi varible data siswa
$nikSiswa   = "";
$kelasSiswa = "";
$nisn       = "";
$namaSiswa  = "";
$jkSiswa    = "";
$tgLahir    = "";
$namaIbu    = "";
$error      = "";
$sukses     = "";
$op         = "";
$idSiswa    = "";
$kelasSiswa      = "";
$dapat      = "";
$q2         = "";


if (isset($_GET['op'])) {
    $op = $_GET['op'];
} else {
    $op = "";
}
if ($op == 'delete') {
    $idSiswa         = $_GET['idSiswa'];
    $sql1       = "DELETE FROM siswa WHERE idSiswa = '$idSiswa'";
    $q1         = mysqli_query($koneksi, $sql1);
    if ($q1) {
        $sukses = "Berhasil hapus data";
    } else {
        $error  = "Gagal melakukan delete data";
    }
}

$sqlkelas   = "SELECT kelas FROM kelas";
$qKelas     = mysqli_query($koneksi, $sqlkelas); //queryKelas
$nokel      = 1;

if ($op == 'edit') {
    $idSiswa    = $_GET['idSiswa'];
    $sql1       = "SELECT * FROM siswa WHERE idSiswa = '$idSiswa'";
    $q1         = mysqli_query($koneksi, $sql1);
    $r1         = mysqli_fetch_array($q1);
    $nikSiswa   = $r1['nikSiswa'];
    $nisn       = $r1['nisn'];
    $namaSiswa  = $r1['namaSiswa'];
    $jkSiswa    = $r1['jkSiswa'];
    $tgLahir    = $r1['tgLahir'];
    $kelasSiswa = $r1['kelasSiswa'];
    $namaIbu    = $r1['namaIbu'];
    if ($nikSiswa == '') {
        $error = "Data tidak ditemukan";
    }

    //untuk menangkap nilai yang di inputkan
    // input dari elemen name="nisn" dimasukan ke variable $nisn
    if (isset($_POST['edit'])) {
        $nikSiswa   = mysqli_real_escape_string($koneksi, $_POST['nikSiswa']);
        $nisn       = mysqli_real_escape_string($koneksi, $_POST['nisn']);
        $namaSiswa  = mysqli_real_escape_string($koneksi, $_POST['namaSiswa']);
        $jkSiswa    = mysqli_real_escape_string($koneksi, $_POST['jkSiswa']);
        $tgLahir    = mysqli_real_escape_string($koneksi, $_POST['tgLahir']);
        $namaIbu    = mysqli_real_escape_string($koneksi, $_POST['namaIbu']);
        $kelasSiswa = mysqli_real_escape_string($koneksi, $_POST['kelasSiswa']);

        //mengirim variable ke database
        if ($namaSiswa && $jkSiswa && $kelasSiswa && $nikSiswa && $nisn) {
            $sql1 = "UPDATE siswa SET namaSiswa = '$namaSiswa', jkSiswa = '$jkSiswa', kelasSiswa = '$kelasSiswa', tgLahir = '$tgLahir', namaIbu = '$namaIbu', nikSiswa = '$nikSiswa', nisn = '$nisn' WHERE idSiswa='$idSiswa'";
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
}

if (isset($_POST['simpan'])) {
    $nikSiswa       = mysqli_real_escape_string($koneksi, $_POST['nikSiswa']);
    $nisn           = mysqli_real_escape_string($koneksi, $_POST['nisn']);
    $namaSiswa      = mysqli_real_escape_string($koneksi, $_POST['namaSiswa']);
    $jkSiswa        = mysqli_real_escape_string($koneksi, $_POST['jkSiswa']);
    $tgLahir        = mysqli_real_escape_string($koneksi, $_POST['tgLahir']);
    $kelasSiswa     = mysqli_real_escape_string($koneksi, $_POST['kelasSiswa']);
    $namaIbu        = mysqli_real_escape_string($koneksi, $_POST['namaIbu']);

    //mengirim variable ke database
    if ($namaSiswa && $jkSiswa && $tgLahir && $kelasSiswa && $nikSiswa && $nisn) {
        $sql1 = "INSERT INTO siswa (namaSiswa, jkSiswa, tgLahir, kelasSiswa, namaIbu, nikSiswa, nisn) VALUES ('$namaSiswa', '$jkSiswa', '$tgLahir', '$kelasSiswa', '$namaIbu', '$nikSiswa', '$nisn')";
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
    <link rel="stylesheet" href="style.css">
    <script src="search.js"></script>


    <title>CRUD</title>
</head>

<body>
    <div class="mx-auto">
        <div class="card">
            <!-- memasukan data siswa -->
            <div class="card-header">
                <div class="title">
                    <a href="crudSiswa.php"><button class="back btn btn-warning"> Back </button></a>
                </div>
                <div class="">
                    <h4 class="s">CREATE / EDIT DATA</h4>
                </div>
            </div>
            <!-- menampilkan berhasil atau gagal menambahkan data -->
            <?php
            if ($error) {
                echo '<div class="alert alert-danger" role="alert">' . $error . '</div>';
                header("refresh:2;url=crudSiswa.php"); //2 : detik
            };
            ?>
            <?php
            if ($sukses) {
                echo '<div class="alert alert-success" role="alert">' . $sukses . '</div>';
                header("refresh:2;url=crudSiswa.php");
            };
            ?>
            <div class="card-body">
                <form action="" method="POST">
                    <div class="mb-3 row">
                        <label for="nikSiswa" class="col-sm-2 col-form-label">NIK *</label>
                        <div class="col-sm-10">
                            <input type="text" class="form-control" placeholder="NIK" name="nikSiswa" value="<?php echo $nikSiswa ?>">
                        </div>
                    </div>
                    <div class="mb-3 row">
                        <label for="nisn" class="col-sm-2 col-form-label">NISN *</label>
                        <div class="col-sm-10">
                            <input type="text" class="form-control" placeholder="NISN" name="nisn" value="<?php echo $nisn ?>">
                        </div>
                    </div>
                    <div class="mb-3 row">
                        <label for="namaSiswa" class="col-sm-2 col-form-label">Nama *</label>
                        <div class="col-sm-10">
                            <input type="text" class="form-control" placeholder="Nama" name="namaSiswa" value="<?php echo $namaSiswa ?>">
                        </div>
                    </div>
                    <div class="mb-3 row">
                        <label for="jkSiswa" class="col-sm-2 col-form-label">Jenis Kelamin *</label>
                        <div class="col-sm-10">
                            <select class="form-control" name="jkSiswa">
                                <option value="">- Jenis kelamin -</option>
                                <option value="L" <?php if ($jkSiswa == "L") echo "Selected" ?>>Laki-Laki</option>
                                <option value="P" <?php if ($jkSiswa == "P") echo "Selected" ?>>Perempuan</option>
                            </select>

                        </div>
                    </div>
                    <div class="mb-3 row">
                        <label for="tgLahir" class="col-sm-2 col-form-label">Tanggal Lahir *</label>
                        <div class="col-sm-10">
                            <input type="date" class="form-control" name="tgLahir" value="<?php echo $tgLahir ?>">
                        </div>
                    </div>

                    <div class="mb-3 row">
                        <label for="dataIbu" class="col-sm-2 col-form-label">Nama Ibu </label>
                        <div class="col-sm-10">
                            <input type="text" class="form-control" name="namaIbu" placeholder="Data Ibu" value="<?php echo $namaIbu ?>">
                        </div>
                    </div>
                    <div class="mb-3 row">
                        <label for="kelasSiswa" class="col-sm-2 col-form-label">Kelas *</label>
                        <div class="col-sm-10">
                            <select class="form-control" name="kelasSiswa">
                                <option value="">- Kelas -</option>
                                <?php
                                while ($rowKelas = mysqli_fetch_array($qKelas)) {
                                    $nokel++;
                                    $kelas = $rowKelas['kelas'];
                                ?>
                                    <option><?php echo $kelas ?></option>
                                <?php
                                }
                                ?>

                            </select>
                        </div>
                    </div>
                    <div class="button col-12">
                        <?php
                        if ($op == 'edit') {
                            $button    = 'edit';
                        } else {
                            $button    = 'simpan';
                        }
                        ?>
                        <input type="submit" name="<?php echo $button ?>" value="Simpan Data" class="btn btn-primary">
                    </div>
                </form>
            </div>
        </div>
    </div>
    <!-- menampilkan data siswa -->
    <div class="data mx-auto">
        <div class="card">
            <h5 class="card-header text-white bg-primary">Data Siswa</h5>
            <div class="card-body">
                <form method="POST">
                    <div class="data-head">
                        <div class="sort">
                            <select class="sort-kelas form-control" name="sortKelas">
                                <option value="noKelas">-kelas-</option>
                                <?php foreach ($qKelas as $rowKelas) { ?>
                                    <option value="<?php echo $rowKelas['kelas']; ?>"><?php echo $rowKelas['kelas']; ?></option>
                                <?php } ?>
                            </select>
                            <button class="btn btn-outline-primary" type="submit" name="sort">Sortir</button>
                        </div>

                        <div class="search-field">
                            <input type="text" id="myInput" onkeyup="myFunction()" placeholder="Cari Siswa" class="search form-control"> <!--search field -->
                        </div>
                    </div>
                </form>
                <table class="table table-bordered table-hover table-striped" id="myTable">
                    <thead>
                        <tr class="thead">
                            <th scope="col">#</th>
                            <th scope="col">NAMA</th>
                            <th scope="col">JENIS KELAMIN</th>
                            <th scope="col">TANGGAL LAHIR</th>
                            <th scope="col">KELAS</th>
                            <th scope="col">DATA IBU</th>
                            <th scope="col">NIK</th>
                            <th scope="col">NISN</th>
                            <th scope="col">AKSI</th>
                        </tr>
                    <tbody class="table-position">
                        <?php
                        if (isset($_POST['sortKelas']) && $_POST['sortKelas'] != 'noKelas') {
                            $kelas = $_POST['sortKelas'];
                            $sql = "SELECT * FROM siswa WHERE kelasSiswa='$kelas' ORDER BY namaSiswa ASC";
                        } else {
                            $sql = "SELECT * FROM siswa ORDER BY namaSiswa ASC";
                        }
                        $q2             = mysqli_query($koneksi, $sql);
                        $urut           = 1;
                        while ($r2      = mysqli_fetch_array($q2)) {
                            $idSiswa    = $r2['idSiswa'];
                            $namaSiswa  = $r2['namaSiswa'];
                            $jkSiswa    = $r2['jkSiswa'];
                            $kelasSiswa = $r2['kelasSiswa'];
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
                                <td scope="row"><?php echo $kelasSiswa ?></td>
                                <td scope="row"><?php echo $namaIbu ?></td>
                                <td scope="row"><?php echo $nikSiswa ?></td>
                                <td scope="row"><?php echo $nisn ?></td>
                                <td scope="row">
                                    <a href="crudSiswa.php?op=edit&idSiswa=<?php echo $idSiswa ?>"><button type="button" class="btn btn-warning" name="edit">Edit</button></a>
                                    <a href="crudSiswa.php?op=delete&idSiswa=<?php echo $idSiswa ?>"><button type="button" class="btn btn-danger" name="delete">Delete</button></a>
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