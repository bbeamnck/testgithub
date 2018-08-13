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
<?php
  if(isset($_POST['comfirm'])){

    $User = $_POST['Mem_Id'];
    $Pass = $_POST['Mem_Pass'];
    $Name = $_POST['Mem_Name'];
    $Add = $_POST['Mem_Add'];
    $Mail = $_POST['Mem_Mail'];
    $Tel = $_POST['Mem_Tel'];
    $hostname = "localhost";
    $username = "root";
    $password = "1234";
    $dbname = "cakestore";
    echo $id,$User;
    $conn = mysql_connect( $hostname, $username, $password );
    if ( ! $conn ) die ( "ไม่สามารถติดต่อกับ MySQL ได้");
    mysql_select_db ( $dbname, $conn )or die ( "ไม่สามารถเปิดตารางได้");
    mysql_query("SET NAMES UTF8");
    $sqltxt = "UPDATE member SET User_Username='$User',User_Password='$Pass',User_Name='$Name',User_Addr='$Add',User_Email='$Mail',User_Tel='$Tel' WHERE User_ID=$id";
    $result = mysql_query ( $sqltxt, $conn );
    mysql_close($conn);


    ?>
    <script>window.location.replace("DBMember.php");</script>
    <?php
  }
 ?>
<html lang="en" dir="ltr">
  <head>
    <meta charset="utf-8">
    <title>จัดการข้อมูล Member</title>
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
  .button{
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
    <li class="li-right"><a href ="Updatemem.php?logout=true" style="color:blue;">logoff</a></li>
    <li style="float: right;font-size:20px;display: block;color: white;text-align:center;padding: 14px 16px;text-decoration: none;">Hi Administator,Welcome to Database Management.</li>

  </ul></div>

  <fieldset style="height:auto;">
    <legend align="center" style="font-size:28px;">จัดการฐานข้อมูล Member</legend>
    <form method="post" action="DBMember.php">
      <div class="do" align=center >
        <button type="submit" name="insert" value="insert">Insert</button>
        <button type="submit" name="Show" value="Show">Show</button>
      </div>
    </form>
    <center><form method="post" action="Updatemem.php?id=<?php echo $id;?>"><div class="divprocess">
      Update ข้อมูล
      <table>
        <tr>
          <td>รหัสสมาชิก </td><td>:</td>
          <td><input type="text" name="Member" size=10 value="<?php echo $id; ?>" disabled></td></tr>

        <tr>
          <td >Username </td><td>:</td>
          <td><input type="text" name="Mem_Id" placeholder="กรอกUsername" size=20 value="<?php echo $User; ?>">
          </td>
        </tr>
        <tr>
          <td >Password <font size=2 color = #FF3300>(กรุณาใส่8ตัว) </td><td>:</td>
            <td><input type="text" name="Mem_Pass" placeholder="กรอกPassword" size=25  value="<?php echo $Pass; ?>">
          </td>
        </tr>
        <tr>
          <td >ชื่อ </td><td>:</td>
          <td><input type="text" name="Mem_Name" placeholder="กรอกชื่อนามสกุล" size=30 value="<?php echo $Name; ?>">
          </td>
        </tr>
        <tr>
          <td >ที่อยู่ </td><td>:</td>
          <td><input type="text" name="Mem_Add" placeholder="กรอกที่อยู่" size=40 value="<?php echo $Add; ?>">
          </td>
        </tr>
        <tr>
          <td>E-mail </td><td>:</td>
          <td><input type="email" name="Mem_Mail" placeholder="กรอกอีเมล" size=30 value="<?php echo $Mail; ?>">
          </td>
        </tr>
        <tr>
          <td >เบอร์โทรศัพท์ </td><td>:</td>
          <td><input type="number" name="Mem_Tel" placeholder="กรอกเบอร์โทรศัพท์" size=10 value="<?php echo $Tel; ?>">
          </td>
        </tr>
        <tr><td colspan=3 align=center><input type="submit" name ="comfirm" value="ยืนยัน"
           style="background-color:#4bed53;border-radius:10px;width:70px;height:30px;"></td></tr>
      </table>
</div></form></center>


  </fieldset>
    </body>
</html>
