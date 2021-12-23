<?php
{
	error_reporting(0);
        session_start();
        If($_SESSION['login'] != 1 ){ header("location:login.php"); }	
	
	include "config.php";
	
	$con = mysql_connect(DB_HOST, DB_USER, DB_PASS);
	$db = mysql_select_db(DB_DATA);
		
	$servers = mysql_query("SELECT SUM(Count) FROM meh_servers WHERE Online>0");
	$fetch_servers = mysql_fetch_array($servers);
	
	$max = mysql_query("SELECT SUM(Max) FROM meh_servers WHERE Online>0");
	$fetch_max = mysql_fetch_array($max);
	
	$users = mysql_query("SELECT id FROM meh_users");
	$fetch_users = mysql_num_rows($users);

	$search_items = mysql_query("SELECT id FROM meh_items");
	$count_items = mysql_num_rows($search_items);

	$search_user_items = mysql_query("SELECT id FROM meh_users_items");
	$count_user_items = mysql_num_rows($search_user_items);

	$busca_staff = mysql_query("SELECT id FROM meh_users WHERE Access>=40");
	$conta_staff = mysql_num_rows($busca_staff);
	
	$busca_staff_on = mysql_query("SELECT id FROM meh_users WHERE Access>=40 AND CurrentServer!='Offline'");
	$conta_staff_on = mysql_num_rows($busca_staff_on);
	
	$busca_ban = mysql_query("SELECT id FROM meh_users WHERE Access<1");
	$conta_ban = mysql_num_rows($busca_ban);
	
	}
	
	if(isset($_GET['logout'])){
		unset($_SESSION['userlog']);
		unset($_SESSION['passlog']);
		echo "<script>history.go(-1)</script>";
	}
?>