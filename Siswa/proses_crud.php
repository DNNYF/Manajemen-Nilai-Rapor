<?php
include "../connection/koneksi.php";

// deklarasi varible data siswa
$nikSiswa   = "";
$kelasSiswa = "";
$nisn       = "";
$namaSiswa  = "";
$jkSiswa    = "";
$tgLahir    = "";
$namaIbu    = "";
$error      = "";
$sukses     = "";
$op         = "";
$idSiswa    = "";
$kelasSiswa      = "";
$dapat      = "";
$q2         = "";


if (isset($_GET['op'])) {
    $op = $_GET['op'];
} else {
    $op = "";
}

if ($op == 'edit') {
    $button    = 'edit';
} else {
    $button    = 'simpan';
}

if ($op == 'delete') {
    $idSiswa = $_GET['idSiswa'];

    // Mengambil NISN sebelum menghapus data siswa
    $sql2 = "SELECT nisn FROM siswa WHERE idSiswa = '$idSiswa'";
    $q2 = mysqli_query($koneksi, $sql2);

    if (mysqli_num_rows($q2) > 0) {
        $r2 = mysqli_fetch_assoc($q2);
        $nisn = $r2['nisn'];

        // Menghapus data siswa
        $sql1 = "DELETE FROM siswa WHERE idSiswa = '$idSiswa'";
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
}


$sqlkelas   = "SELECT kelas FROM kelas";
$qKelas     = mysqli_query($koneksi, $sqlkelas); //queryKelas
$nokel      = 1;

if ($op == 'edit') {
    $idSiswa    = $_GET['idSiswa'];
    $sql1       = "SELECT * FROM siswa WHERE idSiswa = '$idSiswa'";
    $q1         = mysqli_query($koneksi, $sql1);
    $r1         = mysqli_fetch_array($q1);
    $nikSiswa   = $r1['nikSiswa'];
    $nisn       = $r1['nisn'];
    $namaSiswa  = $r1['namaSiswa'];
    $jkSiswa    = $r1['jkSiswa'];
    $tgLahir    = $r1['tgLahir'];
    $kelasSiswa = $r1['kelasSiswa'];
    $namaIbu    = $r1['namaIbu'];
    if ($nikSiswa == '') {
        $error = "Data tidak ditemukan";
    }

    if (isset($_POST['edit'])) {
        $nikSiswa   = mysqli_real_escape_string($koneksi, $_POST['nikSiswa']);
        $nisn       = mysqli_real_escape_string($koneksi, $_POST['nisn']);
        $namaSiswa  = mysqli_real_escape_string($koneksi, $_POST['namaSiswa']);
        $jkSiswa    = mysqli_real_escape_string($koneksi, $_POST['jkSiswa']);
        $tgLahir    = mysqli_real_escape_string($koneksi, $_POST['tgLahir']);
        $namaIbu    = mysqli_real_escape_string($koneksi, $_POST['namaIbu']);
        $kelasSiswa = mysqli_real_escape_string($koneksi, $_POST['kelasSiswa']);

        //mengirim variable ke database
        if ($namaSiswa && $jkSiswa && $kelasSiswa && $nikSiswa && $nisn) {
            $sql1 = "UPDATE siswa SET namaSiswa = '$namaSiswa', jkSiswa = '$jkSiswa', kelasSiswa = '$kelasSiswa', tgLahir = '$tgLahir', namaIbu = '$namaIbu', nikSiswa = '$nikSiswa', nisn = '$nisn' WHERE idSiswa='$idSiswa'";
            try {
                $q1 = mysqli_query($koneksi, $sql1);
                if ($q1) {
                    $sukses = "Berhasil memasukan data baru";
                } else {
                    $error = "Gagal Menambahkan Data";
                }
            } catch (mysqli_sql_exception $e) {
                if (strpos($e->getMessage(), 'Duplicate entry') !== false) {
                    $error = "Gagal Menambahkan data";
                } else {
                    $error = $e->getMessage();
                }
            }
        } else {
            $error = "Silahkan masukan Data";
        }
    }
}

if (isset($_POST['simpan'])) {
    $nikSiswa       = mysqli_real_escape_string($koneksi, $_POST['nikSiswa']);
    $nisn           = mysqli_real_escape_string($koneksi, $_POST['nisn']);
    $namaSiswa      = mysqli_real_escape_string($koneksi, $_POST['namaSiswa']);
    $jkSiswa        = mysqli_real_escape_string($koneksi, $_POST['jkSiswa']);
    $tgLahir        = mysqli_real_escape_string($koneksi, $_POST['tgLahir']);
    $kelasSiswa     = mysqli_real_escape_string($koneksi, $_POST['kelasSiswa']);
    $namaIbu        = mysqli_real_escape_string($koneksi, $_POST['namaIbu']);

    //mengirim variable ke database
    if ($namaSiswa && $jkSiswa && $tgLahir && $kelasSiswa && $nikSiswa && $nisn) {
        $sql1 = "INSERT INTO siswa (namaSiswa, jkSiswa, tgLahir, kelasSiswa, namaIbu, nikSiswa, nisn) 
                 VALUES ('$namaSiswa', '$jkSiswa', '$tgLahir', '$kelasSiswa', '$namaIbu', '$nikSiswa', '$nisn')";
        try {
            $q1 = mysqli_query($koneksi, $sql1);
    
            if ($q1) {
                $sukses = "Berhasil memasukkan data baru";
    
                $sql_nilai = "SELECT * FROM mapel";
                $query_nilai = mysqli_query($koneksi, $sql_nilai);
    
                while ($row_nilai = mysqli_fetch_assoc($query_nilai)) {
                    $mapel = $row_nilai['mapel'];
                    $sqlInsertNilai = "INSERT INTO nilai (namaSiswa, nisn, semester, mapel, kelasSiswa, tugas, uts, uas) 
                                       VALUES ('$namaSiswa', '$nisn', '-', '$mapel', '$kelasSiswa', '0', '0', '0')";
    
                    $q2 = mysqli_query($koneksi, $sqlInsertNilai);
    
                    if (!$q2) {
                        $error = "Gagal Menambahkan Data Nilai";
                        break;
                    }
                }
            } else {
                $error = "Gagal Menambahkan Data Siswa";
            }
        } catch (mysqli_sql_exception $e) {
            if (strpos($e->getMessage(), 'Duplicate entry') !== false) {
                $error = "Gagal Menambahkan Data, Data Duplikat";
            } else {
                $error = $e->getMessage();
            }
        }
    }
    
    else {
        $error = "Silahkan masukan Data";
    }
}
