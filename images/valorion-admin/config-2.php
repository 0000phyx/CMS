<?php
//To Prevent Overloaded config.php
     DEFINE('user', 'root');
	 DEFINE('pass', '');
	 DEFINE('host', '127.0.0.1');
	 DEFINE('tabl', 'meh');
	 
	mysql_connect(host, user, pass) or die ('Server Error: Failed to connect to the database.');
	mysql_select_db(tabl) or die ('Server Error: Failed to select database.');
?>	