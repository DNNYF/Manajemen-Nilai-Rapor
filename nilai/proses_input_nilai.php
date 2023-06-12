<?php
require "../connection/koneksi.php";
require "proses.php";

$sqlkelas = "SELECT kelas FROM kelas";
$qKelas = mysqli_query($koneksi, $sqlkelas); //queryKelas
$sqlSiswa = "SELECT * FROM nilai";
$qSiswa = mysqli_query($koneksi, $sqlSiswa);
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" crossorigin="anonymous">
    </script>
    <link rel="stylesheet" href="style.css">
    <title>Document</title>
</head>

<body>
    <div class="mx-auto">
        <div class="card">
            <!-- memasukan data siswa -->
            <div class="card-header">
                <div class="title">
                    <a href="crudSiswa.php" class="back btn btn-warning btn-sm"> Back </a>
                </div>
                <div class="">
                    <h4 class="">INPUT NILAI</h4>
                </div>
            </div>
            <!-- menampilkan berhasil atau gagal menambahkan data -->
            <?php
            if ($error) {
                echo '<div class="alert alert-danger" role="alert">' . $error . '</div>';
                header("refresh:2;url=index.php"); //2 : detik
            }
            ?>
            <?php
            if ($sukses) {
                echo '<div class="alert alert-success" role="alert">' . $sukses . '</div>';
                header("refresh:2;url=index.php"); //2 : detik
            }
            ?>
            <div class="card-body">
                <form action="" method="POST">
                    <div class="mb-3 row">
                        <label for="namaSiswa" class="col-sm-2 col-form-label">Nama *</label>
                        <div class="col-sm-10">
                            <input type="text" class="form-control" placeholder="Nama" name="namaSiswa" value="<?php echo $namaSiswa ?>" readonly>
                        </div>
                    </div>
                    <div class="mb-3 row">
                        <label for="nisn" class="col-sm-2 col-form-label">NISN *</label>
                        <div class="col-sm-10">
                            <input type="text" class="form-control" placeholder="NISN" name="nisn" value="<?php echo $nisn ?>" readonly>
                        </div>
                    </div>
                    <div class="mb-3 row">
                        <label for="semester" class="col-sm-2 col-form-label">Semester *</label>
                        <div class="col-sm-10">
                            <input type="text" class="form-control" placeholder="Semester" name="semester" value="<?php echo $semester ?>" readonly>
                        </div>
                    </div>
                    <div class="mb-3 row">
                        <label for="kelas" class="col-sm-2 col-form-label">Kelas *</label>
                        <div class="col-sm-10">
                            <input type="text" class="form-control" placeholder="Kelas" name="kelas" value="<?php echo $kelas ?>" readonly>
                        </div>
                    </div>
                    <div class="mb-3 row">
                        <label for="mapel" class="col-sm-2 col-form-label">Mata Pelajaran *</label>
                        <div class="col-sm-10">
                            <select class="form-select" aria-label="Default select example" name="mapel">
                                <?php
                                while ($data = mysqli_fetch_array($qKelas)) {
                                    echo '<option value="' . $data['kelas'] . '">' . $data['kelas'] . '</option>';
                                }
                                ?>
                            </select>
                        </div>
                    </div>
                    <div class="mb-3 row">
                        <label for="nilai" class="col-sm-2 col-form-label">Nilai *</label>
                        <div class="col-sm-10">
                            <input type="text" class="form-control" placeholder="Nilai" name="nilai" value="<?php echo $nilai ?>">
                        </div>
                    </div>
                    <div class="mb-3 row">
                        <div class="col-sm-12">
                            <button type="submit" name="add" class="btn btn-outline-success">Tambah</button>
                            <button type="reset" class="btn btn-outline-warning">Reset</button>
                        </div>
                    </div>
                </form>
            </div>
            <div class="card-footer">
                <div class="title">
                    <h4 class="">DAFTAR NILAI SISWA</h4>
                </div>
            </div>
            <table class="table table-hover">
                <thead>
                    <tr>
                        <th scope="col">No</th>
                        <th scope="col">NISN</th>
                        <th scope="col">Nama</th>
                        <th scope="col">Kelas</th>
                        <th scope="col">Semester</th>
                        <th scope="col">Mapel</th>
                        <th scope="col">Nilai</th>
                        <th scope="col">Aksi</th>
                    </tr>
                </thead>
                <tbody>
                    <?php
                    while ($row = mysqli_fetch_array($qSiswa)) {
                        echo "<tr>";
                        echo "<td>" . $row['nokel'] . "</td>";
                        echo "<td>" . $row['nisn'] . "</td>";
                        echo "<td>" . $row['namaSiswa'] . "</td>";
                        echo "<td>" . $row['kelas'] . "</td>";
                        echo "<td>" . $row['semester'] . "</td>";
                        echo "<td>" . $row['mapel'] . "</td>";
                        echo "<td>" . $row['nilai'] . "</td>";
                        echo "<td>
                                <a class='btn btn-primary btn-sm' href='edit_nilai.php?nisn=" . $row['nisn'] . "'>Edit</a>
                                <a class='btn btn-danger btn-sm' href='delete_nilai.php?nisn=" . $row['nisn'] . "'>Delete</a>
                            </td>";
                        echo "</tr>";
                    }
                    ?>
                </tbody>
            </table>
        </div>
    </div>
</body>

</html>
