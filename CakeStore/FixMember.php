<?php
  session_start();
  if($_SESSION['Username'] == "" && $_SESSION['Password'] == "")
  {
?>
<script>window.location.replace("CakeLogin.php");</script>
<?php
}
?>
<?php $user_username = $_SESSION['Username'];  ?>
<!DOCTYPE html>
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

  </style>
  <body>
    <header>
    <img src="2.jpg" style="width:100%;height:300px;">
    </header>
<div><ul>
  <li class="li-left"><a href ="CakeIndex.php">หน้าแรก</a></li>
  <li class="li-left"><a href ="Tel.php"> ติดต่อเรา </a></li>
</ul></div>
<fieldset style="height:auto;">
  <legend align="center" style="font-size:28px;"> modify Your Account </legend>

<?php
$hostname = "localhost";
$username = "root";
$password = "1234";
$dbname = "cakestore";
$conn = mysql_connect( $hostname, $username, $password );
if ( ! $conn ) die ( "ไม่สามารถติดต่อกับ MySQL ได้");
mysql_select_db ( $dbname, $conn )or die ( "ไม่สามารถเปิดตารางได้");
mysql_query("SET NAMES UTF8") or die (mysql_error());
$sqltxt = "SELECT * FROM member where User_Username = '$user_username'";
$result = mysql_query ( $sqltxt, $conn );
$rs = mysql_fetch_array ( $result );

$id = $rs[0];
$name = $rs[1];
$pass = $rs[2];
$address = $rs[3];
$mail = $rs[4];
$tel = $rs[5];
$user = $rs[6];
$check = 1;
if($_POST['Login'] != null || $_POST['issure'])
{
  if($_POST['ID1'] == "" || $_POST['pass1'] == "")
    echo "<B><center><li>  Enter your Username or Password!!  </li></center></B><br />";
  else if($_POST['ID1'] != $user || $_POST['pass1'] != $pass)
    echo "<B><center><li>  Username or Password is wrong!! Try again. </li></center></B><br />";
  else {
    $check = 0;
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
     if($_POST['pass'] == "" || $_POST['pass2'] == "")
     {
       if($_POST['pass'] == "")
         echo "<B><center><li> กรุณาใส่ Password  </center></B>";
       else if($_POST['pass2'] == "")
         echo "<B><center><li> กรุณายืนยัน Password  </center></B>";
        $ch=0;
     }
     else if($_POST['pass'] != $_POST['pass2'] )
     {
       echo "<B><center><li> ยืนยัน PassWord ของคุณไม่ตรงกัน </center></B>";
       $ch = 0;
     }
     echo "<br />";
     if($ch==1)
     {
       echo "Ready for Update in Database ";
       $hostname = "localhost";
       $username = "root";
       $password = "1234";
       $dbname = "cakestore";
       $conn = mysql_connect( $hostname, $username, $password );
       if ( ! $conn ) die ( "ไม่สามารถติดต่อกับ MySQL ได้");
       mysql_select_db ( $dbname, $conn )or die ( "ไม่สามารถเปิดตารางได้");
       mysql_query("SET NAMES UTF8");
       $User_Name = $_POST['name'];
       $address = $_POST['address'];
       $mail = $_POST['mail'];
       $tel = $_POST['tel'];
       $user = $_POST['user'];
       $pass = $_POST['pass'];
       $sql = "update member set User_Name='$User_Name',User_Password='$pass',User_Addr='$address',
       User_Email='$mail',User_Tel='$tel',User_Username='$user' where User_ID='$id' ";
       mysql_query($sql,$conn) or die("INSERT ลงตาราง DetailOrder มีข้อผิดพลาดเกิดขึ้น".mysql_error());
       session_register("User_Name");
       ?>
       <script>alert("แก้ไขข้อมูลเสร็จสิ้น");
       window.location.replace("CakeIndex.php");</script>
       <?php
     }
    }
    ?>
    <form action="FixMember.php" method="post">
    <table align="center"  border=0 bgcolor= #b0d350 class="divprocess">
    <center>
    <tr>
      <td>  ชื่อ </td><td> : </td><td> <input type="text" size="10" name="name" placeholder="กรุณาใส่ชื่อ" value="<?= $name ?>"/></td>
    </tr>
    <tr>
      <td>  ที่อยู่ </td><td> : </td><td> <input type="text" size="10" name="address" placeholder="กรุณาใส่รหัส" value="<?= $address ?>"/></td>
    </tr>
    <tr>
      <td>  E-mail </td><td> : </td><td> <input type="email" size="10" name="mail" placeholder="กรุณาใส่รหัส" value="<?= $mail ?>"/></td>
    </tr>
    <tr>
      <td>  เบอร์โทรติดต่อ </td><td> : </td><td> <input type="tel" size="10" name="tel" placeholder="กรุณาใส่รหัส" value="<?= $tel ?>"/></td>
    </tr>
    <tr>
      <td>  Username ที่ใช้ Login </td><td> : </td><td> <input type="text" size="10" name="user" placeholder="กรุณาใส่รหัส" value="<?= $user ?>"/></td>
    </tr>
    <tr>
      <td>  Password ที่ใช้ Login </td><td> : </td><td> <input type="password" size="10" name="pass" placeholder="กรุณาใส่รหัส" value="<?= $pass ?>"/></td>
    </tr>
    <tr>
      <td>  ยืนยัน Password  </td><td> : </td><td> <input type="password" size="10" name="pass2" placeholder="กรุณาใส่รหัส" /></td>
    </tr>
    <tr >
        <input type="hidden" name="ID1" value="<?= $_POST['ID1'] ?>">
        <input type="hidden" name="pass1" value="<?= $_POST['pass1'] ?>">
      <td  colspan=3 align=center> <input type="submit" name="issure" value="ยืนยัน"
        style="background-color:#4bed53;border-radius:10px;width:70px;height:30px;"/> </td>
    </tr>
    </center>
    </table>
    </form>
    <?php
  }
}
if ($check == 1 )
{
?>
  <center><div style="border-radius:10px;background-color:red;width:25%;height:200px;margin-top:30px;">
    <center><form action="FixMember.php" method="post"><table >
      <font  size="6"> กรุณายืนยันบัญชีของคุณ </font>
        <tr style="font-size:20px;"><td >Username</td><td><input type="text" maxlength="30" name="ID1" placeholder="Input Username"></td></tr>
        <tr style="font-size:20px;"><td>Password</td><td><input type="password" maxlength="30" name="pass1" placeholder="Input Password"></td></tr>
        <tr><td colspan="2" align="center"  ><input type="submit" name="Login" value="ยืนยัน" class="bt" ></td></tr>
      </font>
      </table></form></center>
  </div></center>
<?php
}
?>


  </fieldset>
  </body>
</html>
