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
		<?php
			if($_SESSION['account_id'] == 1 ) {?>
				<div class="alert alert-success" role="alert">
				<strong>Admin Login </strong> คุณสามารถจัดการ Approve บัตรเติมเงินได้ "<a href="admin.php">ที่นี่</a>"
				</div>
		<?php	}
		?>
	  
		<form action="progress.php" method="post">
	    <div class="topupsession" style=" background-color: #F2F2F2 ;" > <br>
        <h2>กรอกรหัสบัตรเติมเงิน(12หลัก)ที่นี่</h2>
        <p> <br>
		( ตัวอย่าง : 123456789123)
		<div style=" display:inline-block; height: 30px ; ">
		
		<input pattern="[0-9]{12}" required title=โปรดกรอกรหัสบัตร12หลัก(ตัวเลขเท่านั้น)" class="form-control" placeholder="กรอกรหัสบัตรเติมเงินที่นี่" required name="cardnumber"></div> 
		<input type="hidden" name="mode" value="1">
		<p align="center"><br>  <button type="submit" class="btn btn-success">Topup</button>  </p> 
      <br>
	  </form>
	  	</div> <!--Div topup session close -->
	  <br>
	  <div style="background-color:#515151 ;height:30px; border-radius:20px;">
		<?php
		// SHOW CASH Point
		$account_id = $_SESSION['account_id'] ; 
		$sql = "SELECT * FROM `Account_id` WHERE `account_id` LIKE '$account_id'" ;
		$query = mysqli_query($connect,$sql);
		$row = mysqli_fetch_array($query);
		?>
		
			<p style='color: #FFFFFF; font-style: oblique; text-align:center;'> Cash Point ที่มี : <?php echo $row['cashpoint'] ;?> Point</p>
			
		</div>   
	  
	  </div>
	
		
	
	  </p>
    

	
	 <div class="col-md-12">
	 
	 <?php
		$sql2 = "SELECT * FROM `Topup` WHERE `account_id` = $account_id ORDER BY `Topup`.`dateupdate` DESC" ;
		$query2 = mysqli_query($connect,$sql2);
		$row2 = mysqli_fetch_array($query2);
		$num2 = mysqli_num_rows($query2); 
	 ?>
	 
	 
          <table class="table table-striped">
            <thead>
              <tr>
                <th>ลำดับ</th>
                <th>รหัสบัตร(12 หลัก)</th>
                <th>มูลค่าบัตร</th>
                <th>สถานะ</th>
				<th>การอัพเดทข้อมูลล่าสุด</th>
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
                <td><?php 
				$amount = $row2['amount'];
				switch ($amount) {
					case 0:
						echo "-";
						break;
					case 1:
						echo "50 บาท";
						break;
					case 2:
						echo "150 บาท";
						break;
					case 3:
						echo "300 บาท";
						break;
					case 4:
						echo "500 บาท";
						break;
					case 5:
						echo "1000 บาท";
						break;
				}
				?></td>
                <td><?php 
				$stat = $row2['status'];
				switch ($stat) {
					case 0:
						echo "รอการยืนยันบัตร";
						break;
					case 1:
						echo "รหัสบัตรถูกต้อง(แต่ยังไม่ได้เพิ่ม Cash Point)";
						break;
					case 2:
						echo "<font color='green'>เพิ่ม Cash Point เรียบร้อยแล้ว</font>";
						break;
					case 3:
						echo "รหัสบัตรนี้ได้ถูกใช้งานไปแล้ว";
						break;
					case 4:
						echo "รหัสบัตรผิดพลาด";
						break;
				}
				
				
				?></td>  
				<td><?php echo $row2['dateupdate'] ;?></td>
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
