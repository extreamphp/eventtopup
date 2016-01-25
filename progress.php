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
	
	}else if($progressmode==2){
		// CARD AMOUNT // 
			// 0= didn't get a card amounth yet / wrong cardnumber
			// 1= 50 bath
			// 2= 150 bath 
			// 3= 300 bath
			// 4= 500 bath  
			// 5= 1000 bath
		///////////////////////////////////////////////////////////
		 // SETTING IN config.php files
			include 'config.php' ;
		///////////////////////////////////////////////////////////
		
		$cardprice = $_POST['cardprice'];
		$account_id_of_card = $_POST['account_id_of_card'];
		$topup_id = $_POST['topup_id'];
		$cardnumber = $_POST['cardnumber'];
		
		// ADD STATUS
		$sql = " UPDATE `Topup` SET `amount` = '$cardprice', `status` = '2' WHERE `Topup`.`topup_id` = $topup_id;" ;
		$query = mysqli_query($connect,$sql);
			
		// ADD LOGS
		$sql2 = "INSERT INTO ``logs` (`logs_id`, `account_id`, `logs_type`, `logs_desc`, `logs_date`) 
		VALUES (NULL, '$account_id_of_card', 'System', 'Approve card $cardnumber ', NOW()); " ;
		$query2 = mysqli_query($connect,$sql2);
		
		// ADD CASH
		switch ($cardprice) {
					case 0:
						break;
					case 1:
						$pointget = (50*$pointmultiply);
						break;
					case 2:
						$pointget = (150*$pointmultiply);
						break;
					case 3:
						$pointget = (300*$pointmultiply);
						break;
					case 4:
						$pointget = (500*$pointmultiply);
						break;
					case 4:
						$pointget = (1000*$pointmultiply);
						break;
		}
		$sql3 = "
		UPDATE `Account_id` SET `cashpoint` = `cashpoint`+$pointget WHERE `Account_id`.`account_id` = $account_id_of_card;
		" ;
		$query3 = mysqli_query($connect,$sql3);
		exit ("<script>window.location='admin.php'; </script>"); 	
		// ADD EVENT POINT
		if($eventstatus == 1){
			
			
			
		}
		
		
	}	


exit ("<script>window.location='index.php'; </script>"); 	


?>