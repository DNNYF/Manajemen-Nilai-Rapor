<?php
$namaSiswa = "";
$nisn = "";
$error = "";
$sukses = "";

if (isset($_GET['op'])) {
    $op = $_GET['op'];
} else {
    $op = "";
}

if ($op == 'edit') {
    $button = 'edit';
} else {
    $button = 'add';
}

if ($op == 'edit') {
    $idNilai = $_GET['idNilai'];
    $sql1 = "SELECT * FROM nilai WHERE idNilai = '$idNilai'";
    $q1 = mysqli_query($koneksi, $sql1);
    $r1 = mysqli_fetch_array($q1);
    $namaSiswa = $r1['namaSiswa'];
    $nisn = $r1['nisn'];
    $semester = $r1['semester'];
    $tugas = $r1['tugas'];
    $uts = $r1['uts'];
    $uas = $r1['uas'];

    if ($idNilai == '') {
        $error = "Data tidak ditemukan";
    }

    if (isset($_POST['edit'])) {
        $namaSiswa = mysqli_real_escape_string($koneksi, $_POST['namaSiswa']);
        $nisn = mysqli_real_escape_string($koneksi, $_POST['nisn']);
        $semester = mysqli_real_escape_string($koneksi, $_POST['semester']);
        $mapel = mysqli_real_escape_string($koneksi, $_POST['mapel']);
        $tugas = mysqli_real_escape_string($koneksi, $_POST['tugas']);
        $uts = mysqli_real_escape_string($koneksi, $_POST['uts']);
        $uas = mysqli_real_escape_string($koneksi, $_POST['uas']);

        // Mengirim data ke database
        if ($namaSiswa && $nisn) {
            $sql1 = "UPDATE nilai SET namaSiswa = '$namaSiswa', semester = '$semester', mapel = '$mapel', tugas = '$tugas', uts = '$uts', uas = '$uas' WHERE idNilai = '$idNilai'";
            try {
                $q1 = mysqli_query($koneksi, $sql1);
                if ($q1) {
                    $sukses = "Berhasil mengupdate data";
                } else {
                    $error = "Gagal Mengupdate Data";
                }
            } catch (mysqli_sql_exception $e) {
                $error = $e->getMessage();
            }
        } else {
            $error = "Silahkan masukkan data";
        }
    }
}

if (isset($_POST['add'])) {
    $namaSiswa = mysqli_real_escape_string($koneksi, $_POST['namaSiswa']);
    $nisn = mysqli_real_escape_string($koneksi, $_POST['nisn']);
    $semester = mysqli_real_escape_string($koneksi, $_POST['semester']);
    $tugas = mysqli_real_escape_string($koneksi, $_POST['tugas']);
    $uts = mysqli_real_escape_string($koneksi, $_POST['uts']);
    $uas = mysqli_real_escape_string($koneksi, $_POST['uas']);

    // Mengirim data ke database
    if ($namaSiswa && $nisn) {
        $sql1 = "INSERT INTO nilai (namaSiswa, nisn, semester, tugas, uts, uas) 
                    VALUES ('$namaSiswa', '$nisn', '$semester', '$tugas', '$uts', '$uas')";

        try {
            $q1 = mysqli_query($koneksi, $sql1);
            if ($q1) {
                $sukses = "Berhasil memasukkan data baru";
            } else {
                $error = "Gagal Menambahkan Data";
            }
        } catch (mysqli_sql_exception $e) {
            $error = $e->getMessage();
        }
    } else {
        $error = "Silahkan masukkan data";
    }
}
?>
