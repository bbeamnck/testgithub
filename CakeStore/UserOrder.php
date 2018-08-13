<?php
  session_start();
 ?>
<html lang="en" dir="ltr">
  <head>
    <meta charset="utf-8">
    <title> UserOrder </title>
  </head>
  <link href="https://fonts.googleapis.com/css?family=Kanit" rel="stylesheet">
<style>
 th{
  font-size:25px;
 }
 tr:nth-child(even) {
    background-color: #dddddd;
 }

 td {
    border: 1px solid #dddddd;
    text-align: center;
    padding: 8px;
 }
  header{
    width : 100%;
    height : 320px;
    background-color: black;
  }
  .button{
  border-radius: 5px;
    outline: none;
      padding: 8px 14px;
      box-shadow: 0px 4px 16px 0px rgba(0,0,0,0.2);
      background-color:#6ae8db;
    }
  ul {
      list-style-type: none;
      margin: 0;
      padding: 0;
      overflow: hidden;
        background-color: #007c8a;
  }
  .li-left {
      float: left;
  }
  .li-right {
      float: right;
  }

  li a {

    font-size:20px;
      display: block;
      color: white;
      text-align: center;
      padding: 14px 16px;
      text-decoration: none;
  }
  li a:hover {
      background-color: #5e9da3;
  }
  body{
    font-family: 'Kanit', sans-serif;
    background-image: url("123.jpg");
    background-size: 100% 100%;
  }
  .dropdown {
  float: right;
  overflow: hidden;
  }

  .dropdown .dropbtn {
  font-size: 20px;
  border: none;
  outline: none;
  color: white;
  padding: 14px 16px;
  background-color: inherit;
  font-family: inherit;
  margin: 0;
  }
  .navbar a:hover, .dropdown:hover .dropbtn {
  background-color: red;
  }

  .dropdown-content {
  font-size: 20px;
  display: none;
  position: absolute;
  background-color: #f9f9f9;
  min-width: 160px;
  box-shadow: 0px 8px 16px 0px rgba(0,0,0,0.2);
  z-index: 1;
  }

  .dropdown-content a {
  float: none;
  color: black;
  padding: 14px 16px;
  text-decoration: none;
  display: block;
  text-align: left;
  }

  .dropdown-content a:hover {
  background-color: #ddd;
  }

  .dropdown:hover .dropdown-content {
  display: block;
  }
  .button{
  border-radius: 10px;
    outline: none;
    padding: 14px 16px;
      box-shadow: 0px 8px 16px 0px rgba(0,0,0,0.2);
      background-color:#59ff6c;
    }
</style>
  <body>
