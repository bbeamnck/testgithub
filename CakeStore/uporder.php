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
    <title></title>
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
  .do button{
  border-radius: 10px;
    outline: none;
    padding: 14px 16px;
    box-shadow: 0px 8px 16px 0px rgba(0,0,0,0.2);
    background-color:#59ff6c;
    }
    .dodb button{
      border-radius: 5px;
        outline: none;
        padding: 8px;
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
    padding-left: 10px;
    font-size: 20px;
  }
  .showtable {
    width:80%;
    height:auto;
    background-color:#6dedcf;
    margin-top:20px;
    border-radius:15px;
  }
  .war {
    font-size: 20px;
    text-align: center;
    background-color: #ff3300;
  }
  .bgdb{
    width:60%;
    height:auto;
    background-color:#36c1a1;
    margin-top:10px;
    border-radius:15px;
  }
</style>
  <body>
    <header>
    <img src="bg.jpg" style="width:100%;height:300px;">
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
      <li class="li-right"><a href ="uporder.php?logout=true" style="color:blue;">logoff</a></li>
      <li style="float: right;font-size:20px;display: block;color: white;text-align:center;padding: 14px 16px;text-decoration: none;">Hi Administator,Welcome to Database Management.</li>

    </ul></div>
    <fieldset style="height:auto;">
      <legend align="center" style="font-size:28px;"> จัดการฐานข้อมูล Order </legend>
    <?php
      $id = $_POST['sent_ID'];
      $user = $_POST['sent_user'];
      $order = $_POST['sent_order'];
      $deli = $_POST['sent_deli'];
      $ch = 1;
      if($ch == 1)
      {
        if($_POST['ID_user'] == "" && isset($_POST['issure']) != null)
          echo "<div class=\"war\"> กรุณาใส่รหัสมาชิก  </div>";
        else if(isset($_POST['issure']) == null) $ch=1;
        else $ch=0;

    ?><br>
    <form method="post" action="DBOrder.php">
      <div class="do" align=center >
        <button type="submit" name="insert" value="insert">Insert</button>
        <button type="submit" name="Show" value="Show">Show</button>
      </div>
    </form>
    <br>
    <form action="uporder.php" method="post">
    <table align="center"  border=0 bgcolor= "#b0d350" class="divprocess">
      <center>
        <tr>
          <td colspan="3"> <h2 align=center > Update ข้อมูล </h2></td>
        </tr>
      <tr> <input type="hidden" name="sent_ID" value="<?=$id?>" >
        <td align="right">  รหัสการสั่งซื้อ </td><td> : </td><td> <input type="text" size="10" name="ID" value="<?= $_POST['sent_ID'] ?>" disabled /></td>
      </tr>
      <tr> <input type="hidden" name="sent_user" value="<?=$user?>" >
        <td align="right">  รหัสสมาชิก </td><td> : </td><td> <input type="text" size="10" name="ID_user" value="<?= $_POST['sent_user'] ?>" /></td>
      </tr>
      <tr>
        <td align="right">  วันที่สั่งซื้อ </td><td> : </td><td> <input type="date" name="date_order" value="<?php echo date("Y-m-d"); ?>" /></td>
      </tr>
      <tr>
        <td align="right">  วันที่จัดส่ง </td><td> : </td><td> <input type="date"  name="date_delivery" value="<?php echo date("Y-m-d"); ?>"/></td>
      </tr>
      <tr >
        <td  colspan=3 align=center> <input type="submit" name="issure" value="ยืนยัน"
          style="background-color:#4bed53;border-radius:10px;width:70px;height:30px;"/> </td>
      </tr>
      </center>
    </table>
    </form>
    <?php

    }
    if($ch==0)
    {
        echo "Ready for Insert in Database";
        $hostname = "localhost";
        $username = "root";
        $password = "1234";
        $dbname = "cakestore";
        $conn = mysql_connect( $hostname, $username, $password );
        if ( ! $conn ) die ( "ไม่สามารถติดต่อกับ MySQL ได้");
        mysql_select_db ( $dbname, $conn )or die ( "ไม่สามารถเปิดตารางได้");
        mysql_query("SET NAMES UTF8");
        $dbid = $_POST['ID'];
        $dbuser = $_POST['ID_user'];
        $dborder = $_POST['date_order'];
        $delivery = $_POST['date_delivery'];
        $sql = "update ordered set User_ID = '$dbuser' , Order_Date = '$dborder' , Order_Delivery = '$delivery' where Order_ID = $id";
        mysql_query($sql,$conn) or die(" $user ".mysql_error());
        mysql_close($conn);
        ?>
        <script>window.location.replace("DBOrder.php");</script>
        <?php
      }
      ?>
    </fieldset>
  </body>
</html>
