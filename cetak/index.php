<?php
session_start();
require "../connection/koneksi.php";
require "../connection/session.php";

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
        <div class="card-body">


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
                        <th scope="col">Nilai Akhir</th>
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
                            <td scope="row"><?php echo $nilaiAkhir ?></td>
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
</body>

</html>