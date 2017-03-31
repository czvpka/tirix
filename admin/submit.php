<?php
	require $_SERVER['DOCUMENT_ROOT']."/demo/config.php";
	ini_set('display_errors','Off'); 
	if($_POST['login'] == NULL) { return; }
	if(isset($_POST)) {
		$nick = $_POST['login'];
		$pass = md5($_POST['password']);
		$query = "SELECT * FROM users WHERE user = '$nick' AND password = '$pass'";
		$result = $dbc->query($query) or trigger_error($dbc->error."[$query]");
		if($result->num_rows > 0) {
			$row = $result->fetch_array();
			if($row['login'] == $nick && $row['password'] == $pass) {
				Header("Location: /demo/admin/main/index.php?page=dash");
			} else {
				echo "bledne haslo/nazwa";
			}
		} else {
			echo "nie ma takiego uzytkownika";
		}
	} else {
		echo "brak postu";
	}
?>