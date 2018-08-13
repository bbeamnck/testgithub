<?php
  session_start();
  if($_SESSION['Username'] != "admin" && $_SESSION['Password'] != "1234"){
?>
<script>window.location.replace("CakeIndex.php");</script>
<?php
  }
 ?>
<?php
$hostname = "localhost";
$username = "root";
$password = "1234";
$dbname = "cakestore";
$conn = mysql_connect( $hostname, $username, $password );
if ( ! $conn ) die ( "ไม่สามารถติดต่อกับ MySQL ได้");
mysql_select_db ( $dbname, $conn )or die ( "ไม่สามารถเปิดตารางได้");
mysql_query("SET NAMES UTF8");
$sqltxt = "DELETE FROM product where Product_ID=$id";
$result = mysql_query ( $sqltxt, $conn );
mysql_close($conn);
 ?>
 <script>window.location.replace("DBProduct.php");</script>
