<?php
session_start();

if($_SESSION['account_id'] != null) {
	exit ("<script>window.location='topupmain.php'; </script>");
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
			 <li><a href="transaction.php">Transaction</a></li>
            <li><a href="event.php">Event</a></li>
          </ul>
        </div><!--/.nav-collapse -->
      </div>
    </nav>

    <div class="container">

      <div class="starter-template">
	  <?php
	  $errorcode = $_GET['error']; 
	   if( $errorcode == 1){
	  ?>
	 
	  <div class="alert alert-danger" role="alert">
        <strong>ID not found!</strong>ไม่พบไอดีในระบบ โปรดตรวจสอบอีกครั้ง 
      </div>
	  <?php
	   }else if ( $errorcode == 2 ){
	  ?>
	  
	   <div class="alert alert-danger" role="alert">
        <strong>Password not match!</strong>พาสเวิร์ดไม่ถูกต้อง โปรดตรวจสอบอีกครั้ง 
      </div>
	  
	  <?php
	   }
	  ?>
	  
        <h2>Login</h1>
        <p> 
	 <form action="login.php" method="post">
    <div style=" display:inline-block; height: 30px ; "><input type="text" class="form-control" placeholder="Enter your ID" name="id"></div> <br> <br>
	<div style=" display:inline-block; height: 30px ; "><input type="password" class="form-control" placeholder="Password" name="pass"></div><br><br>
	  <p align="center"> <button type="submit" class="btn btn-success">Login</button>  </p> 
      </div>
	<form/>
	  </p>
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
