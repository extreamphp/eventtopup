<?php
session_start();
include 'inc/connection.php' ;
	
	$account_id=$_SESSION['account_id'];
	$sql = "SELECT `point` FROM `event` WHERE `account_id` = $account_id" ;
	$query = mysqli_query($connect,$sql);
	$row = mysqli_fetch_array($query);
	$num = mysqli_num_rows($query);	
	$playerpoint = $row['point'];
	
	if ($playerpoint>=50){
		
		/////////////////////
		// Using Point    //
		///////////////////
		$sql5 = "UPDATE `event` SET `point` = `point`- 50
		WHERE `event`.`account_id` = $account_id;" ;
		$query5 = mysqli_query($connect,$sql5);
		
		//$sqllogs = "
		//		INSERT INTO `logs` (`logs_id`, `account_id`, `logs_type`, `logs_desc`, `logs_date`) 
		//		VALUES (NULL, '$account_id ', 'Event', 'Opened event box', NOW());
		//		" ;
		//$querylogs = mysqli_query($connect,$sqllogs);
				
	//////////////////////
	// START RANDOM    //
	////////////////////
	// Random Chance///
	// 1  = 0.01%  ///
	//////////////////
	$random = rand(1,10000);
	$check = 0; 
	
	$sql7 = "SELECT `item_id`,`item_name`,`item_chance` FROM `item_chance`" ;
	$query7 = mysqli_query($connect,$sql7);
	$row7 = mysqli_fetch_array($query7);
	$num7 = mysqli_num_rows($query7);	
	
	//echo "random :".$random ; 
	//echo "<br>";
		while($num7>0){
			$check = $check+$row7['item_chance'];
			//echo $check; echo "<br>";
				if($random<$check){
					$itemidgot = $row7['item_id'];
					$itemname = $row7['item_name'];
					//echo "ItemGot :".$itemidgot; echo "<br>";
					///////////////////////
					// GOT SOME ITEM     //
					///////////////////////
					// ADD ITEM TO GAME (depend on Game's database so...I just made a dummy one)
					$sqlcheck = "SELECT * FROM `dummy_item_inventory` WHERE `account_id` = $account_id AND `item_id` = $itemidgot " ; 
					$querycheck = mysqli_query($connect,$sqlcheck);
					$rowcheck = mysqli_fetch_array($querycheck);
					$numcheck = mysqli_num_rows($querycheck);	
					
						if($numcheck>0){
							$sqlup = "UPDATE `dummy_item_inventory` SET `item_amount` = `item_amount`+1 WHERE `account_id` = $account_id AND `item_id` = $itemidgot;";
							$queryup = mysqli_query($connect,$sqlup);
						}else{
						$sqladd = "
							INSERT INTO `dummy_item_inventory` (`inv_id`, `account_id`, `item_id`, `item_amount`) 
							VALUES (NULL, '$account_id', '$itemidgot', '1');
							" ;
						$queryadd = mysqli_query($connect,$sqladd);
						}
					// Add logs 
						$sqllogs2 = "
						INSERT INTO `logs` (`logs_id`, `account_id`, `logs_type`, `logs_desc`, `logs_date`) 
						VALUES (NULL, '$account_id ', 'Event', 'Congratulation! you got $itemname ', NOW());
						" ;
						$querylogs2 = mysqli_query($connect,$sqllogs2);
					// Send Result
					exit ("<script>window.location='event.php?itemid=$itemidgot'; </script>");

				}
			$row7 = mysqli_fetch_array($query7);
			$num7--;
		}
		///////////////////////
		// EMPTY BOX         //
		///////////////////////
		// Add logs 
		$sqllogs3 = "
				INSERT INTO `logs` (`logs_id`, `account_id`, `logs_type`, `logs_desc`, `logs_date`) 
				VALUES (NULL, '$account_id ', 'Event', 'Sorry ...the box it EMPTY ', NOW());
				" ;
		$querylogs3 = mysqli_query($connect,$sqllogs3);
		// Send Result
		exit ("<script>window.location='event.php?itemid=0'; </script>");
	
	}else{
		exit ("<script>window.location='event.php?error=1'; </script>"); 	
	}
	

			
		


?>