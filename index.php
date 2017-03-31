<?php
    ini_set("display_errors", "1");
    require $_SERVER['DOCUMENT_ROOT']."/demo/config.php";
?>
<!DOCTYPE html>
<html>

	<head>
	
	
		<!-- // META TAGS -->
		<meta http-equiv="Content-Type" content="text/html; charset=utf-8">
		<meta http-equiv="X-UA-Compatible" content="IE=edge">
		<meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=no">
		
		<meta name="keywords" content="">
		<meta name="description" content="">
		<meta name="robots" content="index,follow">
		<meta name="language" content="Pl">
		<meta name="category" content="">
		<meta name="author" content="">
	
		<!-- // TITLE -->
		<title>ItemShop</title>
		
		<!-- // CSS -->
		<link type="text/css" rel="stylesheet" href="./assets/styles/main.css">
		
		<!-- // FONTS -->
		<link href="./assets/styles/Roboto,300,400,700.css" rel="stylesheet">
		
		<!-- // ICONS 
		<link rel="icon" type="image/png" href="./assets/img/icons/ " sizes="196x196">
		<link rel="icon" type="image/png" href="./assets/img/icons/" sizes="96x96">
		<link rel="icon" type="image/png" href="./assets/img/icons/" sizes="32x32">
		<link rel="icon" type="image/png" href="./assets/img/icons/" sizes="16x16">
		<link rel="icon" type="image/png" href="./assets/img/icons/" sizes="128x128">
		-->
		
		<!-- // SCRIPTS -->
		<script src="./assets/scripts/jquery.min.js"></script>
		<script src="./assets/scripts/main.js"></script>
		<!--[if lt IE 9]>
			<script src="//html5shiv.googlecode.com/svn/trunk/html5.js"></script>
		<![endif]-->
		
		
	</head>
	<body>
<header>
  <section class='header'>
    <div class='headline'>
      <a>Lorem Ipsum</a>
    </div>
  </section>
  <section class='sub-header'>
    <nav>
      <ul class='categories' id='filter'>
		<a data-group='all'>
          <li title='All'>Wszystko</li>
        </a>
        <a data-group='boost'>
          <li title='Boosts'>Ulepszenia</li>
        </a>
        <a data-group='item'>
          <li title='Items'>Itemy</li>
        </a>
        <a data-group='rank'>
          <li title='Ranks'>Rangi</li>
        </a>
		<a data-group='treasure'>
          <li title='Treasure'>Niespodzianka</li>
        </a>
      </ul>
    </nav>
  </section>
</header>
<aside class='side-panel'></aside>
<main>
  <div class='container'>
    <div class='items-grid' id='grid'>
<?php
$query = "SELECT * FROM items";
$result = $dbc->query($query);
while($row = $result->fetch_array()) {
?>
      <div class='item-box' data-group="<?php echo $row['category']; ?>"><?php echo $row['name']; ?></div>
<?php } ?>
    
</div>
  </div>
</main>
</body>