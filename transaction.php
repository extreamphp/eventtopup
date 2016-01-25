<?php
session_start();

if($_SESSION['account_id'] == null) {
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
            <li><a href="index.php">Topup</a></li>
			 <li class="active"><a href= "transaction.php" >Transaction</a></li>
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
		
	<br>
	แสดง 20 รายการความเคลื่อนไหวล่าสุด
	<br> <div class="col-md-12">
	 
	 <?php
		$account_id=$_SESSION['account_id'];
		$sql2 = "SELECT * FROM `logs` WHERE `account_id` = $account_id ORDER BY `logs`.`logs_date` DESC" ;
		$query2 = mysqli_query($connect,$sql2);
		$row2 = mysqli_fetch_array($query2);
		$num2 = mysqli_num_rows($query2); 
	 ?>
	 
	 
          <table class="table table-striped">
            <thead>
              <tr>
                <th>ลำดับ</th>
                <th>การดำเนินการ</th>
                <th>รายละเอียด</th>
                <th>วันที่</th>
              </tr>
            </thead>
			 <tbody>
			<?php
			$count = 1 ; 
			while($num2>0){
			?>
           
              <tr>
                <td><?php echo $count; ?></td>
                <td><?php echo $row2['logs_type'] ;?></td>
				<td><?php echo $row2['logs_desc'] ;?></td>
				<td><?php echo $row2['logs_date'] ;?></td>
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
