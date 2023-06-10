<?php
	include '../connection/koneksi.php';
	session_start();
	require_once 'proses_login.php';
	if(isset($_SESSION['logged_in']) == true){
		header("Location : ");
	}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <link rel="stylesheet" href="assets/css/style.css">
    <title>E - Rapor</title>
</head>
<body>
<div class="container" id="container">
	<!-- <div class="form-container absen-container">
		<form action="#">
			<h1>Absen</h1>
			<input type="email" placeholder="Email" />
			<input type="password" placeholder="Password" />
			<button class="loginButton">Login</button>
		</form>
	</div> -->
	<div class="form-container loginGuru-container">
		<form action="#" method="post">
			<h1>Login</h1>
			<input type="email" placeholder="Email" name="email" />
			<input type="password" placeholder="Password" name="pass"/>
			<a href="#">Lupa Password?</a>
			<button class="loginButton" name="submit">Login</button>
		</form>
	</div>
	<div class="overlay-container">
		<div class="overlay">
			<div class="overlay-panel overlay-left">
				<!-- <h1>Selamat Datang</h1>
				<p>Login lewat halaman Absen untuk masuk ke aplikasi E-Absen</p>
				<button class="ghost" id="loginGuru">Login Guru</button> -->
			</div>
			<div class="overlay-panel overlay-right">
				<h1>Selamat Datang</h1>
				<p>Masuk ke halaman Login Guru untuk masuk kedalam dashboard</p>
				<!-- <button class="ghost" id="absen">Absen</button> -->
			</div>
		</div>
	</div>
</div>
</body>
</html>