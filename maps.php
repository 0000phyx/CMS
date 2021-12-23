			
<!DOCTYPE HTML>
<!--
	Spatial by TEMPLATED
	templated.co @templatedco
	Released for free under the Creative Commons Attribution 3.0 license (templated.co/license)
-->
<html>
	<head>
		<title>GeminiProject - Maps</title>
		<meta http-equiv="content-type" content="text/html; charset=utf-8" />
		<meta name="description" content="" />
		<meta name="keywords" content="" />
		<!--[if lte IE 8]><script src="js/html5shiv.js"></script><![endif]-->
		<script src="js/jquery.min.js"></script>
		<script src="js/skel.min.js"></script>
		<script src="js/skel-layers.min.js"></script>
		<script src="js/init.js"></script>
		<noscript>
			<link rel="stylesheet" href="css/skel.css" />
			<link rel="stylesheet" href="css/style.css" />
			<link rel="stylesheet" href="css/style-xlarge.css" />
		</noscript>
	</head>
	<body class="landing">

		<!-- Header -->
			<header id="header" class="alt">
				<h1><strong><a href="index.html">GeminiProject!</a></strong>.</h1>
				<nav id="nav">
					<ul>
						<li><a href="index.php">Home</a></li>
						<li><a href="maps.php">Maps</a></li>
						<li><a href="ranking.php">Ranking</a></li>
						<li><a href="staff.php">Staff</a></li>
					</ul>
				</nav>
			</header>

		<!-- Banner -->
			<section id="banner">
				<h2>GeminiProject</h2>
				<p>Maps!</p>
				<table class="center standard-table">
			<?php
include('config.php');

$sql = "SELECT * FROM maps LIMIT 100"; 
$result = mysql_query($sql)or die(mysql_error()); 
echo "<tr><th>Map name</th><th>PlayersMax</th><th>Label</th></tr>"; while($row = mysql_fetch_array($result)){ $name = $row['Name']; 
$desc = $row['MaxPlayers'] . "<br />"; 
$price = $row['Name'] . "<br />";
echo "<tr><td style='width: 200px;'>".$name."</td><td style='width: 600px;'>".$desc."</td><td style='width: 600px;'>".$price."</td><</tr>"; } 

?>
</table>

<div class="container">
					<br/>
					<br/><ul class="copyright">
						<li>&copy; hydro</li>
						<li><a href="#" class="icon fa-facebook"> delete this</a></li>
					</ul>
				</div>
			</section>
	</body>
</html>