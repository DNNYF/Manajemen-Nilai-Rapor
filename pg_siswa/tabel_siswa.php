<?php

if (isset($_POST['sortKelas']) && $_POST['sortKelas'] != 'noKelas') {
    $kelas = $_POST['sortKelas'];
    $sql = "SELECT * FROM siswa WHERE kelasSiswa='$kelas' ORDER BY namaSiswa ASC";
} else {
    $sql = "SELECT * FROM siswa ORDER BY namaSiswa ASC";
}
$q2             = mysqli_query($koneksi, $sql);
$urut           = 1;
while ($r2      = mysqli_fetch_array($q2)) {
    $idSiswa    = $r2['idSiswa'];
    $namaSiswa  = $r2['namaSiswa'];
    $jkSiswa    = $r2['jkSiswa'];
    $kelasSiswa = $r2['kelasSiswa'];
    $tgLahir    = $r2['tgLahir'];
    $namaIbu    = $r2['namaIbu'];
    $nikSiswa   = $r2['nikSiswa'];
    $nisn       = $r2['nisn'];
?>
    <tr>
        <th scope="row"><?php echo $urut++ ?></th>
        <td scope="row"><?php echo $namaSiswa ?></td>
        <td scope="row" class="jk"><?php echo $jkSiswa ?></td>
        <td scope="row"><?php echo $tgLahir ?></td>
        <td scope="row"><?php echo $kelasSiswa ?></td>
        <td scope="row"><?php echo $namaIbu ?></td>
        <td scope="row"><?php echo $nikSiswa ?></td>
        <td scope="row"><?php echo $nisn ?></td>
        <td scope="row">
            <a href="crudSiswa.php?op=edit&idSiswa=<?php echo $idSiswa ?>"><button type="button" class="btn btn-warning" name="edit">Edit</button></a>
            <a href="crudSiswa.php?op=delete&idSiswa=<?php echo $idSiswa ?>"><button type="button" class="btn btn-danger" name="delete">Delete</button></a>
        </td>

    </tr>

<?php
}
?>

