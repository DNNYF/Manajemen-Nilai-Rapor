<?php

$host   = "localhost";
$user   = "root";
$pass   = "";
$db     = "erapor";

$koneksi = mysqli_connect($host, $user, $pass, $db);
if (!$koneksi) {
    die("connection lost");
}

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


?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
    <title>CRUD NILAI</title>

    <style>
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

        .data {
            width: 80%;
        }
    </style>

</head>

<body>
    <div class="mx-auto">
        <div class="card">
            <form action="POST">
                <table class="table table-hover">   
                    <thead>
                        <tr>
                            <th>sscanf  </th>
                        </tr>
                        <tr class="head">
                            <th scope="col">#</th>
                            <th scope="col">Nama Siswa</th>
                            <th scope="col">NISN</th>
                            <th scope="col">Tugas</th>
                            <th scope="col">UTS</th>
                            <th scope="col">UAS</th>
                        </tr>
                    <tbody class="table-position">
                        <?php
                        $sqlsiswa    = "SELECT siswa.namaSiswa, siswa.nisn, nilai.tugas, nilai.uts, nilai.uas FROM siswa JOIN nilai ON siswa.idSiswa = nilai.idSiswa";
                        $q2          = mysqli_query($koneksi, $sqlsiswa);
                        $nomor       = 1;
                        while ($r2 = mysqli_fetch_array($q2)) {
                            // $idSiswa    = $r2['idSiswa'];
                            $namaSiswa  = $r2['namaSiswa'];
                            $nisn       = $r2['nisn'];
                            $tugas      = $r2['tugas'];
                            $uts        = $r2['uts'];
                            $uas        = $r2['uas'];
                        ?>
                            <tr>
                                <td scope="row" <?php echo $urut++ ?>></td>
                                <td scope="row" <?php echo $namaSiswa ?>></td>
                                <td scope="row" <?php echo $nisn ?>></td>
                                <td scope="row" <?php echo $tugas ?>></td>
                                <td scope="row" <?php echo $uts ?>></td>
                                <td scope="row" <?php echo $uas ?>></td>
                                <td scope="row">
                                    <?php

                                    $n_nilai    = array($r2['tugas'], $r2['uts'], $r2['uas']);
                                    $jml_nilai  = count($n_nilai);
                                    $sum_nilai  = array_sum($n_nilai);
                                    $rata_rata  = $sum_nilai / $jml_nilai;
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
            </form>
        </div>
    </div>
</body>

</html>