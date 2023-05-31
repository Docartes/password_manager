<?php
require 'controller/functions.php';

if (isset($_POST['save'])) {
	if (add() > 0) {
		header("Location: index.php");
	} else {
		echo 'gagal';
	}
}


?>


<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-KK94CHFLLe+nY2dmCWGMq91rCGa5gtU4mk92HdvYe+M/SXH301p5ILy+dN9+nJOZ" crossorigin="anonymous">
	<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.4/font/bootstrap-icons.css">
	<title>Password Manager</title>
</head>
<body class="ms-3">

	<h1>Password Manager</h1>

	<form action="" method="post" id="form" class="mt-3">
		<input type="text" name="manage" id="manage" class="form-control form-control-sm mb-3" style="width: 200px;" placeholder="Manage for..." autocomplete="off" required>	
		<button name="generate" class="btn btn-primary" id="generate" onclick="<?php $password = generatePassword(); ?>">Generate Password</button>
		<br>
		<input type="text" name="password" id="password" value="<?php echo $password; ?>" class="form-control form-control-sm mt-3" style="width: 200px; display: none;" autocomplete="off" required>
		<div class="buttons">
			<button name="save" id="saveBtn" style="width: 100px; display: none;" class="btn btn-success btn-sm mt-3">Save</button>	
			<button name="cancel" id="cancelBtn" style="width: 100px; display: none;" class="btn btn-danger btn-sm mt-3">Cancel</button>
		</div>		
	</form>

	<div class="buttonShow mt-3">
		<button id="showList" style="margin-top: 10px;" class="btn btn-sm btn-secondary">Show List</button>
		<button id="hideList" style="margin-top: 10px;" class="btn btn-sm btn-secondary">Hide List</button>
	</div>
	
	
	<ul id="listPassword" style="display: none;" class="mt-3">
		<?php while ($row = mysqli_fetch_assoc($result)) : ?>
			<li style="list-style: none; margin-left: -32px;">
				<div class="parent d-flex">
					<div class="data border border-1 p-2" style="width: 280px;">
						<span class="fw-bold">
							<?php echo $row["manage"]; ?>
						</span> : <span class="fst-italic">
							<?php 
							$key = "secret_key";
							$chiper = "AES-256-ECB";
							$option = OPENSSL_RAW_DATA;
							$pass = openssl_decrypt(base64_decode($row["password"]), $chiper, $key, $option);
							echo $pass;
							?>
						</span>
					</div>
					<div class="delete p-2 border border-1 me-2 ">
						<a href="controller/delete.php?id=<?php echo $row["id"]; ?>" onclick="return confirm('Are you want delete it?')"><i class="text-danger fw-bold bi bi-trash " style="font-size: 20px;"></i></a>	
					</div>
				</div>
			</li>
		<?php endwhile; ?>
	</ul>


	<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
	<script>
		$(document).ready(function() {
			// show and hide list
			$("#showList").click(function(event) {
				event.preventDefault();
				$("#listPassword").show();
			});
			$("#hideList").click(function(event) {
				event.preventDefault();
				$("#listPassword").hide();	
			});

			// show generate password
			$("#generate").click(function(event) {
				event.preventDefault();
				$("#password").show();
				$("#cancelBtn").show();
				$("#saveBtn").show();
			});

			$.post
		})
	</script>
</body>
</html>