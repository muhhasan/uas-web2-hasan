<?php 
session_start();

include 'koneksi.php';

$username = $_POST['txtUserName'];
$password = $_POST['txtPassword'];
 
$result = mysqli_query($db, "SELECT * FROM ms_login where username='$username' and password='$password'");

$cek = mysqli_num_rows($result);
 
if($cek > 0) {
	$data = mysqli_fetch_assoc($result);
	//menyimpan session user, nama, status dan id login
	$_SESSION['username'] = $username;
	$_SESSION['nama'] = $data['userDisplayName'];
	$_SESSION['status'] = "sudah_login";
	// $_SESSION['id_login'] = $data['id'];
	header("location:pgMasterRelawan.php");
} else {
	header("location:index.php?pesan=gagal login data tidak ditemukan.");
}
?>