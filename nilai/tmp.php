<?php
include "../connection/koneksi.php";
require "../connection/session.php";

$idSiswa    = "";
$namaSiswa  = "";
$nisn       = "";
$tugas      = "";
$uts        = "";
$uas        = "";
$urut       = "";
$tugas      = "";
$rata       = "";
$uts        = "";
$uas        = "";
$kelas      = "";
$error      = "";
$sukses    = "";
$nokel      = 1;
$resultInsert = "";

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
    <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Roboto|Varela+Round">
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.0/css/bootstrap.min.css">
    <link rel="stylesheet" href="https://fonts.googleapis.com/icon?family=Material+Icons">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css">
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.0/dist/umd/popper.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.0/js/bootstrap.min.js"></script>
    <link rel="stylesheet" href="style.css">
    <title>CRUD NILAI</title>
</head>

<body>
    <div class="mx-auto">
        <div class="card-header">
            <div class="title">
                <a href="crudSiswa.php" class="back btn btn-warning btn-sm"> Kembali </a>
            </div>
            <div class="">
                <h4 class="">INPUT NILAI</h4>
            </div>
        </div>
        <form method="POST">
            <div class="card">
                <table id="table-siswa" class="table table-hover">
                    <div class="menu">
                        <div class="btn-group">
                            <select class="sort-kelas form-control" name="sortKelas">
                                <option value="noKelas">-kelas-</option>
                                <?php
                                $sqlkelas   = "SELECT kelas FROM kelas";
                                $qKelas     = mysqli_query($koneksi, $sqlkelas); //queryKelas
                                $nokel      = 1;

                                foreach ($qKelas as $rowKelas) { ?>
                                    <option value="<?php echo $rowKelas['kelas']; ?>"><?php echo $rowKelas['kelas']; ?></option>
                                <?php } ?>
                            </select>
                            <select class="select-mapel form-control" name="mapel">
                                <option value="">- Mapel -</option>
                                <?php
                                $sqlMapel = "SELECT mapel FROM mapel";
                                $qMapel = mysqli_query($koneksi, $sqlMapel);
                                foreach ($qMapel as $rowMapel) { ?>
                                    <option value="<?php echo $rowMapel['mapel']; ?>"><?php echo $rowMapel['mapel']; ?></option>
                                <?php
                                }
                                ?>
                            </select>
                            <button class="btn btn-outline-primary" type="submit" name="sort">Sortir</button>
                        </div>
                    </div>
                    <thead>
                        <tr class="head">
                            <th scope="col">#</th>
                            <th scope="col">NISN</th>
                            <th scope="col">Nama Siswa</th> 
                            <th scope="col">Semester</th>
                            <th scope="col">Tugas</th>
                            <th scope="col">UTS</th>
                            <th scope="col">UAS</th>
                            <th scope="col">RATA RATA</th>
                            <th scope="col">PREDIKAT</th>
                        </tr>
                    </thead>
                    <tbody class="table-position">
                        <?php
                        if (isset($_POST['sort'])) {
                            $kelas = $_POST['sortKelas'];
                            $sql = "SELECT * FROM nilai WHERE kelasSiswa='$kelas' ORDER BY namaSiswa ASC";
                            $querySiswa = mysqli_query($koneksi, $sql);
                            $nomor = 1;
                            while ($row = mysqli_fetch_array($querySiswa)) {
                                $namaSiswa = $row['namaSiswa'];
                                $kelasSiswa = $row['kelasSiswa'];
                                $nisnSiswa = $row['nisn'];
                                $semester = $row['semester'];
                                $tugas = $row['tugas'];
                                $uas = $row['uas'];
                                $uts = $row['uts'];
                                $n_nilai = array($tugas, $uts, $uas);
                                $jml_nilai = count($n_nilai);
                                $sum_nilai = array_sum($n_nilai);
                                $rata_rata = $jml_nilai > 0 ? $sum_nilai / $jml_nilai : 0;
                                if ($rata_rata > 0 && $rata_rata <= 50) {
                                    $predikat = "D";
                                } elseif ($rata_rata > 50 && $rata_rata <= 60) {
                                    $predikat = "C";
                                } elseif ($rata_rata > 60 && $rata_rata <= 75) {
                                    $predikat = "B";
                                } elseif ($rata_rata > 75 && $rata_rata <= 100) {
                                    $predikat = "A";
                                } else {
                                    $predikat = "-";
                                }
                        ?>
                                <tr>
                                    <td scope="row"><?php echo $nomor++ ?></td>
                                    <td>
                                        <input class="inpField" type="text" name="nisn[]" value="<?php echo $nisnSiswa ?>" readonly>
                                    </td>
                                    <td><?php echo $namaSiswa ?></td>
                                    <td><?php echo $kelasSiswa ?></td>
                                    <td>
                                        <input class="inpNilai" type="number" name="semester[]" value="<?php echo $semester ?>">
                                    </td>
                                    <td>
                                        <input class="inpNilai" type="number" name="tugas[]" value="<?php echo $tugas ?>">
                                    </td>
                                    <td>
                                        <input class="inpNilai" type="number" name="uts[]" value="<?php echo $uts ?>">
                                    </td>
                                    <td>
                                        <input class="inpNilai" type="number" name="uas[]" value="<?php echo $uas ?>">
                                    </td>
                                    <td>
                                        <input class="inpField" type="text" name="rata[]" value="<?php echo $rata_rata ?>" readonly>
                                    </td>
                                    <td>
                                        <input class="inpNilai" type="text" name="predikat[]" value="<?php echo $predikat ?>" readonly>
                                    </td>
                                </tr>
                        <?php
                            }
                        } else {
                            echo ("Pilih Kelas Terlebih Dahulu");
                        }

                        ?>
                    </tbody>
                </table>
                <div class="button">
                    <button class="trigger-btn btn btn-primary" type="submit" name="simpan" data-toggle="modal" data-target="#myModal">Simpan</button>
                </div>
            </div>
        </form>

        <?php
        if (isset($_POST['simpan'])) {
            $nisnArr = $_POST['nisn'];
            $semesterArr = $_POST['semester'];
            $tugasArr = $_POST['tugas'];
            $utsArr = $_POST['uts'];
            $uasArr = $_POST['uas'];
            $rataArr = $_POST['rata'];
            $predikatArr = $_POST['predikat'];

            for ($i = 0; $i < count($nisnArr); $i++) {
                $nisn = mysqli_real_escape_string($koneksi, $nisnArr[$i]);
                $semester = mysqli_real_escape_string($koneksi, $semesterArr[$i]);
                $tugas = mysqli_real_escape_string($koneksi, $tugasArr[$i]);
                $uts = mysqli_real_escape_string($koneksi, $utsArr[$i]);
                $uas = mysqli_real_escape_string($koneksi, $uasArr[$i]);
                $rata = mysqli_real_escape_string($koneksi, $rataArr[$i]);
                $predikat = mysqli_real_escape_string($koneksi, $predikatArr[$i]);

                $sqlUpdate = "UPDATE nilai SET semester='$semester', tugas='$tugas', uas='$uas', uts='$uts', rata_rata='$rata', predikat='$predikat' WHERE nisn='$nisn'";
                $resultUpdate = mysqli_query($koneksi, $sqlUpdate);

                if ($resultUpdate) {
                    // Tindakan yang diambil jika pembaruan berhasil
                } else {
                    $error = "Gagal Memperbarui Nilai";
                }
            }
        }
        ?>

        <!-- card -->
    </div>
    <!-- mx-auto -->
    </div>
</body>

</html>