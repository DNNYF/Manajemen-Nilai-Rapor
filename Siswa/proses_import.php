<?php
require "../connection/koneksi.php";
require "../vendor/autoload.php";

$target_dir = '';
$file_name  = '';

use PhpOffice\PhpSpreadsheet\IOFactory;

function uploadFile()
{
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

        $inputFileType = 'Xlsx';

        //  $inputFileName = $target_dir . $file_name;
        $inputFileName = '../file/sample/siswa.xlsx';
        $reader = \PhpOffice\PhpSpreadsheet\IOFactory::createReader($inputFileType);
        /**  Load $inputFileName to a Spreadsheet Object  **/
        $spreadsheet = $reader->load($inputFileName);

        $sheetAktif = $spreadsheet->getActiveSheet();
        $data_siswa = $sheetAktif->toArray();

        foreach ($data_siswa as $row => $tiap_siswa) {
            if ($row >= 6) {
                echo "<pre>";
                print_r($tiap_siswa);
            }
        };
    }
}
