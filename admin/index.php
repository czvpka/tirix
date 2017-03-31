<?php
	require $_SERVER['DOCUMENT_ROOT']."/demo/config.php";
	ini_set('display_errors','Off'); 
	session_start();
	if(isset($_POST)) {
		$nick = $_POST['login'];
		$pass = md5($_POST['password']);
		$query = "SELECT * FROM users WHERE user = '$nick'";
		$result = $dbc->query($query) or trigger_error($dbc->error."[$query]");
		if($result->num_rows > 0) {
			$row = $result->fetch_array();
			$saltb = ".M!$C,";
			$salta = "12mM%B#*";
			if($row['user'] == $nick && $row['password'] == $pass) {
				$_SESSION['username'] = $row['user'];
				$_SESSION['logged'] = 1;
				Header("Location: /demo/admin/main/index.php?page=dash");
			} else {
				$blad = "Incorrect username or password!";
			}
		} else {
			$blad = "That user doesn't exist!";
			if($_POST['login'] == NULL) { $blad = ''; }
		}
	}
?>
<!DOCTYPE html>
<html>
	<head>
		<meta http-equiv="Content-Type" content="text/html; charset=utf-8">
		<meta http-equiv="X-UA-Compatible" content="IE=edge">
		<meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=no">
		<meta name="keywords" content="">
		<meta name="description" content="">
		<meta name="robots" content="index,follow">
		<meta name="language" content="Pl">
		<meta name="category" content="">
		<meta name="author" content="">
		<title>ItemShop - Panel</title>
		<link type="text/css" rel="stylesheet" href="./assets/styles/main.css">
		<link type="text/css" rel="stylesheet" href="./assets/styles/font.css">
		
		<!-- // ICONS 
		<link rel="icon" type="image/png" href="./assets/img/icons/ " sizes="196x196">
		<link rel="icon" type="image/png" href="./assets/img/icons/" sizes="96x96">
		<link rel="icon" type="image/png" href="./assets/img/icons/" sizes="32x32">
		<link rel="icon" type="image/png" href="./assets/img/icons/" sizes="16x16">
		<link rel="icon" type="image/png" href="./assets/img/icons/" sizes="128x128">
		-->
		<script src="./assets/scripts/jquery.min.js"></script>
		<!-- <script src="./assets/scripts/main.js"></script> -->
		<!--[if lt IE 9]>
			<script src="//html5shiv.googlecode.com/svn/trunk/html5.js"></script>
		<![endif]-->
	</head>
	<body>
		<div class='loader'></div>
		<section class='wrap'>
			<form method='post' action='index.php'>
				<h1>Panel admina</h1>
				<h2>Zaloguj się</h2>
				<input placeholder='login' type='text' value="admin" name='login' id='login'>
				<input placeholder='password' type='password' name='password' id='password'>
				<input type='hidden' name='sent' id='sent' value='1'>
				<div class='button'>
					<input id='login_btn' type='submit' value='Zaloguj'>
				</div>
				<div class='forgotPass'>
					<span class="alert">
						<?php if(isset($blad)) { echo $blad; } ?>
					</span>
				</div>
			</form>
		</section>
	</body>
</html>