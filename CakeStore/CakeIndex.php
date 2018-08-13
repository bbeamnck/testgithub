<?php
  session_start();
 ?>
<html lang="en" dir="ltr">
  <head>
    <meta charset="utf-8">
    <title>Welcome to CakeStore</title>
  </head>
  <link href="https://fonts.googleapis.com/css?family=Kanit" rel="stylesheet">
<style>
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
</style>
  <body >
<header>
<img src="2.jpg" style="width:100%;height:320px;">
</header>
<div><ul>
  <li class="li-left"><a href ="CakeIndex.php">หน้าแรก</a></li>

  <?php
  if($_SESSION['Username']=="admin")echo '<li class="li-left"><a href ="MainDatabase.php">จัดการ Database</a></li>';
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
     <li class="li-left"><a href ="Tel.php"> ติดต่อเรา </a></li>
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
  if(isset($_POST['buy'])){
    if(($_SESSION['User_ID'])){
      $flag=0;
          $Cart = $_SESSION['Cart'];
          if($_SESSION['Cart']){
          for($i = 0 ; $i < count($Cart) ; $i++){
            if($Cart[$i][0] == $_POST['Noitem']){
            $flag=1;
            $Cart[$i][1]++;
            }
          }
          }
      if($flag==0){
        $Cart[][0] = $_POST['Noitem'];
        $Cart[count($Cart)-1][1] = 1;
      }


    session_register('Cart');
    $ABC = $_SESSION['Cart'];
    if($flag == 0){
    ?>
    <script>alert("เพิ่มสินค้าลงตะกร้าเรียบร้อย !!");</script>
    <?
    }
    else{
      ?>
        <script>alert("ไม่สามารถเพิ่มสินค้าลงตระกร้าได้เนื่องจากมีสินค้าชินนี้อยู่แล้ว \n ระบบจะทำการเพิ่มจำนวนแทน");</script>
      <?
    }
    }
    else{
      ?><script>alert("คุณยังไม่ได้ Login เข้าสู่ระบบ จึงไม่สามารถซื้อสินค้าได้ \n กรุณา Login ก่อนค่ะ");</script><?
    }
  }



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
  <center><div style="width:90%;height:800px;margin-top:40px;padding-left:40px;border-radius:15px;">
    <?php
    while ( $rs = mysql_fetch_array ( $result ) ){
      echo '<form method="post" action="CakeIndex.php" ><input type="hidden" name="Noitem" value="'.$rs[0].'">
            <div style="width:280px;height:auto;align-items:center;float:left;padding:0px 10px;background-color:#b3cef9;margin-top:30px;margin-right:30;border-radius:15px;">
            <br><table style="font-size:18px;" >
            <tr><td colspan="3" ><img src ="pictures/'.$rs[3].'" height="250" width="250" style=""></td></tr>
            <tr><td colspan="3" style="font-size:20px;">'.$rs[1].'</td></tr>
            <tr><td width=70>ราคา</td><td width=70>'.$rs[2].'</td><td>บาท</td></tr>';
            if($rs[4] == "0")echo '<tr><td colspan="3" align=center height=60><font color=red >สินค้าหมด</font></td></tr>';
            else echo '<tr><td colspan="3" align=center height=60><input class="button" type="submit"  name="buy" value="ซื้อสินค้า"></td></tr>';
      echo '</table>';
            //<form method="post" ><img src ="pictures/'.$rs[3].'" height="250" width="250" style="margin-left:30px;">
  //<button type="submit" name="UpdatePro" value="ok" formaction="updateproduct.php?id='.$rs[0].'&name='.$rs[1].'&amount='.$rs[4].'&price='.$rs[2].'">แก้ไข</button></form></form>
  //echo '<a href="deleteproduct.php?id='.$rs[0].'" style="font-size:24px;" onclick="return confirm(\'ยืนยันการลบข้อมูลสินค้า '.$rs[1].'\')">ลบข้อมูล</a>';
  echo '<br></div></form>';
  }
  mysql_close($conn);
?>

</div></center>
  </body>
</html>
