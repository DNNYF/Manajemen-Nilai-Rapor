<?php
include "../connection/koneksi.php";
require "proses_import.php";
require "proses_crud.php";

$sukses = "Berhasil memasukan data baru";
$error = "Gagal Menambahkan Data";
$upload = "";
$sqlkelas   = "SELECT kelas FROM kelas";
$qKelas     = mysqli_query($koneksi, $sqlkelas); //queryKelas
$nokel      = 1;
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0/dist/js/bootstrap.bundle.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" crossorigin="anonymous">
    </script>
    <link rel="stylesheet" href="style.css">
    <script src="search.js"></script>
    <title>CRUD</title>
</head>

<body>
    <div class="mx-auto">
        <div class="card">
            <div class="card-header">
                <div class="title">
                    <a href="crudSiswa.php" class="back btn btn-warning btn-sm"> Back </a>
                </div>
                <div class="">
                    <h4 class="">UNGGAH DATA EXEL</h4>
                </div>
            </div>
            <div class="pop-up">
                <?php
                importfile();
                // header("refresh:2;url=import.php"); //2 : detik
                //unlink($target_file); <- menghapus data setelah di read
                ?>


            </div>
            <div class="card-body">
                <form action="" method="post" enctype="multipart/form-data">
                    <div class="form-group">

                        <div class="unduh">
                            Unduh format exel disini :
                            <a href="../file/sample/siswa.xlsx" download class="link-unduh btn btn-success btn-sm">
                                Unduh
                            </a>
                        </div>
                        <div class="upload-file">
                            <div class="file-field">
                                <input class="form-control form-control-sm" id="formFileSm" type="file" name="file">
                            </div>
                            <div class="import">
                                <button class="import btn btn-outline-success btn-sm" type="submit" value="Import" name="import">Import</button>
                            </div>
                            <?php
                            ?>
                        </div>
                        <br>
                        <p>
                            *catatan : Upload menggunakan format file '.xlsx'
                        </p>
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
                            <select class="sort-kelas form-control" name="sortKelas">
                                <option value="noKelas">-kelas-</option>
                                <?php foreach ($qKelas as $rowKelas) { ?>
                                    <option value="<?php echo $rowKelas['kelas']; ?>"><?php echo $rowKelas['kelas']; ?>
                                    </option>
                                <?php } ?>
                            </select>
                            <button class="btn btn-outline-primary" type="submit" name="sort">Sortir</button>
                        </div>
                        <div class="search-field">
                            <input type="text" id="myInput" onkeyup="myFunction()" placeholder="Cari Siswa" class="search form-control">
                            <!--search field -->
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
                                    <button type="button" class="btn btn-danger" data-bs-toggle="modal" data-bs-target="#myModal">Delete</button>
                                    <!-- KONFIRMASI DELETE DATA -->
                                    <div class="modal fade" id="myModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                                        <div class="modal-dialog modal-dialog-centered">
                                            <div class="modal-content">
                                                <div class="modal-header">
                                                    <h5 class="modal-title" id="exampleModalLabel">Konfirmasi</h5>
                                                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                                </div>
                                                <div class="modal-body">
                                                    <p>Yakin Ingin Menghapus ?</p>
                                                </div>
                                                <div class="modal-footer">
                                                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Batal</button>
                                                    <a href="import.php?op=delete&idSiswa=<?php echo $idSiswa ?>"><button type="button" class="btn btn-danger" name="delete" data-bs-toggle="modal" data-bs-target="#myModal">Delete</button></a>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
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
    </div>
</body>

</html>