<header>
<img src="2.jpg" style="width:100%;height:320px;">
</header>
<div><ul>
  <li class="li-left"><a href ="CakeIndex.php">หน้าแรก</a></li>
  <li class="li-left"><a href ="Tel.php"> ติดต่อเรา </a></li>

  <?php
  $User_Name = $_SESSION['User_Name'];
  if($_SESSION['User_ID'] != null)
  {
  ?>
  <li class="li-right"><a href ="MainDatabase.php?logout=true" style="color:blue;">logoff</a></li>

  <div class="dropdown">
    <button class="dropbtn">Hi <?php echo $User_Name; ?> ▼
      <i class="fa fa-caret-down"></i>
    </button>
  <div class="dropdown-content">
       <a href="ShoppingCart.php">รถเข็น</a>
       <a href="UserOrder.php">ใบรายการสั่งซื้อ</a>
       <a href="FixMember.php">แก้ไขข้อมูลส่วนตัว</a>

     </div></div>
  <?php
  }
  else{
    ?>
    <li class="li-right"><a href ="CakeLogin.php">เข้าสู่ระบบ/ลงทะเบียน</a></li>
    <?php
  }
  ?>
  </ul></div>
  <?php
  $User_ID = $_SESSION['User_ID'];
  $ID = $_POST['ID'];
  $PASS = $_POST['Pass'];
  $hostname = "localhost";
  $username = "root";
  $password = "1234";
  $dbname = "cakestore";
  $conn = mysql_connect( $hostname, $username, $password );
  if ( ! $conn ) die ( "ไม่สามารถติดต่อกับ MySQL ได้");
  mysql_select_db ( $dbname, $conn )or die ( "ไม่สามารถเปิดตารางได้");
  mysql_query("SET NAMES UTF8") or die (mysql_error());

  if($Order_ID == null )
  {
   ?>
    <center><div style="width:80%;height:auto;margin-top:50px;"><div style="font-size:40px;"> ใบรายการสั่งซื้อ </div>
    <table align="center" style="width:70%;">
      <tr>
        <td> รหัสรายการ </td><td> วันที่สั่งซื้อ </td><td> วันที่ส่งสินค้า </td><td> ยอดรวม(บาท) </td>
      </tr>
    <?php
      $sqltxt = "SELECT * from  ordered where User_ID = $User_ID ";
      $result = mysql_query ( $sqltxt, $conn );
      while ( $rs = mysql_fetch_array ( $result ))
      {
        $total = 0;
        $sqltxt1 = "SELECT * from detailorder where Order_ID = $rs[0] ";
        $result1 = mysql_query ( $sqltxt1, $conn );

        while ( $rs1 = mysql_fetch_array ( $result1 ))
        {
          $sqltxt2 = "SELECT Product_Price from product where Product_ID = $rs1[2] ";
          $result2 = mysql_query ( $sqltxt2, $conn );
          $rs2 = mysql_fetch_array ( $result2 );
          $amount = $rs1[3]*$rs2[0];
          $total+=$amount;
        }
        echo "<tr style=\"text-align:center;\">
                <td><a href=\"UserOrder.php?Order_ID=$rs[0]\" > $rs[0] </a></td><td> $rs[2] </td><td> $rs[3] </td><td> $total </td>
              </tr>";
      }
      mysql_close($conn);
    ?>
  </table><br><br><br><br>
  <?php
  }
  else {
    ?>
    <center><div style="width:80%;height:auto;margin-top:50px;"><div style="font-size:40px;"> ใบสั่งซื้อเลขที่ <?=$Order_ID ?> </div>
      <div style="width:80%"><table >
        <tr>
          <td align="center"> ลำดับ </td><td>รูปสินค้า</td><td> ชื่อสินค้า </td><td> จำนวน </td><td> ราคาต่อหน่วย </td><td> ยอดรวม </td>
        </tr>
      <?php
        $User_ID = $_SESSION['User_ID'];

        $sqltxt = "SELECT p.Product_Name,d.Amount,p.Product_Price,p.Product_Pic from detailorder d join
        product p on (d.Product_ID = p.Product_ID) where Order_ID = $Order_ID ";
        $result = mysql_query ( $sqltxt, $conn );
        $count=1;
        $alltotal=0;
        while ( $rs = mysql_fetch_array ( $result ))
        {
          $amount = $rs[2]*$rs[1];
          $alltotal +=$amount;
          echo "<tr style=\"text-align:center;\">
                  <td> $count </td><td><img src =\"pictures/$rs[3]\" height=\"100\" width=\"100\" ></td><td> $rs[0] </td><td> $rs[1] </td><td> $rs[2] </td><td> $amount </td>
                </tr>";
                $count++;
        }


      mysql_close($conn);
    ?>
    <tr><td colspan=4><font color=red>ราคารวมทั้งหมด</font></td><td colspan=2><font color=red><? echo $alltotal; ?> บาท</font></td>
  </table>
</div><br><br>

  <?php
  $ID = $_POST['ID'];
  $PASS = $_POST['Pass'];
  $hostname = "localhost";
  $username = "root";
  $password = "1234";
  $dbname = "cakestore";
  $conn = mysql_connect( $hostname, $username, $password );
  if ( ! $conn ) die ( "ไม่สามารถติดต่อกับ MySQL ได้");
  mysql_select_db ( $dbname, $conn )or die ( "ไม่สามารถเปิดตารางได้");
  mysql_query("SET NAMES UTF8") or die (mysql_error());
  $sqltxt = "SELECT m.User_Name,User_Addr,User_Tel,Order_Date,Order_Delivery FROM member m join ordered o
  on (m.User_ID = o.User_ID) where Order_ID='$Order_ID'";
      $result = mysql_query ( $sqltxt, $conn );
      $rs = mysql_fetch_array ( $result );
      mysql_close($conn);
      ?>
      <div style="font-size:40px;">ข้อมูลการจัดส่ง</div>
      <table style="font-size:18px;" border="2">
        <tr><td>ชื่อ</td><td><? echo $rs[0]; ?></td><tr>
        <tr><td>ที่อยู่การจัดส่ง</td><td><? echo $rs[1]; ?></td><tr>
        <tr><td>เบอร์โทรศัพท์</td><td><? echo $rs[2]; ?></td><tr>
        <tr><td>วันทีซื้อ</td><td ><? echo $rs[3]; ?></td></tr>
        <tr><td>วันที่จัดส่ง</td><td><? echo $rs[4]; ?></td></tr>
        <tr><td>รูปแบบการจัดส่ง</td><td>บริการส่งถึงหน้าบ้าน(เก็บเงินปลายทาง)**ตอนนี้มีแค่บริการเดียวเท่านั้น</td><tr>


      </table>
      <?php
  }
  ?>

  </body>
</html>
