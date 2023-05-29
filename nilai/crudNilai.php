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
$uts        = "";
$uas        = "";
$kelas      = "";
$nokel      = 1;
$resultInsert = "";
$error      = "";
$success    = "";
$op         = isset($_GET['op']) ? $_GET['op'] : '';


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
    <script src="search.js"></script>
    <link rel="stylesheet" href="style.css">
    <title>CRUD NILAI</title>



</head>

<body>
    <div class="mx-auto">
        <div class="card-header">
            <div class="title">
                <a href="crudSiswa.php" class="back btn btn-warning btn-sm"> Back </a>
            </div>
            <div class="">
                <h4 class="">CREATE / EDIT DATA</h4>
            </div>
        </div>
        <form action="POST">
            <div class="card">
                <table class="table table-hover">
                    <thead>
                        <div class="menu">
                            <!-- Example single danger button -->
                            <div class="btn-group">
                                <select class="form-control" name="kelasSiswa">
                                    <option value="">- Kelas -</option>
                                    <?php
                                    $sqlkelas   = "SELECT kelas FROM kelas";
                                    $qKelas     = mysqli_query($koneksi, $sqlkelas); //queryKelas
                                    while ($rowKelas = mysqli_fetch_array($qKelas)) {
                                        $nokel++;
                                        $kelas = $rowKelas['kelas'];
                                    ?>
                                        <option><?php echo $kelas ?></option>
                                    <?php
                                    }
                                    ?>

                                </select>
                                <select class="select-mapel form-control" name="mapel">
                                    <option value="">- Mapel -</option>
                                    <?php
                                    $sqlMapel   = "SELECT mapel FROM mapel";
                                    $qMapel     = mysqli_query($koneksi, $sqlMapel);
                                    foreach ($qMapel as $rowMapel) { ?>
                                        <option value="<?php echo $rowMapel['mapel']; ?>"><?php echo $rowMapel['mapel']; ?></option>
                                    <?php
                                    }
                                    ?>

                                </select>
                                </ul>
                            </div>
                            <div class="gsearch"> <!-- Group Search -->
                                <input class="form-control me-2" type="text" name="search" placeholder=" Search">
                                <button class="btn btn-warning">Cari</button>
                            </div>
                        </div>
                        <tr class="head">
                            <th scope="col">#</th>
                            <th scope="col">NISN</th>
                            <th scope="col">Nama Siswa</th>
                            <th scope="col">Semester</th>
                            <th scope="col">Tugas</th>
                            <th scope="col">UTS</th>
                            <th scope="col">UAS</th>
                            <th scope="col">RATA RATA</th>
                        </tr>
                    <tbody class="table-position">
                        <?php
                        $sqlNilai       = "SELECT * FROM nilai";
                        $queryNilai     = mysqli_query($koneksi, $sqlNilai);
                        $sqlSiswa       = "SELECT namaSiswa, nisn FROM siswa";
                        $querySiswa     = mysqli_query($koneksi, $sqlSiswa);
                        $nomor          = 1;

                        while ($row1 = mysqli_fetch_array($queryNilai)) {
                            $semester   = $row1['semester'];
                            $tugas   = $row1['tugas'];
                            $uas   = $row1['uas'];
                            $uts   = $row1['uts'];
                        }

                        while ($row2 = mysqli_fetch_array($querySiswa)) {
                            $namaSiswa = $row2['namaSiswa'];
                            $nisn = $row2['nisn'];
                        ?>
                            <tr>
                                <td scope="row"><?php echo $nomor++ ?></td>
                                <td>
                                    <input class="inpNilai" type="text" name="nisn" value="<?php echo $nisn ?>" readonly>
                                </td>
                                <td><?php echo $namaSiswa ?></td>
                                <td>
                                    <input class="inpNilai" type="number" name="semester" value="<?php echo $semester ?>">
                                </td>
                                <td>
                                    <input class="inpNilai" type="number" name="tugas" value="<?php echo $tugas ?>">
                                </td>
                                <td>
                                    <input class="inpNilai" type="number" name="uts" value="<?php echo $uts ?>">
                                </td>
                                <td>
                                    <input class="inpNilai" type="number" name="uas" value="<?php echo $uas ?>">
                                </td>
                                <td>
                                    <?php
                                    if ($row1 == null) {
                                        echo $rata_rata = "0";
                                    } else {
                                        $n_nilai   = array($row1['tugas'], $row1['uts'], $row1['uas']);
                                        $jml_nilai = count($n_nilai);
                                        $sum_nilai = array_sum($n_nilai);
                                        $rata_rata = $sum_nilai / $jml_nilai;
                                        echo $rata_rata;
                                    }
                                    ?>
                                </td>
                            </tr>
                        <?php
                        }
                        ?>
                    </tbody>
                    </thead>

                </table>
                <div class="button">
                    <button type="sumbit" class="btn btn-primary" name="simpan">Simpan</button></a>
                </div>
                <?php
                if (isset($_POST['simpan'])) {
                    $nisnArr = $_POST['nisn'];
                    $semesterArr = $_POST['semester'];
                    $tugasArr = $_POST['tugas'];
                    $utsArr = $_POST['uts'];
                    $uasArr = $_POST['uas'];

                    $values = "";
                    for ($i = 0; $i < count($nisnArr); $i++) {
                        $nisn = mysqli_real_escape_string($koneksi, $nisnArr[$i]);
                        $semester = mysqli_real_escape_string($koneksi, $semesterArr[$i]);
                        $tugas = mysqli_real_escape_string($koneksi, $tugasArr[$i]);
                        $uts = mysqli_real_escape_string($koneksi, $utsArr[$i]);
                        $uas = mysqli_real_escape_string($koneksi, $uasArr[$i]);

                        $values .= "('$nisn','$semester','$tugas','$uas','$uts'),";
                    }
                    $values = rtrim($values, ",");

                    $sqlInsert = "INSERT INTO nilai (nisn, semester, tugas, uas, uts) VALUES $values";
                    $resultInsert = mysqli_query($koneksi, $sqlInsert);

                    if ($resultInsert) {
                        $success = "Berhasil Menambahkan Nilai";
                    } else {
                        $error = "Gagal Menambahkan Nilai";
                    }
                }
                ?>
        </form>
        <!-- card -->
    </div>
    <!-- mx-auto -->
    </div>

</body>

</html>