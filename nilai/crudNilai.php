<?php
include "../connection/koneksi.php";

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
$nokel      = "";

$op         = isset($_GET['op']) ? $_GET['op'] : '';


?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha3/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://getbootstrap.com/docs/5.3/assets/css/docs.css" rel="stylesheet">
    <title>Bootstrap Example</title>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha3/dist/js/bootstrap.bundle.min.js"></script>
    <title>CRUD NILAI</title>

    <style>
        * {
            margin: 0;
        }

        .mx-auto {
            width: 80%;
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

        .table {
            margin: 0rem;
            padding: 5rem;
        }

        .data {
            width: 80%;
        }

        .inpNilai {
            width: 55px;
            border: 1px solid #ccc;
            border-radius: 5px;
        }

        .button {
            margin: 10px;
        }

        .form-control {
            width: 200px;
        }

        .menu {
            display: flex;
            justify-content: space-between;
            padding: 5px;
        }

        .gsearch {
            display: flex;
            justify-content: space-between;
        }
    </style>

</head>

<body>
    <div class="mx-auto">
        <div class="card">
            <form action="POST">
                <table class="table table-hover">
                    <thead>
                        <div class="menu">
                            <!-- Example single danger button -->
                            <div class="btn-group">
                                <button type="button" class="btn btn-danger dropdown-toggle" data-bs-toggle="dropdown" aria-expanded="true">
                                    Action
                                </button>
                                <ul class="dropdown-menu">
                                    <?php
                                    $sqlkelas   = "SELECT kelas FROM kelas";
                                    $qKelas     = mysqli_query($koneksi,$sqlkelas); //queryKelas
                                    $nokel      = 1;
                                    while($rowKelas = mysqli_fetch_array($qKelas)) {
                                        $nokel++;
                                        $kelas = $rowKelas['kelas'];
                                        
                                        ?>
                                    <li><a class="dropdown-item" href="#" ><?php echo $kelas ?></a></li>
                                    <?php
                                    }
                                    ?>
                                </ul>
                            </div>
                            <div class="gsearch"> <!-- Group Search -->
                                <input class="form-control me-2" type="text" name="search" placeholder=" Search">
                                <button class="btn btn-warning">Cari</button>
                            </div>
                        </div>
                        <tr class="head">
                            <th scope="col">#</th>
                            <th scope="col">Nama Siswa</th>
                            <th scope="col">NISN</th>
                            <th scope="col">Tugas</th>
                            <th scope="col">UTS</th>
                            <th scope="col">UAS</th>
                            <th scope="col">RATA RATA</th>
                        </tr>
                    <tbody class="table-position">
                        <?php
                        $sqlsiswa       = "SELECT siswa.idSiswa, siswa.namaSiswa, siswa.nisn, nilai.tugas, nilai.uts, nilai.uas FROM siswa JOIN nilai ON siswa.idSiswa = nilai.idSiswa";
                        $q2             = mysqli_query($koneksi, $sqlsiswa);
                        $nomor          = 1;
                        while ($r2 = mysqli_fetch_array($q2)) {
                            $idSiswa   = $r2['idSiswa'];
                            $namaSiswa = $r2['namaSiswa'];
                            $nisn      = $r2['nisn'];
                            $tugas     = $r2['tugas'];
                            $uts       = $r2['uts'];
                            $uas       = $r2['uas'];
                        ?>
                            <tr>
                                <td scope="row"><?php echo $nomor++ ?></td>
                                <td><?php echo $namaSiswa ?></td>
                                <td><?php echo $nisn ?></td>
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
                                    $n_nilai   = array($r2['tugas'], $r2['uts'], $r2['uas']);
                                    $jml_nilai = count($n_nilai);
                                    $sum_nilai = array_sum($n_nilai);
                                    $rata_rata = $sum_nilai / $jml_nilai;
                                    echo $rata_rata;
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
                <?
                if (isset($_POST['simpan'])) {
                    $idSiswa   = $_POST['idSiswa'];
                    $namaSiswa = $_POST['namaSiswa'];
                    $nisn      = $_POST['nisn'];
                    $tugas     = $_POST['tugas'];
                    $uts       = $_POST['uts'];
                    $uas       = $_POST['uas'];

                
                }
                ?>
            </form>
            <!-- card -->
        </div>
        <!-- mx-auto -->
    </div>
</body>

</html>