<?php
	require $_SERVER['DOCUMENT_ROOT']."/demo/config.php";
	$ranks = array(1=>"Owner", 2=>"Administrator", 3=>"Moderator");
	session_start();
	header("Access-Control-Allow-Origin: *");
	$nick = $_SESSION['username'];
	$query = "SELECT rank FROM users WHERE user = '$nick'";
	$result = $dbc->query($query) or trigger_error($dbc->error."[$query]");
	if($result->num_rows > 0) {
		$row = $result->fetch_array();
		$_SESSION['rank'] = $ranks[$row['rank']];
	} else {
		session_destroy();
		Header("Location: /demo/admin/index.php");
	}
?>
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
		<meta name="theme-color" content="#2083dc">
		<meta name="author" content="">
		<title>Panel</title>
		<script src="../assets/scripts/jquery.min.js"></script>
		<script src="../assets/scripts/cleave.min.js"></script>
		<script src="http://cloud.tinymce.com/stable/tinymce.min.js?apiKey=r67v44rdbbv5mkucuzpnlw4zc7ppxoxgz33pp112qjvhxak9"></script>
		<script>tinymce.init({ selector:'textarea' });</script>
		<script src="../assets/scripts/panel.js"></script>
		<link href="https://fonts.googleapis.com/css?family=Open+Sans:300,400,600,700" rel="stylesheet">
		<link type="text/css" rel="stylesheet" href="../assets/styles/panel.css" >
		<link type="text/css" rel="stylesheet" href="../assets/styles/alertify.css" >
		<link type="text/css" rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css">
		<!-- // ICONS 
		<link rel="icon" type="image/png" href="./assets/img/icons/ " sizes="196x196">
		<link rel="icon" type="image/png" href="./assets/img/icons/" sizes="96x96">
		<link rel="icon" type="image/png" href="./assets/img/icons/" sizes="32x32">
		<link rel="icon" type="image/png" href="./assets/img/icons/" sizes="16x16">
		<link rel="icon" type="image/png" href="./assets/img/icons/" sizes="128x128">
		-->
		<!--[if lt IE 9]>
			<script src="//html5shiv.googlecode.com/svn/trunk/html5.js"></script>
		<![endif]-->
		</head>
	<body>
		<section class='side-panel'>
			<header>
				<div class='title'>
					<span>Tirix</span>
				</div>
			</header>
			<nav>
				<ul>
					<li>
						<a href='?page=dash' title='Dashboard'>
							<span>Dashboard</span>
							<i class='fa fa-compass'></i>
						</a>
					</li>
					<li>
						<a href='?page=items' title='Items'>
							<span>Items</span>
							<i class='fa fa-list'></i>
						</a>
					</li>
					<li>
						<a href='?page=categories' title='Categories'>
							<span>Categories</span>
							<i class='fa fa-tags'></i>
						</a>
					</li>
					<li>
						<a href='?page=settings' title='Settings'>
							<span>Settings</span>
							<i class='fa fa-sliders'></i>
						</a>
					</li>
					<li>
						<a href='?page=support' title='Support'>
							<span>Support</span>
							<i class='fa fa-envelope-open-o'></i>
						</a>
					</li>
				</ul>
			</nav>
			<div class="logout">
				<button onclick="window.location.href='./?page=logout'">Log out!</button>
			</div>
		</section>
		<section class='head-panel'>
			<header>
				<div class='top tools'>
					<div class='container'>
						<div class='button-box'>
							<button id='toggle-menu'>
								<svg viewBox='0 0 53 53' x='0px' xmlns='http://www.w3.org/2000/svg' y='0px'>
									<path d='M2,13.5h49c1.104,0,2-0.896,2-2s-0.896-2-2-2H2c-1.104,0-2,0.896-2,2S0.896,13.5,2,13.5z'></path>
									<path d='M2,28.5h49c1.104,0,2-0.896,2-2s-0.896-2-2-2H2c-1.104,0-2,0.896-2,2S0.896,28.5,2,28.5z'></path>
									<path d='M2,43.5h49c1.104,0,2-0.896,2-2s-0.896-2-2-2H2c-1.104,0-2,0.896-2,2S0.896,43.5,2,43.5z'></path>
								</svg>
							</button>
						</div>
						<div class='search-bar'>
							<input placeholder='Search' type='text'>
						</div>
					</div>
				</div>
				<div class='bottom notification'>
					<div class='container'>
						<div class='profile-wrap'>
							<div class='avatar'></div>
							<div class='user-info'>
								<div class='name'><?php echo $_SESSION['username']; ?></div>
								<div class='rank'><?php echo $_SESSION['rank']; ?></div>
							</div>
						</div>
						<div class='notify-wrap'>
							<div class='element'>
								<div class='text'>Notification</div>
								<div class='icon' id='notification'>
									<svg viewBox='0 0 47.834 47.834' x='0px' xmlns='http://www.w3.org/2000/svg' y='0px'>
										<path d="M46.878,41.834H0.956l0.005-1.005c0.021-4.065,2.87-7.548,6.759-8.437V20.697C7.72,11.766,14.985,4.5,23.916,4.5    c8.932,0,16.198,7.266,16.198,16.197v11.695c3.889,0.89,6.737,4.372,6.759,8.437L46.878,41.834z M3.042,39.834h41.75    c-0.458-2.908-2.804-5.241-5.8-5.61l-0.878-0.107V20.697c0-7.828-6.369-14.197-14.198-14.197C16.088,6.5,9.72,12.869,9.72,20.697    v13.419l-0.878,0.107C5.845,34.592,3.5,36.925,3.042,39.834z"/>
										<path d="M21.125,5.988h-2V4.792C19.125,2.149,21.274,0,23.917,0c2.642,0,4.791,2.149,4.791,4.792v1.176h-2V4.792    C26.708,3.253,25.456,2,23.917,2c-1.539,0-2.792,1.253-2.792,2.792V5.988z"/>
										<path d="M23.903,47.834c-3.941,0-7.375-2.799-8.164-6.656l1.959-0.4c0.6,2.93,3.209,5.057,6.205,5.057    c3.058,0,5.677-2.179,6.228-5.18l1.967,0.361C31.373,44.967,27.927,47.834,23.903,47.834z"/>
										<rect x="8.72" y="32.231" width="3.682" height="2"/>
										<rect x="18.167" y="32.231" width="20.947" height="2"/>
									</svg>
								</div>
							</div>
						</div>
					</div>
				</div>
			</header>
			<main>
				<?php
					if(isset($_GET)) {
						$page = $_GET['page'];
					} else {
						$page = 'dash';
					}
					$pfile = $_SERVER['DOCUMENT_ROOT']."/demo/admin/main/template/".$page.".php";
					$dfile = $_SERVER['DOCUMENT_ROOT']."/demo/admin/main/template/dash.php";
					if(file_exists($pfile)) {
						require $pfile;
					} else {
						require $dfile;
					}
				?>
			</main>
		</section>
		<script src="//cdn.rawgit.com/alertifyjs/alertify.js/v1.0.10/dist/js/alertify.js"></script>
	</body>
</html>