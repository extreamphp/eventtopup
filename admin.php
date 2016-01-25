<?php
session_start();

if($_SESSION['account_id'] != 1 ) {
	exit ("<script>window.location='index.php'; </script>");
}
include 'inc/connection.php' ;


?>
<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description" content="">
    <meta name="author" content="">
    <link rel="icon" href="../../favicon.ico">

    <title>Game Topup & Reward System</title>
    <link href="bootstrap/css/bootstrap.min.css" rel="stylesheet">
    <link href="bootstrap/css/ie10-viewport-bug-workaround.css" rel="stylesheet">
    <link href="customtemp.css" rel="stylesheet">
	
	
  </head>

  <body>

    <nav class="navbar navbar-inverse navbar-fixed-top">
      <div class="container">
        <div class="navbar-header">
          <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#navbar" aria-expanded="false" aria-controls="navbar">
            <span class="sr-only">Navigation</span>
            <span class="icon-bar"></span>
            <span class="icon-bar"></span>
            <span class="icon-bar"></span>
          </button>
          <a class="navbar-brand" href="#">Acc Management System</a>
        </div>
        <div id="navbar" class="collapse navbar-collapse">
          <ul class="nav navbar-nav">
            <li class="active"><a href="index.php">Topup</a></li>
			 <li><a href= "transaction.php" >Transaction</a></li>
            <li><a href="event.php">Event</a></li>
          </ul>
        </div>
      </div>
    </nav>

    <div class="container">
	
      <div class="starter-template">
	  
	
	  <br>
	  ตอนนี้คุณเข้าสู่ระบบด้วย ID : <?php
	  echo $_SESSION['username'] ; 
	  ?>(<a href="logout.php">ออกจากระบบ</a>)

	 <div class="col-md-12">
	 
	 <?php
		$sql2 = "SELECT * FROM `Topup` WHERE `status` = 0 ORDER BY `dateupdate` DESC" ;
		$query2 = mysqli_query($connect,$sql2);
		$row2 = mysqli_fetch_array($query2);
		$num2 = mysqli_num_rows($query2); 
	 ?>
	 <br>
		เนื่องจากไม่ได้ทำให้มันเชื่อมต่อกับระบบตรวจมูลค่าบัตรจริงๆ	 <br> จึงใช้เป็นระบบ Mannual อยากให้ใบไหนมูลค่าเท่าไหร่จิ้มผ่าน ID Admin ได้เลย
          <table class="table table-striped">
            <thead>
              <tr>
                <th>ลำดับ</th>
                <th>รหัสบัตร(12 หลัก)</th>
				<th>AccountID</th>
                <th>มูลค่าบัตร</th>
                <th>อัพเดทสถานะ</th>
              </tr>
            </thead>
			 <tbody>
			<?php
			$count = 1 ;
			while($num2>0){
				
				// Status //
				// 0=Wait for approve
				// 1= Approve & wait for Add Cash Point 
				// 2= Approve & Already get a Cash point
				// 3= Card number was already use 
				// 4= Card number was wrong
				//
				// CARD AMOUNT // 
				// 0= didn't get a card amounth yet / wrong cardnumber
				// 1= 50 bath
				// 2= 150 bath 
				// 3= 300 bath
				// 4= 500 bath  
				// 5= 1000 bath
				
			?>
           
              <tr>
                <td><?php echo $count; ?></td>
                <td><?php echo $row2['cardnumber'] ;?></td>
				<td><?php echo $row2['account_id'] ;?></td>
				<form method="post" action="progress.php">
                <td>
				<select class="form-control" name="cardprice">
				  <option value="1">50 บาท</option>
				  <option value="2">150 บาท</option>
				  <option value="3">300 บาท</option>
				  <option value="4">500 บาท</option>
				  <option value="5">1,000 บาท</option>
				</select>
				</td>
				<input type=hidden name="mode" value="2">
				<input type=hidden name="account_id_of_card" value="<?php echo $row2['account_id'] ;?>" >
				<input type=hidden name="topup_id" value="<?php echo $row2['topup_id'] ;?>">
				<input type=hidden name="cardnumber" value="<?php echo $row2['cardnumber'] ;?>">
				<td><button type="submit" class="btn btn-xs btn-primary">Approve</button></td>  
			
				</form>
				
				
              </tr>
         
			<?php 
				$count++;
				$num2--;
				$row2 = mysqli_fetch_array($query2);
			} 
			?>
			   </tbody>
          </table>
        </div>
      </div>

	
	
	
	
	
	</div><!-- /.container -->


    <!-- Bootstrap core JavaScript
    ================================================== -->
    <!-- Placed at the end of the document so the pages load faster -->
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.3/jquery.min.js"></script>
    <script>window.jQuery || document.write('<script src="../../assets/js/vendor/jquery.min.js"><\/script>')</script>
    <script src="../../dist/js/bootstrap.min.js"></script>
    <!-- IE10 viewport hack for Surface/desktop Windows 8 bug -->
    <script src="../../assets/js/ie10-viewport-bug-workaround.js"></script>
  </body>
</html>
