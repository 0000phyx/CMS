<!DOCTYPE HTML>
<!--
	Spatial by TEMPLATED
	templated.co @templatedco
	Released for free under the Creative Commons Attribution 3.0 license (templated.co/license)
-->
<html>
	<head>
		<title>GeminiProject - Ranking</title>
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
				<p> Ranking! </p>
<table class="center standard-table">
		<tr>
					<th>#</th>
                              <th>Username</th>
                              <th>Level</th>
                              <th>PVP Kills</th>
                              <th>PVP Deaths</th>
                              <th>Gold</th>
				</tr>

		<?php
		include("config.php");
								$selectusers = mysql_query("SELECT * FROM meh_users");
								$fetchusers = mysql_fetch_array($selectusers);
								$totalscore = $fetchusers['Kills'] - $fetchusers['Deaths'];
								$ranking = mysql_query('SELECT * FROM meh_users WHERE Access<15 ORDER By Level DESC, Kills DESC Limit 10');
								$x = 0;
								$rank = "";
								while($fetchranking = mysql_fetch_array($ranking)) {
									$x++;
									switch($x) {
										case 1:
											$rank = '<img src="img/trophy-gold.png" />';
											break;
										case 2:
											$rank = "<img src='img/trophy-silver.png' />";
											break;
										case 3:
											$rank = '<img src="img/trophy-bronze.png" />';
											break;
										case 4:
											$rank = '<a>4</a>';
											break;
										case 5:
											$rank = '<a>5</a>';
											break;
										case 6:
											$rank = '<a>6</a>';
											break;
										case 7:
											$rank = '<a>7</a>';
											break;
										case 8:
											$rank = '<a>8</a>';
											break;
										case 9:
											$rank = '<a>9</a>';
											break;
										case 10:
											$rank = '<a>10</a>';
											break;
										default:
											$rank = '';
											break;
									}
									$username = $fetchranking['Username'];
									$level = $fetchranking['Level'];
									$pvpkills = $fetchranking['Kills'];
									$pvpdeaths = $fetchranking['Deaths'];
									$gold = $fetchranking['Gold'];
									$coins = $fetchranking['Coins'];
									echo "<tr><td>".$rank."<td>".$username."</td><td>".$level."</td><td>".$pvpkills."</td><td>".$pvpdeaths."</td><td>".$gold."</td></tr>";
								}
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