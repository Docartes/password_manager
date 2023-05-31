<?php  

$conn = mysqli_connect("localhost", "root", "", "projek_kecil");
$result = mysqli_query($conn, "SELECT * FROM password_manager");

function generatePassword () {
	$length = 20;
	$char = "abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTYVWXYZ!@#$%^&*()_+={}[]/?123456789";
	$password = '';

	for ($i = 0; $i < $length; $i++) {
		$randomize = random_int(0, strlen($char) - 1);
		$password .= $char[$randomize];
	}

	return $password;
}

function add () {
	global $conn;
	$manage = $_POST["manage"];
	$passwd = $_POST["password"];
	$key = "secret_key";
	$chiper = "AES-256-ECB";
	$option = OPENSSL_RAW_DATA;
	$pass = openssl_encrypt($passwd, $chiper, $key, $option);
	$passwordEncrypt = base64_encode($pass);

	$query = "INSERT INTO password_manager VALUES('', '$manage', '$passwordEncrypt')";
	mysqli_query($conn, $query);

	return mysqli_affected_rows($conn);
}

function delete ($id) {
	global $conn;
	
	$query = "DELETE FROM password_manager WHERE id = $id";
	mysqli_query($conn, $query);

	return mysqli_affected_rows($conn);
}

?>