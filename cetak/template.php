<?php
require_once "../connection/koneksi.php";

if (isset($_GET['op'])) {
    $op = $_GET['op'];
} else {
    $op = "";
}
if ($op == 'cetak') {
    $nisn = $_GET['nisn'];
    $sql_cetak = "SELECT * FROM nilai WHERE nisn = '$nisn'";
}
$sql1 = "SELECT * FROM nilai WHERE nisn='$nisn' ";
$q1 = mysqli_query($koneksi, $sql1);
$r = mysqli_fetch_array($q1);
$idNilai = $r['idNilai'];
$namaSiswa = $r['namaSiswa'];
$kelasSiswa = $r['kelasSiswa'];
$semester = $r['semester'];
$nilaiAkhir = $r['nilaiAkhir'];
$nisn = $r['nisn'];

// $sql = "SELECT * FROM nilai WHERE nisn = '$nisn'";
$result = mysqli_query($koneksi, $sql1);

// Cek apakah query berhasil dijalankan
if ($result) {
    // Loop untuk mendapatkan setiap baris data
    while ($row = mysqli_fetch_assoc($result)) {
        // Akses data menggunakan $row['nama_kolom']
        $mapel = $row['mapel'];
        $nilaiAkhir = $row['nilaiAkhir'];
    }
}
// require_once('../vendor/tecnickcom/tcpdf/tcpdf.php');
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <title>Document</title>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <style>
        
        body {
            font-family: Arial, sans-serif;
            margin: 0;
            padding: 0;
        }

        #live-preview-body {
            /* margin: 20px; */
        }

        #watermark {
            position: fixed;
            top: 50%;
            left: 50%;
            transform: translate(-50%, -50%);
            font-size: 72px;
            color: lightgray;
            opacity: 0.5;
            z-index: -1;
        }

        #kop-surat-1 {
            text-align: center;
            margin-bottom: 20px;
        }

        #img-kiri,
        #img-kanan {
            display: flex;
            justify-content: center;
            align-items: center;
        }

        .desc-kop-surat {
            padding: 5px;
        }

        #garis-bawah-kop {
            margin-top: 20px;
        }

        .table-anak,
        .table-nilai,
        .table-ekskul,
        .table-absensi,
        .table-catatan,
        .table-signature {
            width: 100%;
            border-collapse: collapse;
            margin-bottom: 20px;
        }

        .table-anak {
            border: none;
        }


        .table-nilai th,
        .table-nilai td,
        .table-ekskul th,
        .table-ekskul td,
        .table-absensi th,
        .table-absensi td,
        .table-catatan td,
        .table-signature td {
            border: 1px solid black;
            padding: 5px;
        }

        .table-anak th {
            text-align: left;
        }

        .center {
            text-align: center;
        }

        .table-absensi td {
            width: 50%;
        }

        .table-catatan .catatan {
            padding: 10px;
        }

        .table-signature td {
            text-align: center;
            vertical-align: bottom;
            border: none;
        }

        .table-signature u {
            text-decoration: underline;
        }

        .table-signature br {
            line-height: 10px;
        }

        .wraper {
            width: 100%;
            /* margin-left: 10%; */
            border: 2px solid;
        }
    </style>
</head>

