<!DOCTYPE html>
<html>

<head>
    <title>Form Input Nilai Siswa</title>
    <style>
        body {
            font-family: Arial, sans-serif;
        }

        h2 {
            color: #333;
            text-align: center;
        }

        form {
            width: 400px;
            margin: 0 auto;
        }

        label {
            display: block;
            margin-bottom: 5px;
        }

        input[type="number"],
        input[type="text"],
        select {
            width: 100%;
            padding: 10px;
            margin-bottom: 10px;
            border: 1px solid #ccc;
            border-radius: 4px;
            box-sizing: border-box;
        }

        #kelas {
            width: 80%;
        }

        input[type="submit"] {
            width: 100%;
            padding: 10px;
            background-color: #4CAF50;
            color: #fff;
            border: none;
            border-radius: 4px;
            cursor: pointer;
        }

        input[type="submit"]:hover {
            background-color: #45a049;
        }
    </style>
</head>

<body>
    <h2>Form Input Nilai Siswa</h2>
    <form method="POST" action="proses_input_nilai.php">
        <?php
        // Koneksi ke database
        $servername = "localhost";
        $username = "root";
        $password = "";
        $database = "erapor";

        $conn = new mysqli($servername, $username, $password, $database);

        // Memeriksa koneksi
        if ($conn->connect_error) {
            die("Koneksi gagal: " . $conn->connect_error);
        }

        // Query untuk mendapatkan data kelas dari tabel kelas
        $query_kelas = "SELECT kelas FROM kelas";
        $result_kelas = $conn->query($query_kelas);

        if ($result_kelas->num_rows > 0) {
            echo '<label for="kelas">Kelas:</label>';
            echo '<select id="kelas" name="kelas">';

            while ($row_kelas = $result_kelas->fetch_assoc()) {
                echo '<option value="' . $row_kelas["kelas"] . '">' . $row_kelas["kelas"] . '</option>';
            }

            echo '</select><br><br>';
        }

        // Menggunakan nilai yang dipilih dari dropdown kelas untuk query siswa
        $query_siswa = "SELECT namaSiswa FROM siswa";
        $result_siswa = $conn->query($query_siswa);
        // Mengisi data siswa ke dalam pilihan dropdown
        if ($result_siswa->num_rows > 0) {
            echo '<label for="nama">Nama Siswa:</label>';
            echo '<select id="nama" name="nama">';

            while ($row_siswa = $result_siswa->fetch_assoc()) {
                echo '<option value="' . $row_siswa["namaSiswa"] . '">' . $row_siswa["namaSiswa"] . '</option>';
            }

            echo '</select><br><br>';
        }
        // Query untuk mendapatkan data mata pelajaran dari tabel mapel
        $query_mapel = "SELECT mapel FROM mapel";
        $result_mapel = $conn->query($query_mapel);

        if ($result_mapel->num_rows > 0) {
            echo '<label for="mapel">Mata Pelajaran:</label>';
            echo '<select id="mapel" name="mapel">';

            while ($row_mapel = $result_mapel->fetch_assoc()) {
                echo '<option value="' . $row_mapel["mapel"] . '">' . $row_mapel["mapel"] . '</option>';
            }

            echo '</select><br><br>';
        }

        // Menutup koneksi database
        $conn->close();

        ?>

        <label for="tugas">Nilai Tugas:</label>
        <input type="number" id="tugas" name="tugas" min="0" max="100" required><br><br>

        <label for="uas">Nilai UAS:</label>
        <input type="number" id="uas" name="uas" min="0" max="100" required><br><br>

        <label for="uts">Nilai UTS:</label>
        <input type="number" id="uts" name="uts" min="0" max="100" required><br><br>

        <label for="semester">Semester:</label>
        <select id="semester" name="semester">
            <option value="1">Semester 1</option>
            <option value="2">Semester 2</option>
            <option value="3">Semester 3</option>
            <option value="4">Semester 4</option>
            <!-- Tambahkan opsi semester yang lain jika diperlukan -->
        </select><br><br>

        <label for="tahun_ajaran">Tahun Ajaran:</label>
        <input type="text" id="tahun_ajaran" name="tahun_ajaran" required><br><br>

        <input type="submit" value="Submit">
    </form>
</body>

</html>