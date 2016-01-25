<?php
session_start();
include 'inc/connection.php' ;
	
	$progressmode = $_POST['mode'];
	$account_id = $_SESSION['account_id'] ;
	$cardnumber = $_POST['cardnumber'];
	//SQL Injection Protection//
	$cardnumber = clean_input($cardnumber);
	////////////////////////////
	$cardlong = strlen($cardnumber) ;
	
	
	if($progressmode==1){
	//ADD New cards	
		if($cardlong!=12){
			exit ("<script>window.location='topupmain.php?error=3'; </script>"); 	
		}else{
			
			$sqlc = "SELECT * FROM `Topup` WHERE `cardnumber` LIKE '$cardnumber'" ;
			$queryc = mysqli_query($connect,$sqlc);
			$rowc = mysqli_fetch_array($queryc);
			$numc = mysqli_num_rows($queryc); 
			
			if ($numc == 0){
				$sql = "
				INSERT INTO `Topup` (`topup_id`, `account_id`, `cardnumber`, `amount`, `status`, `dateupdate`) 
				VALUES (NULL, $account_id , $cardnumber , '0', '0', NOW());" ;
				$query = mysqli_query($connect,$sql);
			

				$sql2 = "
				INSERT INTO `logs` (`logs_id`, `account_id`, `logs_type`, `logs_desc`, `logs_date`) 
				VALUES (NULL, '$account_id ', 'topup', 'add new card number $cardnumber ', NOW());
				" ;
				$query2 = mysqli_query($connect,$sql2);
				
				
				exit ("<script>window.location='topupmain.php?success=1'; </script>"); 	
			}else{
				exit ("<script>window.location='topupmain.php?error=4'; </script>"); 	
			}
		}
	
	}	





?>