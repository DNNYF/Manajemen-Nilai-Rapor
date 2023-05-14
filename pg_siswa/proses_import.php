<?php
require "../connection/koneksi.php";

$target_dir = '';
$file_name  = '';

function uploadFile() {
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
            exit;
        } else {
            echo '<div class="alert alert-danger" role="alert">Gagal mengunggah file. Silakan coba lagi.</div>';
        }
    }   
}


use PhpOffice\PhpSpreadsheet\IOFactory;
function processSpreadsheetFile($target_dir, $file_name){
    
    require "../vendor/autoload.php";
    ## PHP SPREADSHEET
    
    
    $inputFileType = 'Xlsx';
    
    $inputFileName = $target_dir . $file_name;
    try {
        /**  Create a new Reader of the type defined in $inputFileType  **/
        $reader = IOFactory::createReader($inputFileType);
        /**  Load $inputFileName to a Spreadsheet Object  **/
        $spreadsheet = $reader->load($inputFileName);
    } catch (Exception $e) {
        die('Error loading file: ' . $e->getMessage());
    }
    
    // Generate a dynamic filename for the output file
    $outputFileName = "output-" . round(microtime(true)) . ".xlsx";
    
    // Save the spreadsheet to the output file
    $writer = IOFactory::createWriter($spreadsheet, 'Xlsx');
    $writer->save($target_dir . $outputFileName);

}

