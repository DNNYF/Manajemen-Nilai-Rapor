<?php
$sqlSiswa = "SELECT * FROM siswa WHERE kelasSiswa = '$kelas'";
$querySiswa = mysqli_query($koneksi, $sqlSiswa);
$nomor = 1;

while ($row = mysqli_fetch_array($querySiswa)) {
    $nisnSiswa = $row['nisn'];
    $namaSiswa = $row['namaSiswa'];
    $semester = $row['semester'];
    $tugas = $row['tugas'];
    $uas = $row['uas'];
    $uts = $row['uts'];
    $n_nilai = array($tugas, $uts, $uas);
    $jml_nilai = count($n_nilai);
    $sum_nilai = array_sum($n_nilai);
    $rata_rata = $jml_nilai > 0 ? $sum_nilai / $jml_nilai : 0;
    if ($rata_rata > 0 && $rata_rata <= 50) {
        $predikat = "D";
    } elseif ($rata_rata > 50 && $rata_rata <= 60) {
        $predikat = "C";
    } elseif ($rata_rata > 60 && $rata_rata <= 75) {
        $predikat = "B";
    } elseif ($rata_rata > 75 && $rata_rata <= 100) {
        $predikat = "A";
    } else {
        $predikat = "-";
    }
?>
    <tr>
        <td scope="row"><?php echo $nomor++ ?></td>
        <td>
            <input class="inpNilai" type="text" name="nisn[]" value="<?php echo $nisnSiswa ?>" readonly>
        </td>
        <td><?php echo $namaSiswa ?></td>
        <td>
            <input class="inpNilai" type="number" name="semester[]" value="<?php echo $semester ?>">
        </td>
        <td>
            <input class="inpNilai" type="number" name="tugas[]" value="<?php echo $tugas ?>">
        </td>
        <td>
            <input class="inpNilai" type="number" name="uts[]" value="<?php echo $uts ?>">
        </td>
        <td>
            <input class="inpNilai" type="number" name="uas[]" value="<?php echo $uas ?>">
        </td>
        <td>
            <input class="inpNilai" type="number" name="rata[]" value="<?php echo $rata_rata ?>" readonly>
        </td>
        <td>
            <input class="inpNilai" type="text" name="predikat[]" value="<?php echo $predikat ?>" readonly>
        </td>
    </tr>
<?php
}
?>
