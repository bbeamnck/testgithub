<?php
  session_start();
  if($_SESSION['Username'] != "admin" && $_SESSION['Password'] != "1234"){
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
 ?>
<html lang="en" dir="ltr">
  <head>
    <meta charset="utf-8">
    <title>จัดการข้อมูล Product</title>
  </head>
  <link href="https://fonts.googleapis.com/css?family=Kanit" rel="stylesheet">
<style>
  header{
    width : 100%;
    height : 300px;
    background-color: black;
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
  float: left;
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
  button{
  border-radius: 10px;
    outline: none;
    padding: 14px 16px;
      box-shadow: 0px 8px 16px 0px rgba(0,0,0,0.2);
      background-color:#59ff6c;
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
  .divprocess{
    width:60%;
    height:auto;
    background-color: #b0d350;
    margin-top:20px;
    font-size: 20px;


  }
</style>
<body>

<header>
<img src="2.jpg" style="width:100%;height:300px;">
</header>

<div><ul>
  <li class="li-left"><a href ="CakeIndex.php">หน้าแรก</a></li>
  <li class="li-left"><a href ="Tel.php"> ติดต่อเรา </a></li>
  <div class="dropdown">
    <button class="dropbtn">Database
      <i class="fa fa-caret-down"></i>
    </button>
  <div class="dropdown-content">
       <a href="DBProduct.php">Product</a>
       <a href="DBOrder.php">Order</a>
       <a href="DBDetailOrder.php">DetailOrder</a>
       <a href="DBMember.php">Member</a>
     </div></div>
  <li class="li-right"><a href ="DBProduct.php?logout=true" style="color:blue;">logoff</a></li>
  <li style="float: right;font-size:20px;display: block;color: white;text-align:center;padding: 14px 16px;text-decoration: none;">Hi Administator,Welcome to Database Management.</li>

</ul></div>

<fieldset style="height:auto;">
  <legend align="center" style="font-size:28px;">จัดการฐานข้อมูล Product</legend>
  <form method="post" action="DBProduct.php">
    <div class="do" align=center >
      <button type="submit" name="insert" value="insert">Insert</button>
      <button type="submit" name="Show" value="Show">Show</button>
    </div>
  </form>

    <?php
       if(isset($_POST['insert'])!=null || isset($_POST['Confirm_Insert'])=="ยืนยัน"){
         $flag=true;
         if(isset($_POST['Confirm_Insert'])=="ยืนยัน"){

              $ImageFile = htmlspecialchars( trim($ImageFile) );
              echo "<br>";
              if ($ImageFile==""){
                echo "<B><CENTER><li>คุณไม่ได้เลือกรูปภาพ.</CENTER></B>";
                $flag=false;
              }
              if ($product_name ==""){
                echo "<B><CENTER><li>คุณไม่ได้ใส่ชื่อ.</CENTER></B>";
                $flag=false;
              }
              if ($product_price ==""){
                echo "<B><CENTER><li>คุณไม่ได้ใส่ราคา.</CENTER></B>";
                $flag=false;
              }
              if ($product_amount ==""){
                echo "<B><CENTER><li>คุณไม่ได้ใส่จำนวน.</CENTER></B>";
                $flag=false;
              }
          if($flag==true){
            echo "Ready for Insert in Database";
            $hostname = "localhost";
            $username = "root";
            $password = "1234";
            $dbname = "cakestore";
            $conn = mysql_connect( $hostname, $username, $password );
            if ( ! $conn ) die ( "ไม่สามารถติดต่อกับ MySQL ได้");
            mysql_select_db ( $dbname, $conn )or die ( "ไม่สามารถเปิดตารางได้");
            mysql_query("SET NAMES UTF8");

            copy($ImageFile,"pictures/$ImageFile_name");
            unlink($ImageFile);
            $image=$ImageFile_name;
            $sql = "insert into product values('','$product_name','$product_price','$image','$product_amount')";
            mysql_query($sql,$conn) or die("INSERT ลงตาราง product มีข้อผิดพลาดเกิดขึ้น".mysql_error());
            ?>
            <script>window.location.replace("DBProduct.php");</script>
            <?php
          }

         }
         if(isset($_POST['Confirm_Insert'])!="ยืนยัน" || $flag == false){
    ?>
        <center><form method="post" enctype="multipart/form-data" action="DBProduct.php"><div class="divprocess">
          <table>
            <tr>
              <td colspan="3"><h2 align=center> Insert ข้อมูล </h2></td>
            </tr>
            <tr><td >ชื่อสินค้า </td><td>:</td><td><input type="text" name="product_name" placeholder="กรอกชื่อสินค้า" size=40 value="<?php echo $product_name; ?>"></td></tr>
            <tr><td >ราคาสินค้า </td><td>:</td><td><input type="number" min=1 max=9999 name="product_price" placeholder="กรอกราคาสินค้า" size=10 value="<?php echo $product_price; ?>"></td></tr>
            <tr><td >จำนวนสินค้า </td><td>:</td><td><input type="number" min=0 max=999 name="product_amount" placeholder="กรอกจำนวนสินค้า" size=10 value="<?php echo $product_amount; ?>"></td></tr>
            <tr><td >รูปสินค้า <br><br>&nbsp;</td><td></td><td><input type="file" name="ImageFile" size="30"><br>
            <font size=3 color = #FF3300>ชื่อเป็นตัวเลขหรือภาษาอังกฤษ และ นามสกุล .gif หรือ .jpg และ .png (เท่านั้น) <br>**แนะนำรูปที่เป็นจัตุรัส ขนาด 400x400</td></tr>
            <tr><td colspan=3 align=center><input type="submit" name ="Confirm_Insert" value="ยืนยัน"
               style="background-color:#4bed53;border-radius:10px;width:70px;height:30px;"></td></tr>
          </table>
</div></form></center>
    <?php
    }
      }

      else if(isset($_POST['Show'])=="Show"){
    ?>
        <script>window.location.replace("DBProduct.php");</script>
    <?php
      }
      else if($_POST['id']=="Yes"){
        echo "KUYYYYYYYYYYYYYYY";
        $hostname = "localhost";
        $username = "root";
        $password = "1234";
        $dbname = "cakestore";
        $conn = mysql_connect( $hostname, $username, $password );
        if ( ! $conn ) die ( "ไม่สามารถติดต่อกับ MySQL ได้");
        mysql_select_db ( $dbname, $conn )or die ( "ไม่สามารถเปิดตารางได้");
        mysql_query("SET NAMES UTF8");
        $sqltxt = "DELETE FROM product WHERE Product_ID=$id";
        $result = mysql_query ( $sqltxt, $conn );
        mysql_close($conn);
        ?>

        <?php

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
        $sqltxt = "SELECT * FROM product order by Product_ID";
        $result = mysql_query ( $sqltxt, $conn );
    ?>
    <center><div style="width:80%;height:auto;background-color:#36c1a1;margin-top:20px;border-radius:15px;">
    <?php
      while ( $rs = mysql_fetch_array ( $result ) ){
        echo '<div style="width:80%;height:auto;background-color:#6dedcf;margin-top:20px;border-radius:15px;">';
        echo '<table style="margin-left:10%;width:80%;"  ><tr><td style="width:10%;">รหัสสินค้า </td><td style="width:3%;" align="center">:</td>
              <td style="width:30%;">'.$rs[0].'</td>
              <td rowspan="4" style="width:50%;"><img src ="pictures/'.$rs[3].'" height="250" width="250" style="margin-left:30px;"></td>
              </tr>';
        echo '<tr><td >ชื่อสินค้า </td><td style="width:3%;" align="center">:</td><td>'.$rs[1].'</td></tr>';
        echo '<tr><td>ราคา </td><td style="width:3%;" align="center">:</td><td>'.$rs[2].'</td></tr>';
        echo '<tr><td>จำนวน </td><td style="width:3%;" align="center">:</td><td>'.$rs[4].'</td></tr>';
        echo '<tr><td colspan=4><form method="post" ><button style="background-color:red;" type="submit" formaction="deleteproduct.php?id='.$rs[0].'" name="DelPro" value="ok" onclick="return confirm(\'ยืนยันการลบข้อมูลสินค้า '.$rs[1].'\')">ลบข้อมูล</button>

          <button type="submit" name="UpdatePro" value="ok" formaction="updateproduct.php?id='.$rs[0].'&name='.$rs[1].'&amount='.$rs[4].'&price='.$rs[2].'">แก้ไข</button></form></form></td></tr></table>';
        //echo '<a href="deleteproduct.php?id='.$rs[0].'" style="font-size:24px;" onclick="return confirm(\'ยืนยันการลบข้อมูลสินค้า '.$rs[1].'\')">ลบข้อมูล</a>';
        echo '<br></div>';
      }
      mysql_close($conn);
    ?>

    </div></center>
    <?php
      }
    ?>
</fieldset>
  </body>
</html>
