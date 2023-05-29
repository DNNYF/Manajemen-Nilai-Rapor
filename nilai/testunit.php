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
    <script src="search.js"></script>
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
                <h4 class="">CREATE / EDIT DATA</h4>
            </div>
        </div>
        <form method="POST">
            <div class="card">
                <table class="table table-hover">
                    <thead>
                        <div class="menu">
                            <!-- Contoh tombol dropdown -->
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
                            <div class="gsearch"> <!-- Grup Pencarian -->
                                <input class="form-control me-2" type="text" name="search" placeholder=" Cari">
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
                            <th scope="col">PREDIKAT</th>

                        </tr>
                    <tbody class="table-position">
                        <?php
                        $sqlNilai = "SELECT nilai.*, siswa.namaSiswa, siswa.nisn FROM nilai INNER JOIN siswa ON nilai.nisn = siswa.nisn";
                        $queryNilai = mysqli_query($koneksi, $sqlNilai);
                        $nomor = 1;

                        while ($row1 = mysqli_fetch_array($queryNilai)) {
                            $semester = $row1['semester'];
                            $nisnSiswa = $row1['nisn'];
                            $namaSiswa = $row1['namaSiswa'];
                            $tugas = $row1['tugas'];
                            $uas = $row1['uas'];
                            $uts = $row1['uts'];
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
                                $predikat = "Tidak Valid";
                            }

                           


                        ?>
                            <tr>
                                <td scope="row"><?php echo $nomor++ ?></td>
                                <td>
                                    <input class="inpNilai" type="text" name="nisn[]" value="<?php echo $nisnSiswa ?>" readonly>
                                </td>
                                <td><?php echo $namaSiswa ?></td>
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
                                    <input class="inpNilai" type="number" name="rata[]" value="<?php echo $rata_rata ?>" readonly>
                                </td>
                                
                                <td>
                                    <input class="inpNilai" type="text" name="predikat[]" value="<?php echo $predikat ?>" readonly>
                                </td>

                            </tr>
                        <?php
                        }
                        ?>


                    </tbody>
                    </thead>

                </table>
                <div class="button">
                    <button type="submit" class="btn btn-primary" name="simpan">Simpan</button>
                </div>
                <?php
                // ...

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

                        // Check if the array elements have valid indices before accessing them
                        if (isset($rataArr[$i]) && isset($predikatArr[$i])) {
                            $rata = mysqli_real_escape_string($koneksi, $rataArr[$i]);
                            $predikat = mysqli_real_escape_string($koneksi, $predikatArr[$i]);
                        } else {
                            // Set default values or handle the case where the elements are not properly populated
                            $rata = 0;
                            $predikat = '';
                        }

                        $sqlUpdate = "UPDATE nilai SET semester='$semester', tugas='$tugas', uas='$uas', uts='$uts', rata_rata='$rata', predikat='$predikat' WHERE nisn='$nisn'";
                        $resultUpdate = mysqli_query($koneksi, $sqlUpdate);

                        if ($resultUpdate) {
                            $success = "Berhasil Memperbarui Nilai";
                        } else {
                            $error = "Gagal Memperbarui Nilai";
                        }
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