<body>
    <div class="wraper">
        <div id="live-preview-body">
            <div id="watermark"></div>
            <div id="kop-surat-1">
                <table style="width: 100%;">
                    <colgroup>
                        <col style="width: 95px;">
                        <col>
                        <col style="width: 95px;">
                    </colgroup>
                    <tbody>
                        <tr>
                            <td rowspan="6">
                                <div id="img-kiri">
                                    <img id='logo_kiri_pada_kop' src='../images/sd.png' alt="" height="95px" width="95px">
                                </div>
                            </td>
                            <td class="desc-kop-surat" id="desc-kop-surat-1" style=" font-weight: bold; font-size:  16px; color:#000000;">PEMERINTAH PROVINSI INDRAMAYU
                            </td>
                            <td rowspan="6">
                                <div id="img-kanan">
                                    <img id='logo_kanan_pada_kop' src='../images/Lambang-tut-wuri-handayani.webp' alt="" height="95px" width="95px">
                                </div>
                            </td>
                        </tr>
                        <tr>
                            <td class="desc-kop-surat" id="desc-kop-surat-2" style="  font-weight: bold; font-size:  14px; color:#000000;">DINAS PENDIDIKAN DAN
                                KEBUDAYAAN</td>
                        </tr>
                        <tr>
                            <td class="desc-kop-surat" id="desc-kop-surat-3" style="  font-weight: bold; font-size:  28px; color:#000000;">UPTD SDN 1 TERUSAN
                            </td>
                        </tr>
                        <tr>
                            <td class="desc-kop-surat" id="desc-kop-surat-4" style=" font-size:  12px; color:#000000;">
                                email: smansapanji@gmail.com</td>
                        </tr>
                        <tr>
                            <td class="desc-kop-surat" id="desc-kop-surat-5" style=" font-size:  12px; color:#000000;">
                                Jl.
                                Anthony Murad Kampung Panca Tunggal Jaya Kecamatan Penawar Aji Kabupaten Tulang Bawang
                            </td>
                        </tr>
                        <tr>
                            <td class="desc-kop-surat" id="desc-kop-surat-6" style=" font-size:  12px; color:#000000;">
                            </td>
                        </tr>
                    </tbody>
                </table>
                <hr id="garis-bawah-kop" style="background-color: black !important;color: black;height:1.0px;opacity:1;">
            </div>
            <table class="table-anak">
                <tbody>
                    <tr>
                        <td> Nama </td>
                        <td>:</td>
                        <td><?php echo $namaSiswa ?></td>
                        <td>Kelas</td>
                        <td>:</td>
                        <td><?php echo $kelasSiswa ?></td>
                    </tr>
                    <tr>
                        <td>NISN</td>
                        <td>:</td>
                        <td><?php echo $nisn ?></td>
                        <td>Semester</td>
                        <td>:</td>
                        <td><?php echo $semester ?></td>
                    </tr>
                    <tr>
                        <td>Nama Sekolah</td>
                        <td>:</td>
                        <td>UPTD SDN 1 TERUSAN</td>
                        <td>Tahun Pelajaran</td>
                        <td>:</td>
                        <td>2023</td>
                    </tr>
                    <tr>
                        <td>Alamat</td>
                        <td>:</td>
                        <td>Indramayu</td>

                    </tr>
                    <tr>
                        <td colspan="6">
                            <hr style="opacity: 1;" />
                        </td>
                    </tr>
                </tbody>
            </table>
            <h2>LAPORAN HASIL BELAJAR </h2>
            <table class="table-nilai">
                <tr>
                    <th style="width:6%">No</th>
                    <th style="width: 25%;">Mata Pelajaran</th>
                    <th style="width: 10%;">Nilai <br> Akhir</th>
                    <th style="width:60%">Capaian Kompetensi</th>
                </tr>
                <tbody>
                    <?php
                    $sql = "SELECT * FROM nilai WHERE nisn = '$nisn'";
                    // Eksekusi query dan proses hasilnya
                    $result = mysqli_query($koneksi, $sql);

                    // Cek apakah query berhasil dijalankan
                    if ($result) {
                        $urut = 1;
                        // Loop untuk mendapatkan setiap baris data
                        while ($row = mysqli_fetch_assoc($result)) {
                            // Akses data menggunakan $row['nama_kolom']
                            $mapel = $row['mapel'];
                            $nilaiAkhir = $row['nilaiAkhir'];
                            $catatan = $row['catatan'];
                            echo "<tr>
                                    <td class='center' rowspan='2'>" . $urut++ . "</td>
                                    <td rowspan='2'>" . $mapel . "</td>
                                    <td class='center' rowspan='2'>" . $nilaiAkhir . "</td>
                                </tr>
                                <tr>
                                    <td>" . $catatan . "</td>
                                </tr>";
                        }
                    }
                    ?>
                </tbody>
            </table>

            <h4 style="text-align: left;">Catatan Wali Kelas</h4>
            <table class="table-catatan">
                <tr>
                    <td class="catatan">
                        <?php echo $namaSiswa ?> harus tetap semangat belajar
                    </td>
                </tr>
            </table>

            <table class="table-signature">
                <tr>
                    <td style="width:20%">
                        Mengetahui<br>Orang Tua/Wali,
                    </td>
                    <td style="width:60%">

                    </td>
                    <td style="width:20%">
                        Indramayu, 11 Juni 2023<br>Wali Kelas,
                    </td>
                </tr>
                <tr>
                    <td style="vertical-align:bottom;height:100px;">
                        ........................
                    </td>
                    <td style="vertical-align:bottom;height:100px;">
                    </td>
                    <td style="vertical-align:bottom;height:100px;">
                        <br />
                        <u>SIRATNA NINGSIH, A.Ma.Pust</u><br>NIP.
                    </td>
                </tr>
                <tr>
                    <td>
                    </td>
                    <td style="text-align: center">
                        Mengetahui<br>Kepala Sekolah
                    </td>
                    <td>
                    </td>
                </tr>
                <tr>
                    <td style="vertical-align:bottom;height:100px;">
                    </td>
                    <td style="text-align: center;vertical-align:bottom;height:100px;">
                        <br />
                        <u>Muhamad Arwan Setiawan, S.pd.i</u><br>NIP. 2341222
                    </td>
                    <td style="vertical-align:bottom;height:100px;">
                    </td>
                </tr>
            </table>
        </div>
    </div>
</body>

</html>