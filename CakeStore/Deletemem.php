<META http-equiv="refresh" content="0;'DBMember.php'">
<?
$hostname = "localhost";
$username = "root";
$password = "1234";
$dbname = "cakestore";
$conn = mysql_connect( $hostname, $username, $password );
if ( ! $conn ) die ( "ไมสามารถติดต่อกับ MySQL ได้" );
mysql_select_db ( $dbname, $conn )or die ( "ไม่สามารถเลือกฐานข้อมูล cakestoreได้" );
mysql_query("SET NAMES UTF8");
$sql = "DELETE FROM member WHERE User_ID = '$id' ";
mysql_query($sql) or die ( "DELETE จาตาราง member มีข้อผิดพลาดเกิดขึ้น".mysql_error());
mysql_close ( $conn );
//header("Location:listofbook.php");
?>
