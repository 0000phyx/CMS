<?php
function noSqlInjection($string){
   
        $string = trim($string);
        $string =str_replace("'","",$string);//aqui retira aspas simples <'>
        $string =str_replace("\\","",$string);//aqui retira barra invertida<\\>
        $string =str_replace("UNION","",$string);//aqui retiro  o comando UNION <UNION>
       
        $banlist = array(" insert", " select", " update", " delete", " distinct", " having", " truncate", "replace"," handler", " like", " as ", "or ", "procedure ", " limit", "order by", "group by", " asc", " desc","'","union all", "=", "'", "(", ")", "<", ">", " update", "-shutdown",  "--", "'", "#", "$", "%", "¨", "&", "'or'1'='1'", "--", " insert", " drop", "xp_", "*", " and");
        // ---------------------------------------------
        if(eregi("[a-zA-Z0-9]+", $string)){
                $string = trim(str_replace($banlist,'', strtolower($string)));
        }
       
        return $string;
       
    }//END function noSqlInjection($string)
	
include 'config-2.php';

	$username = $_POST['username'];
	$password = $_POST['password'];
	$username = stripslashes($username);
	$password = stripslashes($password);
	$username = mysql_real_escape_string($username);
	$password = mysql_real_escape_string($password);
	$password = gen_token($password, $username);
	$sql = "SELECT * from meh_admin WHERE Username='$username' && Password='$password'";
	$result = mysql_query($sql);
	
	function gen_token($pass, $salt) {
		$salt = strtolower($salt);
		$str = hash("sha512", $pass.$salt);
		$len = strlen($salt);
		return strtoupper(substr($str, $len, 17));
	}
	
	if(isset($_POST['username']) && isset($_POST['password'])) {
		$count = mysql_num_rows($result);
		if($count==1) {
			session_start();
Print '<script>alert("Succesfuly Logged In...");</script>'; // Prompts the Lister
Print '<script>window.location.assign("index.php");</script>'; // redirects to Lister
			$_SESSION['username'] = $username;
			$_SESSION['password'] = $password;
			$_SESSION['login'] = 1;
		} else {
Print '<script>alert("Wrong Password, Nigguh.");</script>'; // Prompts the Lister
Print '<script>window.location.assign("login.php");</script>'; // redirects to Lister
		}
	} else {
		$error = 'Please login to proceed.';
	}
?>