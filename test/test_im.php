<?php
require "../connection/koneksi.php";
require "../vendor/autoload.php";

$target_dir = '';
$file_name  = '';

use PhpOffice\PhpSpreadsheet\IOFactory;

function upfiles()
{
    global $koneksi;

    if (isset($_POST['import'])) {
        $file           = $_FILES['file']['name'];
        $ekstensi       = explode(".", $file);
        $file_name      = "file-" . round(microtime(true)) . "." . end($ekstensi);
        $sumber         = $_FILES['file']['tmp_name'];
        $target_dir     = "../file/";
        $target_file    = $target_dir . $file_name; // menggunakan $file_name sebagai nilai target_file
        $upload         = move_uploaded_file($sumber, $target_file);

        $inputFileType = 'Xlsx';

        //  $inputFileName = $target_dir . $file_name;
        $inputFileName = $target_file;
        $reader = \PhpOffice\PhpSpreadsheet\IOFactory::createReader($inputFileType);
        /**  Load $inputFileName to a Spreadsheet Object  **/
        $spreadsheet = $reader->load($inputFileName);

        $sheetAktif = $spreadsheet->getActiveSheet();
        $data_siswa = $sheetAktif->toArray();

        $isError = false; // Variabel flag untuk menandai adanya kesalahan

        foreach ($data_siswa as $row => $tiap_siswa) {
            if ($row >= 7) {
                $nikSiswa = $tiap_siswa[0];
                $nisn = $tiap_siswa[1];
                $namaSiswa = $tiap_siswa[2];
                $jkSiswa = $tiap_siswa[3];
                $tglLahir = DateTime::createFromFormat('d/m/Y', $tiap_siswa[4])->format('Y-m-d');
                $kelasSiswa = $tiap_siswa[5];
                $namaIbu = $tiap_siswa[6];

                // Query SQL untuk memasukkan data ke dalam tabel siswa
                $sql = "INSERT INTO siswa (nikSiswa, nisn, namaSiswa, jkSiswa, tgLahir, kelasSiswa, namaIbu) VALUES ('$nikSiswa', '$nisn', '$namaSiswa', '$jkSiswa', '$tglLahir', '$kelasSiswa', '$namaIbu')";
                try {
                    mysqli_query($koneksi, $sql);
                } catch (mysqli_sql_exception $e) {
                    $isError = true; // Mengatur variabel flag menjadi true jika terjadi kesalahan
                    break;
                }
            }
        }

        if ($isError) {
            echo '<div class="alert alert-danger" role="alert">Error : Terdapat data duplikat</div>';
            header("refresh:2;url=import.php"); //2 : detik
        } else {
            echo '<div class="alert alert-success" role="alert">Berhasil mengunggah file</div>';
            header("refresh:2;url=import.php"); //2 : detik
        }
        unlink($target_file);
    }
}
