<meta charset="utf-8">
<?
$hostname = "localhost";
$username = "root";
$password = "1234";
$dbname = "bookstore";
$conn = mysql_connect( $hostname, $username, $password );
if (!$conn) die( "ไม่สามารถติดต่อกับ MySQL ได้" );
mysql_select_db ( $dbname, $conn )or die ( "ไม่สามารถเลือกฐานข้อมูล bookstore ได้" );
mysql_query("SET NAMES UTF8");
$Flag = true;
$ImageFile = htmlspecialchars( trim($ImageFile) );
if ($ImageFile=="") {
echo "<B><CENTER><li>คุณไม่ได้เลือกรูปภาพ.</CENTER></B><BR>";
}
else {
$ImageFile_name; $ImageFile_type; $ImageFile_size;
if ($ImageFile_type=="image/gif" or $ImageFile_type=="image/jpeg") {
  $max_size = 2000000;
if ($ImageFile_size<=$max_size) {
copy($ImageFile,"pictures/$ImageFile_name");
unlink($ImageFile);
$image=$ImageFile_name;
$Flag=true;
}
else {
echo "<CENTER><li>รูปภาพมีขนาดใหญ่กว่า 50 kb.<BR></CENTER>";
echo "<CENTER><input type=\"button\" value=\"กลับไปแก้ไข\" ";
echo "onclick=\"history.back();\" style=\"cursor:hand\"></CENTER>";
$Flag=false;
}
}
else {
echo "<CENTER><li>รูปภาพไม่ใช่ไฟล์ประเภท GIF หรือ JPG <BR></CENTER>";
echo "<CENTER><input type=\"button\" value=\"กลับไปแก้ไข\" ";
echo "onclick=\"history.back();\" style=\"cursor:hand\"></CENTER>";
$Flag=false;
}
}
if($Flag)
{
$BDate = date("Y-m-d");
$sql = "INSERT INTO book VALUES
('$BookID','$BookName','$TypeID','$StatusID', '$Publish',
'$UnitPrice','$UnitRent','$DayAmount','$image','$BDate')";
mysql_query($sql,$conn) or die("INSERT ลงตาราง book มีข้อผิดพลาดเกิดขึ้น".mysql_error());
echo "<br><br><CENTER><H2>บันทึกข้อมูลเรียบร้อย</H2><BR><BR></CENTER>";
echo "<CENTER><A HREF=\"listofbook.php\">แสดงข้อมูลทั้งหมด</A></CENTER>";
}
mysql_close($conn);
?>
