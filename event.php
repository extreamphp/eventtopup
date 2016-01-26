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
    <link rel="icon" href="favicon.ico">

    <title>Game Topup & Reward System</title>
    <link href="bootstrap/css/bootstrap.min.css" rel="stylesheet">
    <link href="bootstrap/css/ie10-viewport-bug-workaround.css" rel="stylesheet">
    <link href="customtemp.css" rel="stylesheet">
	
	<script src="https://ajax.googleapis.com/ajax/libs/jquery/1.12.0/jquery.min.js"></script>
  <script src="http://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/js/bootstrap.min.js"></script>
  
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
			 <li ><a href= "transaction.php" >Transaction</a></li>
            <li class="active"><a href="event.php">Event</a></li>
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
	  <h2>Random Box :: เปิดเลยลุ้นแรร์</h2>
	  

		<div class="box" >
		<img src="pic/movingboxs.gif">
		</div>
		
		<div class="box2" >
		<button type="button" class="btn btn-info btn-lg" data-toggle="modal" data-target="#myModal"> เปิดกล่อง </button>
		</div>
		  <br>
		  คุณเหลือสิทธิ์ในการเปิดกล่องอีก   กล่อง <br>
		<div class="panel panel-success">
            <div class="panel-heading">
              <h3 class="panel-title">: สถานะ ID : </h3>
            </div>
            <div class="panel-body">
              :: ID :: <br>
			 <strong> <?php echo $_SESSION['username'] ; ?> </strong>
			  <br>
			  :: Point กิจกรรมคงเหลือ :: <br>
			  <?php 		
				$account_id=$_SESSION['account_id'];
				$sql = "SELECT `point` FROM `event` WHERE `account_id` = $account_id" ;
				$query = mysqli_query($connect,$sql);
				$row = mysqli_fetch_array($query);
				$num = mysqli_num_rows($query);
				
				if($num>0){
					echo $row['point'];
				}else{
					echo "0";
				}

				?>  Point </strong>
            </div>
          </div>
	

  <!-- Modal -->
  <div class="modal fade" id="myModal" role="dialog">
    <div class="modal-dialog">
    
      <!-- Modal content-->
      <div class="modal-content">
   
        <div class="modal-body">
          <p>ต้องการเปิดจริงๆใช่ไหม?</p>
		   <button type="button" class="btn btn-success">เปิดเลย!</button>
		   <button type="button" class="btn btn-default" data-dismiss="modal">ทำใจแป้บนึง</button>
        </div>
 
      </div>
      
    </div>
  </div>
  
</div>
	
	

	</div><!-- /.container -->


    <!-- Bootstrap core JavaScript
    ================================================== -->
    <!-- Placed at the end of the document so the pages load faster -->
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.3/jquery.min.js"></script>
    <script>window.jQuery || document.write('<script src="../../assets/js/vendor/jquery.min.js"><\/script>')</script>
    <script src="bootstrap/dist/js/bootstrap.min.js"></script>
    <!-- IE10 viewport hack for Surface/desktop Windows 8 bug -->
    <script src="bootstrap/assets/js/ie10-viewport-bug-workaround.js"></script>
  </body>
</html>
