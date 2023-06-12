<?php
$nama_user   = "";
$email       = "";
$password    = "";
$sebagai     = "";
$sukses      = "";
$error       = "";

if (isset($_GET['op'])) {
    $op = $_GET['op'];
} else {
    $op = "";
}

if ($op == 'delete') {
    $id_user = $_GET['id_user'];
    $sql1    = "DELETE FROM user WHERE id_user = '$id_user'";
    $q1      = mysqli_query($koneksi, $sql1);
    if ($q1) {
        $sukses = "Berhasil hapus data";
    } else {
        $error  = "Gagal melakukan delete data";
    }
}

if ($op == 'edit') {
    $id_user    = $_GET['id_user'];
    $sql1       = "SELECT * FROM user WHERE id_user = '$id_user'";
    $q1         = mysqli_query($koneksi, $sql1);
    $r1         = mysqli_fetch_array($q1);
    $nama_user  = $r1['nama_user'];
    $email      = $r1['email'];
    $password   = $r1['pass'];
    $sebagai    = $r1['sebagai'];

    if ($nama_user == '') {
        $error = "Data tidak ditemukan";
    }
}

if (isset($_POST['simpan'])) {
    $nama_user   = $_POST['nama_user'];
    $email       = $_POST['email'];
    $password    = $_POST['pass'];
    $sebagai     = $_POST['sebagai'];

    if ($nama_user && $email && $password && $sebagai) {
        if ($op == 'edit') {
            $sql1       = "UPDATE user SET nama_user = '$nama_user', email='$email', pass='$password', sebagai='$sebagai' WHERE id_user = '$id_user'";
            $q1         = mysqli_query($koneksi, $sql1);
            if ($q1) {
                $sukses = "Data berhasil diupdate";
            } else {
                $error  = "Data gagal diupdate";
            }
        } else {
            $sql1   = "INSERT INTO user (nama_user, email, pass, sebagai) VALUES ('$nama_user', '$email', '$password', '$sebagai')";
            $q1     = mysqli_query($koneksi, $sql1);
            if ($q1) {
                $sukses = "Berhasil memasukkan data baru";
            } else {
                $error  = "Gagal memasukkan data";
            }
        }
    } else {
        $error = "Silahkan masukkan semua data";
    }
}
?>