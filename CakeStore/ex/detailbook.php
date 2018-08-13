<HTML>
<HEAD><TITLE>Show Data Book</TITLE>
<meta charset="utf-8"></HEAD>
<BODY>
<?
$hostname = "localhost";
$username = "root";
$password = "1234";
$dbname = "bookstore";
$conn = mysql_connect( $hostname, $username, $password );
if ( ! $conn ) die ( "ไม่สามารถติดต่อกับ MySQL ได้" );
mysql_select_db ( $dbname, $conn )or die ( "ไม่สามารถเลือกฐานข้อมูล bookstore ได้" );
mysql_query("SET NAMES UTF8");
$sql = "select * from book where BookID = $id";
$result = mysql_query($sql);
$data = mysql_fetch_array($result);
$Path="pictures/"; //ระบุ path ของไฟล์รูปภาพที่จัดเก็บไว้ใน server
$image = "<img src=$Path$data[Picture] valign=middle align = center
width=\"80\" height = \"100\">";
echo "<table border=1 align =center bgcolor=#FFCCCC>";
echo "<tr><td align=center colspan = 2 bgcolor =#FF99CC><B>แสดงรายละเอียดหนังสือ
</B></td></tr>";
echo "<tr><td> รหัสหนังสือ : </td><td>".$data["BookID"]."</td></tr>";
echo "<tr><td> ชื่อหนังสือ : </td><td>".$data["BookName"]."</td></tr>";
echo "<tr><td> ประเภทหนังสือ : </td><td>".CheckType($conn,$data["TypeID"])."</td></tr>";
echo "<tr><td> สถานะหนังสือ : </td><td>".CheckStatus($conn,$data["StatusID"])."</td></tr>";
echo "<tr><td> สำนักพิมพ์ : </td><td>".$data["Publish"]."</td></tr>";
echo "<tr><td> ราคาซื้อ : </td><td>".$data["UnitPrice"]."</td></tr>";
echo "<tr><td> ราคาเช่า : </td><td>".$data["UnitRent"]."</td></tr>";
echo "<tr><td> รูปภาพ : </td><td>".$image."</td></tr>";
echo "<tr><td>จำนวนวันที่ยืมได้ : </td><td>".$data["DayAmount"]."</td></tr>";
echo "<tr><td> วันที่จัดเก็บหนังสือ :
</td><td>".$data["BookDate"]."</td></tr></table>";
?>
<BR>
<div align = "center"> <A HREF="listofbook.php">กลับหน้าหลัก</A></div><BR>
  <?php
  function CheckType( $conn, $code) {
      $sqltxt = "SELECT TypeName FROM typebook where TypeID ='$code'";
    $result1 = mysql_query ( $sqltxt, $conn );
     $rs1 = mysql_fetch_array ( $result1 );
         return $rs1[0];
  }

  function CheckStatus( $conn, $code) {
    $sqltxt = "SELECT StatusName FROM statusbook where StatusID='$code'";
    $result2 = mysql_query ( $sqltxt, $conn );
    $rs2 = mysql_fetch_array ( $result2 );
    return $rs2[0];
  }
  ?>
</BODY>
</HTML>
