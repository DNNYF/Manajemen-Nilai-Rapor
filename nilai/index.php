<?php

require "../connection/koneksi.php";
$catatan = "";
require "proses.php";
require "../connection/session.php";


$sqlkelas = "SELECT kelas FROM kelas";
$qKelas = mysqli_query($koneksi, $sqlkelas); //queryKelas
$nokel = 1;
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
            };
            ?>
            <?php
            if ($sukses) {
                echo '<div class="alert alert-success" role="alert">' . $sukses . '</div>';
                header("refresh:2;url=index.php"); //2 : detik
            };
            ?>
            <div class="card-body">
                <form action="" method="POST">
                    <div class="mb-3 row">
                        <label for="namaSiswa" class="col-sm-2 col-form-label">Nama *</label>
                        <div class="col-sm-10">
                            <input type="text" class="form-control" placeholder="Nama" name="namaSiswa" value="<?php echo $namaSiswa ?>" require>
                        </div>
                    </div>
                    <div class="mb-3 row">
                        <label for="nisn" class="col-sm-2 col-form-label">NISN *</label>
                        <div class="col-sm-10">
                            <input type="text" class="form-control" placeholder="NISN" name="nisn" value="<?php echo $nisn ?>">
                        </div>
                    </div>
                    <div class="mb-3 row">
                        <label for="semester" class="col-sm-2 col-form-label" require>Semester *</label>
                        <div class="col-sm-10">
                            <select class="form-control" name="semester">
                                <option value="" hidden></option>
                                <option value="Ganjil">Ganjil</option>
                                <option value="Genap">Genap</option>
                            </select>
                        </div>
                    </div>

                    <div class="mb-3 row">
                        <label for="tugas" class="col-sm-2 col-form-label">TUGAS</label>
                        <div class="col-sm-10">
                            <input type="number" class="form-control" name="tugas" value="<?php echo $tugas ?>" max="100" min="0">
                        </div>
                    </div>
                    <div class="mb-3 row">
                        <label for="uts" class="col-sm-2 col-form-label">UTS</label>
                        <div class="col-sm-10">
                            <input type="number" class="form-control" name="uts" value="<?php echo $uts ?>" max="100" min="0">
                        </div>
                    </div>
                    <div class="mb-3 row">
                        <label for="uas" class="col-sm-2 col-form-label">UAS</label>
                        <div class="col-sm-10">
                            <input type="number" class="form-control" name="uas" value="<?php echo $uas ?>" max="100" min="0">
                        </div>
                    </div>
                    <div class="mb-3 row">
                        <?php
                        $tugas = isset($tugas) ? $tugas : 0;
                        $uts = isset($uts) ? $uts : 0;
                        $uas = isset($uas) ? $uas : 0;
                        $n_nilai = array($tugas, $uts, $uas);
                        $jml_nilai = count($n_nilai);
                        $sum_nilai = array_sum($n_nilai);
                        $nilaiAkhir = $jml_nilai > 0 ? $sum_nilai / $jml_nilai : 0;
                        $nilaiAkhirFormatted = number_format($nilaiAkhir, 1, '.', '');
                        ?>

                        <label for="nilaiAkh    ir" class="col-sm-2 col-form-label">nilaiAkhir</label>
                        <div class="col-sm-10">
                            <input type="text" class="form-control" name="nilaiAkhir" value="<?php echo $nilaiAkhirFormatted ?>" readonly>
                        </div>
                    </div>
                    <div class="mb-3 row">
                    <label for="catatan" class="col-sm-2 col-form-label">CATATAN</label>
                        <div class="col-sm-10">
                            <input type="text" class="form-control" name="catatan" value="<?php echo $catatan ?>">
                        </div>
                    </div>
                    <div class="button col-12 text-end">
                        <input type="submit" name="edit" value="Simpan" class="btn btn-success">
                    </div>


                </form>
            </div>
        </div>
    </div>
    <div class="data mx-auto">
        <div class="card">
            <h5 class="card-header text-white bg-primary">Data Siswa</h5>
            <div class="card-body">
                <form method="POST">
                    <div class="data-head">
                        <div class="sort">
                            <select class="select-mapel form-control" name="sortMapel">
                                <option value="">- Mapel -</option>
                                <?php
                                $sqlMapel = "SELECT mapel FROM mapel";
                                $qMapel = mysqli_query($koneksi, $sqlMapel);
                                while ($rowMapel = mysqli_fetch_assoc($qMapel)) {
                                    $mapel = $rowMapel['mapel'];
                                    echo '<option value="' . $mapel . '">' . $mapel . '</option>';
                                }
                                ?>
                            </select>
                            <select class="sort-kelas form-control" name="sortKelas">
                                <option value="noKelas">-kelas-</option>
                                <?php
                                $sqlKelas = "SELECT kelas FROM kelas";
                                $qKelas = mysqli_query($koneksi, $sqlKelas);
                                while ($rowKelas = mysqli_fetch_assoc($qKelas)) {
                                    $kelas = $rowKelas['kelas'];
                                    echo '<option value="' . $kelas . '">' . $kelas . '</option>';
                                }
                                ?>
                            </select>
                            <button class="btn btn-outline-primary" type="submit" name="sort">Sortir</button>
                        </div>
                        <div class="search-field">
                            <input type="text" id="myInput" onkeyup="myFunction()" placeholder="Cari Siswa" class="search form-control">
                        </div>
                    </div>
                </form>
                <table class="table table-bordered table-hover table-striped" id="myTable">
                    <thead>
                        <tr class="thead txt-center">
                            <th scope="col">#</th>
                            <th scope="col">NAMA</th>
                            <th scope="col">NISN</th>
                            <th scope="col">SEMESTER</th>
                            <th scope="col">MATA PELAJARAN</th>
                            <th scope="col">TUGAS</th>
                            <th scope="col">UTS</th>
                            <th scope="col">UAS</th>
                            <th scope="col">AKSI</th>
                        </tr>
                    </thead>
                    <tbody class="table-position">
                        <?php
                        $sql = "SELECT * FROM nilai WHERE 1=1"; // Menambahkan klausa WHERE 1=1 agar dapat memasukkan kondisi tambahan dengan mudah

                        if (isset($_POST['sortKelas']) && $_POST['sortKelas'] != 'noKelas') {
                            $kelas = $_POST['sortKelas'];
                            $sql .= " AND kelasSiswa = '$kelas'"; // Menggunakan .= untuk menggabungkan kondisi ke dalam query yang ada
                        }

                        if (isset($_POST['sortMapel']) && $_POST['sortMapel'] != '') {
                            $mapel = $_POST['sortMapel'];
                            $sql .= " AND mapel = '$mapel'"; // Menggunakan .= untuk menggabungkan kondisi ke dalam query yang ada
                        }

                        $sql .= " GROUP BY namaSiswa";
                        $sql .= " ORDER BY namaSiswa ASC";


                        $q2 = mysqli_query($koneksi, $sql);
                        $urut = 1;
                        while ($r2 = mysqli_fetch_array($q2)) {
                            $idNilai = $r2['idNilai'];
                            $namaSiswa = $r2['namaSiswa'];
                            $mapel = $r2['mapel'];
                            $nisn = $r2['nisn'];
                            $semester = $r2['semester'];
                            $tugas = $r2['tugas'];
                            $uts = $r2['uts'];
                            $uas = $r2['uas'];
                            // $nilaiAkhir = $r2['nilaiAkhir'];
                            $n_nilai = array($tugas, $uts, $uas);
                            $jml_nilai = count($n_nilai);
                            $sum_nilai = array_sum($n_nilai);
                            $nilaiAkhir = $jml_nilai > 0 ? $sum_nilai / $jml_nilai : 0;
                        ?>

                            <tr>
                                <th scope="row"><?php echo $urut++ ?></th>
                                <td scope="row"><?php echo $namaSiswa ?></td>
                                <td scope="row"><?php echo $nisn ?></td>
                                <td scope="row"><?php echo $semester ?></td>
                                <td scope="row"><?php echo $mapel ?></td>
                                <td scope="row"><?php echo $tugas ?></td>
                                <td scope="row"><?php echo $uts ?></td>
                                <td scope="row"><?php echo $uas ?></td>
                                <td scope="row">
                                    <a href="../cetak/sample.php?op=cetak&nisn=<?php echo $nisn ?>" class="btn btn-info btn-sm" target="_blank">lihat</a>
                                    <a href="../cetak/tc.php?op=cetak&nisn=<?php echo $nisn ?>" class="btn btn-success btn-sm">Cetak</a>
                                    <a href="index.php?op=edit&idNilai=<?php echo $idNilai ?>"><button type="button" class="btn btn-warning btn-sm" name="edit">Edit</button></a>
                                </td>
                            </tr>
                        <?php } ?>
                    </tbody>
                </table>
            </div>
        </div>
    </div>


    <script>
        function myFunction() {
            var input, filter, table, tr, td, i, txtValue;
            input = document.getElementById("myInput");
            filter = input.value.toUpperCase();
            table = document.getElementById("myTable");
            tr = table.getElementsByTagName("tr");
            for (i = 0; i < tr.length; i++) {
                td = tr[i].getElementsByTagName("td")[1];
                if (td) {
                    txtValue = td.textContent || td.innerText;
                    if (txtValue.toUpperCase().indexOf(filter) > -1) {
                        tr[i].style.display = "";
                    } else {
                        tr[i].style.display = "none";
                    }
                }
            }
        }
    </script>
</body>

</html>