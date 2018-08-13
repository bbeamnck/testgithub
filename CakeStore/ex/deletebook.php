<META http-equiv="refresh" content="0;'listofbook.php'">
<?
$hostname = "localhost";
$username = "root";
$password = "1234";
$dbname = "bookstore";
$conn = mysql_connect( $hostname, $username, $password );
if ( ! $conn ) die ( "ไมสามารถติดต่อกับ MySQL ได้" );
mysql_select_db ( $dbname, $conn )or die ( "ไม่สามารถเลือกฐานข้อมูล bookstore ได้" );
mysql_query("SET NAMES UTF8");
$sql = "DELETE FROM book WHERE BookID = '$id' ";
mysql_query($sql) or die ( "DELETE จาตาราง book มีข้อผิดพลาดเกิดขึ้น".mysql_error());
mysql_close ( $conn );
//header("Location:listofbook.php");
?>
