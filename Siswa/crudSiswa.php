<?php
require "proses_crud.php";
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
    <title>CRUD</title>


    <title>CRUD</title>
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
                    <h4 class="">CREATE / EDIT DATA</h4>
                </div>
            </div>
            <!-- menampilkan berhasil atau gagal menambahkan data -->
            <?php
            if ($error) {
                echo '<div class="alert alert-danger" role="alert">' . $error . '</div>';
                header("refresh:2;url=crudSiswa.php"); //2 : detik
            };
            ?>
            <?php
            if ($sukses) {
                echo '<div class="alert alert-success" role="alert">' . $sukses . '</div>';
                header("refresh:2;url=crudSiswa.php"); //2 : detik
            };
            ?>
            <div class="card-body">
                <form action="" method="POST">
                    <div class="mb-3 row">
                        <label for="nikSiswa" class="col-sm-2 col-form-label">NIK *</label>
                        <div class="col-sm-10">
                            <input type="text" class="form-control" placeholder="NIK" name="nikSiswa" value="<?php echo $nikSiswa ?>">
                        </div>
                    </div>
                    <div class="mb-3 row">
                        <label for="nisn" class="col-sm-2 col-form-label">NISN *</label>
                        <div class="col-sm-10">
                            <input type="text" class="form-control" placeholder="NISN" name="nisn" value="<?php echo $nisn ?>">
                        </div>
                    </div>
                    <div class="mb-3 row">
                        <label for="namaSiswa" class="col-sm-2 col-form-label">Nama *</label>
                        <div class="col-sm-10">
                            <input type="text" class="form-control" placeholder="Nama" name="namaSiswa" value="<?php echo $namaSiswa ?>">
                        </div>
                    </div>
                    <div class="mb-3 row">
                        <label for="jkSiswa" class="col-sm-2 col-form-label">Jenis Kelamin *</label>
                        <div class="col-sm-10">
                            <select class="form-control" name="jkSiswa">
                                <option value="">- Jenis kelamin -</option>
                                <option value="L" <?php if ($jkSiswa == "L") echo "Selected" ?>>Laki-Laki</option>
                                <option value="P" <?php if ($jkSiswa == "P") echo "Selected" ?>>Perempuan</option>
                            </select>

                        </div>
                    </div>
                    <div class="mb-3 row">
                        <label for="tgLahir" class="col-sm-2 col-form-label">Tanggal Lahir *</label>
                        <div class="col-sm-10">
                            <input type="date" class="form-control" name="tgLahir" value="<?php echo $tgLahir ?>">
                        </div>
                    </div>

                    <div class="mb-3 row">
                        <label for="dataIbu" class="col-sm-2 col-form-label">Nama Ibu </label>
                        <div class="col-sm-10">
                            <input type="text" class="form-control" name="namaIbu" placeholder="Data Ibu" value="<?php echo $namaIbu ?>">
                        </div>
                    </div>
                    <div class="mb-3 row">
                        <label for="kelasSiswa" class="col-sm-2 col-form-label">Kelas *</label>
                        <div class="col-sm-10">
                            <select class="form-control" name="kelasSiswa">
                                <option value="">- Kelas -</option>
                                <?php
                                while ($rowKelas = mysqli_fetch_array($qKelas)) {
                                    $nokel++;
                                    $kelas = $rowKelas['kelas'];
                                ?>
                                    <option><?php echo $kelas ?></option>
                                <?php
                                }
                                ?>

                            </select>
                        </div>
                    </div>
                    <div class="button col-12">
                            <a href="import.php" class="btn btn-outline-success">
                                    <img class="icon-exel" style="width: 15px; height: 15px;" src="../assets/img/exel.png" alt=""> Exel
                            </a>
                            <input type="submit" name="<?php echo $button ?>" value="Simpan Data" class="btn btn-primary">
                    </div>
                </form>
            </div>
        </div>
    </div>
    <!-- menampilkan data siswa -->
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
                                    <option value="<?php echo $rowKelas['kelas']; ?>"><?php echo $rowKelas['kelas']; ?></option>
                                <?php } ?>
                            </select>
                            <button class="btn btn-outline-primary" type="submit" name="sort">Sortir</button>
                        </div>

                        <div class="search-field">
                            <input type="text" id="myInput" onkeyup="myFunction()" placeholder="Cari Siswa" class="search form-control"> <!--search field -->
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
</body>

</html>