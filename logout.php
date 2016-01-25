<?php
session_start();


include 'inc/connection.php' ;
session_destroy();

exit ("<script>window.location='index.php'; </script>"); 




?>