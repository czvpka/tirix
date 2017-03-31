<?php
	ini_set("display_errors", "1");
	require $_SERVER['DOCUMENT_ROOT']."/demo/config.php";
	if($_POST['name']!==NULL) {
		$id = $_POST['id'];
		$name = $_POST['name'];
		$sdesc = $_POST['sdesc'];
		$desc = $_POST['desc'];
		$cat = $_POST['cat'];
		$price = $_POST['price'];
		$commands = $_POST['cmds'];
		$query = "UPDATE items SET name = '".$name."', short_desc = '".$sdesc."', description = '".$desc."', category = '".$cat."', price = '".$price."', commands = '".$commands."' WHERE id = '".$id."'";
		$result = $dbc->query($query);
		if(!$result) {
			echo "blad query";
		}
		if($dbc->affected_rows >= 0 && $dbc->error == '') {
			echo "zaktualizowano";
		}
	} else {
		echo "brak posta";
	}
?>