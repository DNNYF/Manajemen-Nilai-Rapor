<?php
include "../connection/koneksi.php";

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
    <link rel="stylesheet" href="style.css">
    <script src="search.js"></script>
    <title>CRUD</title>
</head>

<body>
    <div class="mx-auto">
        <div class="card">
            <div class="card-header">
                TAMBAH DATA
            </div>
            <div class="pop-up">
                <?php
                if (isset($_POST['import'])) {
                    $file           = $_FILES['file']['name'];
                    $ekstensi       = explode(".", $file);
                    $file_name      = "file-" . round(microtime(true)) . "." . end($ekstensi);
                    $sumber         = $_FILES['file']['tmp_name'];
                    $target_dir     = "../file/";
                    $target_file    = $target_dir . $file_name; // menggunakan $file_name sebagai nilai target_file
                    $upload         = move_uploaded_file($sumber, $target_file);
                    // penanganan jika file gagal diunggah
                    if ($upload) {
                        echo '<div class="alert alert-success" role="alert"> Berhasil mengunggah file </div>';
                    } else {
                        echo '<div class="alert alert-danger" role="alert">Gagal mengunggah file. Silakan coba lagi.</div>';
                    }
                }

                // header("refresh:2;url=import.php"); //2 : detik
                //unlink($target_file); <- menghapus data setelah di read
                ?>


            </div>
            <div class="card-body">
                <form action="" method="post" enctype="multipart/form-data">
                    <div class="form-group">
                        <div class="title">
                            <a href="crudSiswa.php"><button class="back btn btn-warning btn-sm"> Back </button></a>
                        </div>
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
                        require_once "tabel_siswa.php";
                        ?>
                    </tbody>
                    </thead>
                </table>
            </div>
        </div>
    </div>
</body>

</html>