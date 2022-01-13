<?php  
session_start();

if(isset($_SESSION["login"])){
	header("location: ../crud/index.php");
}

?>

<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<title>LOGIN</title>
	<link rel="stylesheet" href="style.css">
</head>
<body>

	<?php  

if (isset( $_POST['submit']) ){
	require'koneksi.php';
	$username = $_POST['username'];
	$password = $_POST['password'];

	$cek_username = mysqli_query($conn, "SELECT * FROM users WHERE username = '$username' ");
	$row = mysqli_num_rows($cek_username);

	if ( $row === 1 ){
		//jalankan seleksi password
		$fetch_pass = mysqli_fetch_assoc($cek_username);
		$cek_pass = $fetch_pass['password'];

		if( $cek_pass <> $password){
				echo "
					<script>
					alert('password yang anda masukkan salah');
					</script>
				";
		}else {
			$_SESSION['login'] = true;
			//header("location: dashboardlogin.php");
			echo "
			<script>
			document.location.href='../crud/index.php';
			</script>

		";

		}
	}else {
		echo "
			<script>
			alert('Username salah atau belum terdaftar');
			</script>

		";

	}
}

?>


<form action="" class="box" method="post">
	<h1>LOGIN</h1>

		<input type="text" name="username" placeholder="Username" autocomplete="off">
		<br><br>
		<input type="password" name="password" placeholder="Password">
		<br><br>
		<button type="submit" name="submit" >LOG IN</button>

</form>

	
</body>
</html>