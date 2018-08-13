<?php
  session_start();
  if($_SESSION['User_ID']){
  ?>
  <script>window.location.replace("CakeIndex.php");</script>
  <?php
  }
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
    background-image: url("123.jpg");
      background-size: 100% 100%;
  }
  .bt{
    background-color:#4bed53;
    border-radius:10px;
    width:70px;
    height:30px;
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
    <img src="2.jpg" style="width:100%;height:300px;">
    </header>
<div><ul>
  <li class="li-left"><a href ="CakeIndex.php">หน้าแรก</a></li>
  <li class="li-left"><a href ="Tel.php"> ติดต่อเรา </a></li>
  <li class="li-right"><a href ="CakeLogin.php">เข้าสู่ระบบ/ลงทะเบียน</a></li>
</ul></div>
<fieldset style="height:auto;">
  <legend align="center" style="font-size:28px;"> Login </legend>
<?php

if($_POST['regis']==null && $_POST['issure'] == null)
{
  if($_POST['Login'] != null)
  {
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
    $sqltxt = "SELECT * from member WHERE User_Username='$ID' AND User_Password='$PASS' ";
    $result = mysql_query ( $sqltxt, $conn );
  ?>
  <center><div class="bgdb"><br />
    <?php
        $ch=0;
         $rs = mysql_fetch_array ( $result );
          if($rs[6]==$ID && $rs[2]==$PASS) $ch=1;

        if($ID=="" || $PASS=="")
          echo "<B><center><li>  Enter your Username or Password!!  </li></center></B><br />";
        else if($ch==0)
          echo "<B><center><li>  Username or Password is wrong!! Try again. </li></center></B><br />";
        else{
          if($ID=="admin" && $PASS=="1234"){
              $Username = $ID;
              $Password = $Pass;
              $User_ID = $rs[0];
              $User_Name = $rs[1];
              session_register("Username");
              session_register("Password");
              session_register("User_ID");
              session_register("User_Name");
              echo "<META http-equiv=\"refresh\" content=\"0;'MainDatabase.php'\">";
          }
          else {
            $User_ID = $rs[0];
            $User_Name = $rs[1];
            session_register("User_ID");
            session_register("User_Name");
            session_register("Username");
            session_register("Password");
            ?><script>window.location.replace("CakeIndex.php");</script><?php
          }
        }
        mysql_close($conn);
  }
 ?>
<center><div style="border-radius:10px;background-color:red;width:25%;height:200px;margin-top:30px;">
  <center><form action="CakeLogin.php" method="post"><table >
    <font  size="6">เข้าสู่ระบบ</font>
      <tr style="font-size:20px;"><td >Username</td><td><input type="text" maxlength="30" name="ID" placeholder="Input Username"></td></tr>
      <tr style="font-size:20px;"><td>Password</td><td><input type="password" maxlength="30" name="Pass" placeholder="Input Password"></td></tr>
      <tr><td colspan="2" align="center"  ><input type="submit" name="Login" value="Login" class="bt" >
        &emsp; <input type="submit" name="regis" value="Register" class="bt">
      </td></tr>
    </font>
    </table></form></center>
</div></center>
<br />
<?php
}
else {
  echo "<h1><center>    สมัครสมาชิก    </center></h1>";
    if($_POST['issure'] != null)
    {
      $ch=1;
      if($_POST['name'] == "" )
      {
        echo "<B><center><li> กรุณาใส่ชื่อ  </center></B>";
        $ch=0;
      }
      if($_POST['address'] == "" )
      {
        echo "<B><center><li> กรุณาใส่ที่อยู่  </center></B>";
        $ch=0;
      }
      if($_POST['mail'] == "" )
      {
          echo "<B><center><li> กรุณาใส่ E-mail  </center></B>";
        $ch=0;
      }
      if($_POST['tel'] == "" )
      {
          echo "<B><center><li> กรุณาใส่เบอร์โทร  </center></B>";
        $ch=0;
      }
     if($_POST['user'] == "" )
     {
          echo "<B><center><li> กรุณาใส่ Username  </center></B>";
        $ch=0;
      }
     if($_POST['pass'] == "" )
     {
         echo "<B><center><li> กรุณาใส่ Password  </center></B>";
        $ch=0;
     }
     else if($_POST['pass'] != $_POST['conpass'] )
     {
         echo "<B><center><li> password ไม่ตรงกัน  </center></B>";
        $ch=0;
     }
     if($ch==1)
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
       $name = $_POST['name'];
       $address = $_POST['address'];
       $mail = $_POST['mail'];
       $tel = $_POST['tel'];
       $user = $_POST['user'];
       $pass = $_POST['pass'];
       $sql = "insert into member values('','$name','$pass','$address','$mail','$tel','$user')";
       mysql_query($sql,$conn) or die("INSERT ลงตาราง DetailOrder มีข้อผิดพลาดเกิดขึ้น".mysql_error());
       $RegisSuccess = "OK";
       session_register("RegisSuccess");
       ?>
       <script>window.location.replace("RegisSuccess.php");</script>
       <?php
     }
    }
  ?>
  <form action="CakeLogin.php" method="post">
  <table align="center"  border=0 bgcolor= #b0d350 class="divprocess">
    <center>
    <tr>
      <td>  ชื่อ </td><td> : </td><td> <input type="text" size="20" name="name" placeholder="กรุณาใส่รหัส" value="<? echo $_POST['name']; ?>"/></td>
    </tr>
    <tr>
      <td>  ที่อยู่ </td><td> : </td><td> <input type="text" size="40" name="address" placeholder="กรุณาใส่รหัส" value="<? echo $_POST['address']; ?>"/></td>
    </tr>
    <tr>
      <td>  E-mail </td><td> : </td><td> <input type="email" size="20" name="mail" placeholder="กรุณาใส่รหัส" value="<? echo $_POST['mail']; ?>"/></td>
    </tr>
    <tr>
      <td>  เบอร์โทรติดต่อ </td><td> : </td><td> <input type="tel" size="15" name="tel" placeholder="กรุณาใส่รหัส" value="<? echo $_POST['tel']; ?>"/></td>
    </tr>
    <tr>
      <td>  Username ที่ใช้ Login </td><td> : </td><td> <input type="text" size="14" name="user" placeholder="กรุณาใส่รหัส" value="<? echo $_POST['user']; ?>"/></td>
    </tr>
    <tr>
      <td>  Password ที่ใช้ Login </td><td> : </td><td> <input type="password" size="14" name="pass" placeholder="กรุณาใส่รหัส" /></td>
    </tr>
    <tr><td>  ยืนยัน Password ที่ใช้ Login </td><td> : </td><td> <input type="password" size="14" name="conpass" placeholder="กรุณาใส่รหัส" /></td></tr>
    <tr >
      <td  colspan=3 align=center> <input type="submit" name="issure" value="ยืนยัน"
        style="background-color:#4bed53;border-radius:10px;width:70px;height:30px;"/> </td>
    </tr>
    </center>
  </table>
  </form>
  <?php
}
?>
  </fieldset>
  </body>
</html>
