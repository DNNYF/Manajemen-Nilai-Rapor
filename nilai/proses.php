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

// Mendapatkan nilai parameter op dan idNilai dari URL
$op = isset($_GET['op']) ? $_GET['op'] : '';
$idNilai = isset($_GET['idNilai']) ? $_GET['idNilai'] : '';

// Jika op adalah 'delete' dan idNilai tidak kosong
if ($op == 'delete' && !empty($idNilai)) {
    // Mengambil NISN sebelum menghapus data siswa
    $sql2 = "SELECT namaSiswa FROM nilai WHERE idNilai = '$idNilai'";
    $q2 = mysqli_query($koneksi, $sql2);

    if (mysqli_num_rows($q2) > 0) {
        $r2 = mysqli_fetch_assoc($q2);
        $nisn = $r2['nisn'];

        // Menghapus data siswa
        $sql1 = "DELETE FROM nilai WHERE idNilai = '$idNilai'";
        $q1 = mysqli_query($koneksi, $sql1);

        if ($q1) {
            // Menghapus data nilai yang memiliki NISN yang sesuai
            $sql3 = "DELETE FROM nilai WHERE nisn = '$nisn'";
            $q3 = mysqli_query($koneksi, $sql3);

            if ($q3) {
                $sukses = "Berhasil hapus data siswa dan data nilai";
            } else {
                $error = "Gagal hapus data nilai";
            }
        } else {
            $error = "Gagal hapus data siswa";
        }
    } else {
        $error = "Data siswa tidak ditemukan";
    }

    // Setelah selesai menghapus data, redirect ke halaman index.php
    header("Location: index.php");
    exit();
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
    $catatan = $r1['catatan'];

    if ($idNilai == '') {
        $error = "Data tidak ditemukan";
    }

    if (isset($_POST['edit'])) {
        $namaSiswa = mysqli_real_escape_string($koneksi, $_POST['namaSiswa']);
        $nisn = mysqli_real_escape_string($koneksi, $_POST['nisn']);
        $semester = mysqli_real_escape_string($koneksi, $_POST['semester']);
        $tugas = mysqli_real_escape_string($koneksi, $_POST['tugas']);
        $uts = mysqli_real_escape_string($koneksi, $_POST['uts']);
        $uas = mysqli_real_escape_string($koneksi, $_POST['uas']);
        // $nilaiAkhirFormatted = mysqli_real_escape_string($koneksi, $_POST['nilaiAkhir']);
        $catatan = mysqli_real_escape_string($koneksi, $_POST['catatan']);
    
        // Mengirim data ke database
        if ($namaSiswa && $nisn && $semester) {
            $sql1 = "UPDATE nilai SET namaSiswa = '$namaSiswa', semester = '$semester', tugas = '$tugas', uts = '$uts', uas = '$uas', catatan = '$catatan' WHERE idNilai = '$idNilai'";
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
            $error = "Silahkan Isi semua kolom yang memiliki tanda (*)";
        }
    }
    
}
?>
