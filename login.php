<?php
session_start();


include 'inc/connection.php' ;

$input_id = $_POST['id'];
$input_pass = $_POST['pass'];
//SQL Injection Protection//
$input_id = clean_input($input_id);
$input_pass = clean_input($input_pass);
////////////////////////////

	$sql = "SELECT * FROM `Account_id` WHERE `username` LIKE '$input_id'" ;
	$query = mysqli_query($connect,$sql);
	$row = mysqli_fetch_array($query);
	$num = mysqli_num_rows($query); 

If ($num == 1) {
	//haveID//
	$account_id = $row['account_id'] ;
	$realpass = $row['password'];
	if($realpass == $input_pass){
		//LoginPass//
		$sql2 = "UPDATE `Account_id` SET `last_login` = NOW() WHERE `Account_id`.`account_id` = $account_id ;" ;
		$query2 = mysqli_query($connect,$sql2);
		//ADD SESSION//
		$_SESSION['account_id'] = $row['account_id'] ;
		$_SESSION['username'] = $row['username'] ; 
		exit ("<script>window.location='topupmain.php'; </script>");
	}else{
		//WrongPassword//
		exit ("<script>window.location='index.php?error=2'; </script>");
	}
	
	
}else{
	//NO ID//
	exit ("<script>window.location='index.php?error=1'; </script>");
}


	



?>