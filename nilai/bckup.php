<?php
require "../connection/koneksi.php";
require "proses.php";
$catatan = "";

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
                                <option value="">- Semester -</option>
                                <option value="Ganjil">Ganjil</option>
                                <option value="Genap">Genap</option>
                            </select>
                        </div>
                    </div>
                    <div class="mb-3 row">
                        <label for="mapel" class="col-sm-2 col-form-label" require>Mata Pelajaran *</label>
                        <div class="col-sm-10">
                            <?php
                            $query_mapel = "SELECT mapel FROM mapel";
                            $result_mapel = $koneksi->query($query_mapel);
                            if ($result_mapel->num_rows > 0) {
                                echo '<select class="form-control" name="mapel">';
                                while ($row_mapel = $result_mapel->fetch_assoc()) {
                                    $mapel = $row_mapel["mapel"];
                                    echo '<option value="' . $mapel . '">' . $mapel . '</option>';
                                }
                                echo '</select>';
                            }
                            ?>
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

                        <label for="catatan" class="col-sm-2 col-form-label">CATATAN</label>
                        <div class="col-sm-10">
                            <input type="text" class="form-control" name="catatan" value="<?php echo $catatan ?>" >
                        </div>
                    </div>
                    <div class="button col-12">
                        <input type="submit" name="<?php echo $button ?>" value="Ubah Data" class="btn btn-primary">
                        <input type="submit" name="add" value="Tambah Data" class="btn btn-outline-success">
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
                        <tr class="thead">
                            <th scope="col">#</th>
                            <th scope="col">NAMA</th>
                            <th scope="col">NISN</th>
                            <th scope="col">SEMESTER</th>
                            <th scope="col">MATA PELAJARAN</th>
                            <th scope="col">TUGAS</th>
                            <th scope="col">UTS</th>
                            <th scope="col">UAS</th>
                            <th scope="col">CATATAN</th>
                            <th scope="col">AKSI</th>
                        </tr>
                    </thead>
                    <tbody class="table-position">
                        <?php
                        $sql = "SELECT * FROM nilai WHERE 1=1"; // Menambahkan klausa WHERE 1=1 agar dapat memasukkan kondisi tambahan dengan mudah

                        if (isset($_POST['sortKelas']) && $_POST['sortKelas'] != 'noKelas') {
                            $kelas = $_POST['sortKelas'];
                            $sql .= " AND kelasSiswa = '$kelas'"; // Menggunakan .= untuk menggabungkan kondisi ke dalam query yang ada
                        } else {
                            // $sql .= " AND kelasSiswa = 'Kelas 1'"; 
                        }

                        if (isset($_POST['sortMapel']) && $_POST['sortMapel'] != '') {
                            $mapel = $_POST['sortMapel'];
                            $sql .= " AND mapel = '$mapel'"; // Menggunakan .= untuk menggabungkan kondisi ke dalam query yang ada
                        } else {
                            // $sql .= " AND mapel = 'Bahasa Indonesia'";
                        }

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
                            $catatan = $r2['catatan'];
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
                                <td scope="row"><?php echo $catatam ?></td>
                                <td scope="row">
                                    <a href="index.php?op=edit&idNilai=<?php echo $idNilai ?>"><button type="button" class="btn btn-warning" name="edit">Edit</button></a>
                                    <button type="button" class="btn btn-danger" name="delete" data-bs-toggle="modal" data-bs-target="#myModal<?php echo $idNilai ?>">Delete</button>
                                    <!-- KONFIRMASI DELETE DATA -->
                                    <div class="modal fade" id="myModal<?php echo $idNilai ?>" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                                        <div class="modal-dialog modal-dialog-centered">
                                            <div class="modal-content">
                                                <div class="modal-header">
                                                    <h5 class="modal-title" id="exampleModalLabel">Konfirmasi</h5>
                                                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                                </div>
                                                <div class="modal-body">
                                                    <p>Yakin Ingin Menghapus?</p>
                                                </div>
                                                <div class="modal-footer">
                                                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Batal</button>
                                                    <a href="index.php?op=delete&idNilai=<?php echo $idNilai ?>"><button type="button" class="btn btn-danger" name="delete">Delete</button></a>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
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