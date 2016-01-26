<?php
session_start();

if($_SESSION['account_id'] == null) {
	exit ("<script>window.location='index.php'; </script>");
}
include 'inc/connection.php' ;
$itemid=$_GET['itemid'];

if($itemid != ""){
	
	$sql7 = "SELECT `item_id`,`item_name`,`item_pic`,`item_desc` FROM `item_chance` WHERE `item_id`=$itemid" ;
	$query7 = mysqli_query($connect,$sql7);
	$row7 = mysqli_fetch_array($query7);
	$num7 = mysqli_num_rows($query7);
	$openmodal = 1;
	
}else{
	$openmodal = 0;
}

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
  
  
	<?php if($openmodal==1){?>
		<script type="text/javascript">
			$(window).load(function(){
				$('#itemmodal').modal('show');
			});
		</script>
	<?php } ?>
  
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
	  <?php
			$account_id=$_SESSION['account_id'];
			$sql = "SELECT `point` FROM `event` WHERE `account_id` = $account_id" ;
			$query = mysqli_query($connect,$sql);
			$row = mysqli_fetch_array($query);
			$num = mysqli_num_rows($query);	
			$playerpoint = $row['point'];
			$box = floor($playerpoint/50);
	  ?>
	
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
		<?php if($box >0) { ?>
			<button type="button" class="btn btn-info btn-lg" data-toggle="modal" data-target="#myModal"> เปิดกล่อง </button>
		<?php }else{ ?>
			<h2><span class="label label-default">&nbsp;&nbsp;&nbsp; - &nbsp;&nbsp;&nbsp;</span></h2>
		<?php } ?>
		
		</div>
		  <br>
		  คุณเหลือสิทธิ์ในการเปิดกล่องอีก   <?php echo $box;?> กล่อง<br>
		<div class="panel panel-success">
            <div class="panel-heading">
              <h3 class="panel-title">: สถานะ ID : </h3>
            </div>
            <div class="panel-body">
              :: ID :: <br>
			 <strong> <?php echo $_SESSION['username'] ; ?> </strong>
			  <br><br>
			  :: Point กิจกรรมคงเหลือ :: <br>
			  <?php 		
				
				if($num>0){
					echo $playerpoint;
				}else{
					echo "0";
				}

				?>  Point </strong>
            </div>
          </div>
		  
		<div class="panel panel-success">
            <div class="panel-heading">
              <h3 class="panel-title">: ประวัติการเปิดกล่อง(20 กล่องล่าสุด) : </h3>
            </div>
            <div class="panel-body">
           <div class="col-md-12">
	 
	 <?php
		$account_id=$_SESSION['account_id'];
		$sql2 = "SELECT * FROM `logs` WHERE `logs_type` LIKE 'Event' AND`account_id` = $account_id ORDER BY `logs`.`logs_date` DESC  LIMIT 0,20" ;
		$query2 = mysqli_query($connect,$sql2);
		$row2 = mysqli_fetch_array($query2);
		$num2 = mysqli_num_rows($query2); 
	 ?>
	 
	 
          <table class="table table-striped">
            <thead>
              <tr>
                <th>ลำดับ</th>
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
        </div>
	

  <!-- Modal -->
  <div class="modal fade" id="myModal" role="dialog">
    <div class="modal-dialog">
    
      <!-- Modal content-->
      <div class="modal-content">
   
        <div class="modal-body">
          <p>ต้องการเปิดจริงๆใช่ไหม?</p>
			<form action="random.php" method="post">
			<button type="submit" class="btn btn-success">เปิดเลย!</button>
			<button type="button" class="btn btn-default" data-dismiss="modal">ทำใจแป้บนึง</button>
			</form>


		 
        </div>
 
      </div>
      
    </div>
  </div>
  
  <?php if($openmodal==1){?>
  <!-- Item Modal -->
  <div class="modal fade" id="itemmodal" role="dialog">
    <div class="modal-dialog">
    
      <!-- Modal content-->
      <div class="modal-content">
   
	<?php  if($itemid==0){ ?>
		
		  <div class="modal-body">
		
			<div class="modal-header">
				<a class="close" data-dismiss="modal">×</a>
				<h2>เสียใจด้วย คุณไม่ได้ไอเทมอะไรเลย</h2>
			</div><br>
			<img src="pic/emptybox.jpg">
			<p>ลองใหม่กล่องหน้านะ</p>
			
		  <button type="button" class="btn btn-default" data-dismiss="modal">ตกลง</button>
        </div>
		
	<?php }else{?>
   

        <div class="modal-body">
		
			<div class="modal-header">
				<a class="close" data-dismiss="modal">×</a>
				<h2>คุณได้รับไอเทม <?php echo $row7['item_name'];?></h2>
			</div><br>
			<img src="pic/<?php echo $row7['item_pic'];?>">
			<p><?php echo $row7['item_desc'];?></p>
			
		  <button type="button" class="btn btn-default" data-dismiss="modal">ตกลง</button>
        </div>
 
	<?php } ?>

 
      </div>
      
    </div>
  </div>
  <?php } ?>
  
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
