<?php


	$host = "localhost" ;
	$userroot = "username" ;
	$passroot = "pass" ;
	$dbname = "databasename" ;
	$connect = mysqli_connect($host,$userroot,$passroot);
	mysqli_select_db($connect,$dbname);
	mysqli_query($connect,"set names tis-620") ; 
	
	function clean_input($input) {
		if(get_magic_quotes_gpc()) {
			$input = stripslashes($input);
		}
		$input = strip_tags($input);
		/*$conoo = mysqli_real_escape_string($connect,$input);*/
		$conoo= $input;
		return $conoo;
	}

?>	