<?php
require "../connection/koneksi.php";
require "../vendor/autoload.php";
require "proses_crud.php";

$target_dir = '';
$file_name  = '';

use PhpOffice\PhpSpreadsheet\IOFactory;

function importfile()
{
    global $koneksi;

    if (isset($_POST['import'])) {
        if (!empty($_FILES['file']['name'])) {

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

            $isError = false;

            foreach ($data_siswa as $row => $tiap_siswa) {
                if ($row >= 7) {
                    $nikSiswa = $tiap_siswa[0];
                    $nisn = $tiap_siswa[1];
                    $namaSiswa = $tiap_siswa[2];
                    $jkSiswa = $tiap_siswa[3];
                    $tgLahir = DateTime::createFromFormat('d/m/Y', $tiap_siswa[4])->format('Y-m-d');
                    $kelasSiswa = $tiap_siswa[5];
                    $namaIbu = $tiap_siswa[6];

                    // Query SQL untuk memasukkan data ke dalam tabel siswa
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
                                    $isError = true;
                                    $error = "Gagal Menambahkan Data Nilai";
                                    break;
                                }
                            }
                        } else {
                            $isError = true;
                            $error = "Gagal Menambahkan Data Siswa";
                        }
                    } catch (mysqli_sql_exception $e) {
                        if (strpos($e->getMessage(), 'Duplicate entry') !== false) {
                            $isError = true;
                            $error = "Gagal Menambahkan Data, Data Duplikat";
                        } else {
                            $isError = true;
                            $error = $e->getMessage();
                        }
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
        } else {
            // File tidak diunggah, tampilkan pesan error
            echo '<div class="alert alert-danger" role="alert">Mohon pilih file untuk diunggah</div>';
        }
    }
}
