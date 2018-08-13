<?php
  session_start();
  $total = 0;
  $show = true;
  $ListCart = $_SESSION['Cart'];
  $User_ID= $_SESSION['User_ID'];
  if(!$_SESSION['User_ID']){
  ?>
  <script>window.location.replace("CakeIndex.php");</script>
  <?php
  }
  if($logout){
    session_destroy();
    ?>
    <script>window.location.replace("CakeIndex.php");</script>
    <?php
  }
  if(isset($_POST['Confirm'])){
    $Checkdate = date("Y-m-d");
    $date = $_POST['dateInput'];
    $D1 = substr($Checkdate,0,4);
    $M1 = substr($Checkdate,5,2);
    $Y1 = substr($Checkdate,8,2);
    $D2 = substr($date,0,4);
    $M2 = substr($date,5,2);
    $Y2 = substr($date,8,2);
    $D1 = $D2-$D1;
    $M1 = $M2-$M1;
    $Y1 = $Y2-$Y1;
    $QCdate = false;
    if($D1 > 0 || $M1 > 0 || $Y1 > 0)$QCdate = true;
    if(count($ListCart) == 0 || $_POST['dateInput'] == null || $QCdate == false){
      if(count($ListCart) == 0){
        ?><script>alert("คุณยังไม่ได้เลือกสินค้า กรุณากลับไปหน้าแรกเพื่อเลือกสินค้า");</script> <?
      }

      if($_POST['dateInput'] == null){
        ?><script>alert("คุณยังไม่ได้กรอกวันที่จัดส่ง \n กรุณากรอกวันที่จัดส่งให้ถูกต้องด้วยค่ะ");</script> <?
      }
      if($Qcdate == false){
        ?><script>alert("คุณเลือกวันที่จัดส่งน้อยกว่าหรือเท่ากับวันที่สั่ง \n กรุณากรอกวันที่จัดส่งให้ถูกต้องด้วยค่ะ");</script> <?
      }
    }
    else{
      $hostname = "localhost";
      $username = "root";
      $password = "1234";
      $dbname = "cakestore";
      $conn = mysql_connect( $hostname, $username, $password );
      if ( ! $conn ) die ( "ไม่สามารถติดต่อกับ MySQL ได้");
      mysql_select_db ( $dbname, $conn )or die ( "ไม่สามารถเปิดตารางได้");
      mysql_query("SET NAMES UTF8");
      $date = date("Y-m-d");
      $delivery = $_POST['dateInput'];
      $sqltxt = "insert into ordered values('','$User_ID','$date','$delivery')";
      $result = mysql_query ( $sqltxt, $conn );
      $sqltxt = "select * from ordered order by Order_id desc";
      $result = mysql_query ( $sqltxt, $conn );
      $rs = mysql_fetch_array ( $result );
        for($i = 0 ; $i < count($ListCart) ; $i++){
          $t = "amount";
          $A = $t.$i;
          $Amount = $_POST[$A];
          $Productid= $ListCart[$i][0];
          $sqltxt = "select * from product where Product_ID ='$Productid'";
          $result = mysql_query ( $sqltxt, $conn );
          $rs1 = mysql_fetch_array ( $result );
          $UpdateAmount = $rs1[4]-$Amount;
          $sqltxt = "update product set Product_Amount=$UpdateAmount where Product_ID=$Productid";
          $result = mysql_query ( $sqltxt, $conn );
          $sqltxt = "insert into detailorder values('','$rs[0]','$Productid','$Amount')";
          $result = mysql_query ( $sqltxt, $conn );

          $Cart = $_SESSION['Cart'];
          $round = count($Cart);
          array_splice($Cart,0,$round);
          session_register('Cart');
          $show=false;
      }
      mysql_close($conn);
    }
  }
 ?>
<?php
 ?>
