<?php
  session_start();
 ?>
<html lang="en" dir="ltr">
  <head>
    <link rel = "stylesheet" type="text/css" href="stylesheet.css">
    <meta charset="utf-8">
    <title>CakeStore Login</title>
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
    background-color: #fffc7a;
  }
</style>
  <body>

    <header>
    <img src="bg.jpg" style="width:100%;height:300px;">
    </header>
<div><ul>
  <li class="li-left"><a href ="CakeIndex.php">หน้าแรก</a></li>
  <li class="li-right"><a href ="CakeLogin.php">เข้าสู่ระบบ/ลงทะเบียน</a></li>
</ul></div>
<?php  $Check = $_POST['Login'];
  if($Check == null){
 ?>
<center><div style="border-radius:10px;background-color:red;width:25%;height:200px;margin-top:30px;">
  <center><form action="CakeLogin.php" method="post"><table >
    <font  size="6">เข้าสู่ระบบ</font>
      <tr style="font-size:20px;"><td >Username</td><td><input type="text" maxlength="30" name="ID" placeholder="Input Username"></td></tr>
      <tr style="font-size:20px;"><td>Password</td><td><input type="password" maxlength="30" name="Pass" placeholder="Input Password"></td></tr>
      <tr><td colspan="2" align="center"><input type="submit" name="Login" value="Login" style="background-color:#4bed53;border-radius:10px;width:70px;height:30px;"></td></tr>
    </font>
    </table></form></center>
</div></center>
<?php }
  else{
  $ID = $_POST['ID'];
  $PASS = $_POST['Pass'];
    if($ID == "admin" && $Pass == "1234"){
      $Username = $ID;
      $Password = $Pass;
      session_register("Username");
      session_register("Password");
?>
<META http-equiv="refresh" content="0;'MainDatabase.php'">
<?php }
  else{
    $ID = $_POST['ID'];
    $PASS = $_POST['Pass'];
    $hostname = "localhost";
    $username = "root";
    $password = "1234";
    $dbname = "cakestore";
    $conn = mysql_connect( $hostname, $username, $password );
    if ( ! $conn ) die ( "ไม่สามารถติดต่อกับ MySQL ได้");
    mysql_select_db ( $dbname, $conn )or die ( "ไม่สามารถเปิดตารางได้");
    mysql_query("SET NAMES UTF8");
    $sqltxt = "SELECT * from member WHERE User_Username='$ID' AND User_Password='$PASS' ";
    $result = mysql_query ( $sqltxt, $conn );
    $rs = mysql_fetch_array ( $result );
      mysql_close($conn);
    if($rs[2] == $PASS && $rs[6] == $ID){
      $User_ID = $rs[0];
      $User_Name = $rs[1];

      session_register("User_ID");
      session_register("User_Name");
  ?>
  <META http-equiv="refresh" content="0;'CakeIndex.php'">
  <?php
    }
    else {
      ?>
      <META http-equiv="refresh" content="0;'CakeLogin.php'">
      <?php
    }
  }
  }
?>
  </body>
</html>
