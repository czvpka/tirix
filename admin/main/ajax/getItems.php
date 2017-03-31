<?php
	ini_set("display_errors", "1");
	require $_SERVER['DOCUMENT_ROOT']."/demo/config.php";
	$cat = $_POST['cat'];
	if($cat=='all') {
		$query = "SELECT * FROM items";
	} else {
		$query = "SELECT * FROM items WHERE category = '$cat'";
	}
	if(!$result = $dbc->query($query)) {
		echo "blad";
	}
	if($result->num_rows > 0) {
		$items = null;
		while($row = $result->fetch_array()) {
			$items = $items."
				<li class='item'>
					<div class='checkbox'>
						<div class='check'></div>
					</div>
					<div class='edit'>
						<a href='index.php?page=edit&id=".$row['id']."'>
							<span class='fa fa-pencil'></span>
						</a>
					</div>
					<div class='preview'></div>
					<div class='description'>
						<div class='price'>$".number_format($row['price'],2,'.',',')."</div>
						<div class='title'>".$row['name']."</div>
						<p>".$row['short_desc']."</p>
					</div>
				</li>";
		}
		echo $items;
	} else {
		echo "brak";
	}
?>