<html lang="en" dir="ltr">
  <head>
    <meta charset="utf-8">
    <title>Welcome to CakeStore</title>
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
    text-align: left;
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
  if($_SESSION['User_ID'] != null){
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
<? if($show){ ?>
    <center><div style="width:80%;height:auto;margin-top:50px;"><div style="font-size:40px;">รายการสินค้าในรถเข็น</div>
      <form method="post" name="frmtest" action="ShoppingCart.php"><table  style="background-color:white;width:100%;">
        <th></th><th><center>สินค้า</th><th><center>ราคา</th><th><center>จำนวน</th><th><center>ราคารวม</th><th></th>
<?
  $hostname = "localhost";
  $username = "root";
  $password = "1234";
  $dbname = "cakestore";
  $conn = mysql_connect( $hostname, $username, $password );
  if ( ! $conn ) die ( "ไม่สามารถติดต่อกับ MySQL ได้");
  mysql_select_db ( $dbname, $conn )or die ( "ไม่สามารถเปิดตารางได้");
  mysql_query("SET NAMES UTF8");

      for($i = 0 ; $i < count($ListCart) ; $i++){
        $item = $ListCart[$i][0];
        $sqltxt = "SELECT * FROM product where Product_ID='$item'";
        $result = mysql_query ( $sqltxt, $conn );
        $rs = mysql_fetch_array ( $result );
        echo '<tr><td style="width:100px;"><img src ="pictures/'.$rs[3].'" height="100" width="100" ></td><td style="font-size:20px;">'.$rs[1].'</td>
              <td  style="text-align:center;font-size:20px;width:100px;"><div id="PP'.$i.'">'.$rs[2].'</div></td>';
        echo '<td><center><input type="number" size="2" min=1 max='.$rs[4].' name="amount'.$i.'" value="'.$ListCart[$i][1].'" oninput="multiple'.$i.'()"><br>
              <font style="font-size:14px;">จำนวนสินค้าที่มี:'.$rs[4].'</font></td><td style="text-align:center;font-size:20px;"';

        $Price = $rs[2]*$ListCart[$i][1];
        $total += $Price;
        echo '<div id="Price'.$i.'">'.$Price.'</div>';
        echo '</td style="text-align:center;font-size:20px;width:100px;"><td ><center><a href=DelCart.php?row='.$i.'>ลบ</a></td></tr>';
        echo "<script language='javascript' type='text/javascript'>
           function multiple$i(){

          var div = document.getElementById(\"PP$i\");
          var myData = div.textContent;
          var div1 = document.getElementById(\"Price$i\");
          var myData1 = div1.textContent;
          var two = document.frmtest.amount$i.value;

          var three = 0;
          three = Number(myData)  * Number(two);

            document.getElementById(\"Price$i\").textContent = three;
              total()

          }
         </script>";
      }

      $sqltxt = "SELECT * FROM member where User_ID='$User_ID'";
      $result = mysql_query ( $sqltxt, $conn );
      $rs = mysql_fetch_array ( $result );
      mysql_close($conn);
?>
    </table>
    <div style="font-size:30px;text-align:right;">ราคารวมทั้งหมด<br><span id="Total" >  <? echo $total; ?></span> บาท</div>
    <?
    echo  "<script language='javascript' type='text/javascript'>
       function total(){
         var total=0;";

         for($i=0 ; $i < count($ListCart) ; $i++){
          echo "var div$i = document.getElementById(\"Price$i\");
                var myData$i = div$i.textContent;
                total += Number(myData$i); ";

         }

       echo "document.getElementById(\"Total\").textContent =total;
      }
     </script>";
    ?>
    <br><div style="font-size:40px;">ข้อมูลการจัดส่ง</div>
    <table style="font-size:18px;">
      <tr><td>ชื่อ</td><td><? echo $rs[1]; ?></td><tr>
      <tr><td>ที่อยู่การจัดส่ง</td><td><? echo $rs[3]; ?></td><tr>
      <tr><td>เบอร์โทรศัพท์</td><td><? echo $rs[5]; ?></td><tr>
      <tr><td>วันที่ต้องการให้จัดส่ง</td><td style="font-size:10px;"><input type="date" style="font-size:18px;" size=30  name="dateInput"  /></td></tr>
      <tr><td>รูปแบบการจัดส่ง</td><td>บริการส่งถึงหน้าบ้าน ภายใน 1 วัน(เก็บเงินปลายทาง)<font color=red>**ตอนนี้มีแค่บริการเดียวเท่านั้น</font></td><tr>
    </table><input class="button" type="submit" name="Confirm" value="ยืนยัน"  ></form>
    <!--onclick="return confirm('คุณแน่ใจว่าจะทำการสั่งซื้อสินค้า \n ไม่สามารถย้อนกลับไปและยกเลิกการสั่งสินค้าได้อีก')" -->
  </div></center>
<? }
else{ echo '<center><div style="font-size:30px;">การสั่งซื้อของท่านดำเนินการเสร็จสมบูรณ์<br>ท่านสามารถดูได้ในเมนูใบรายการสั่งซื้อ<br>
            <a href="UserOrder.php">คลิ๊กที่นี่เพื่อไปยังรายการใบสั่งซื้อ</a>หรือ<a href="CakeIndex.php">คลิ๊กที่นี่เพื่อไปยังหน้าแรก</a></div>';
} ?>
  </body>
</html>
