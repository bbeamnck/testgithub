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
    <title>จัดการข้อมูล Member</title>
  </head>
  <link href="https://fonts.googleapis.com/css?family=Kanit" rel="stylesheet">
<style>
  header{
    width : 100%;
    height : 320px;
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
<img src="2.jpg" style="width:100%;height:320px;">
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
  <li class="li-right"><a href ="DBMember.php?logout=true" style="color:blue;">logoff</a></li>
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

    <?php
       if(isset($_POST['insert'])!=null || isset($_POST['comfirm'])!=null){
         $flag=true;
         if(isset($_POST['comfirm'])!=null){
              if ($Mem_Id ==""){
                echo "<B><CENTER><li>คุณไม่ได้ใส่Username.</CENTER></B>";
                $flag=false;
              }
              if ($Mem_Pass ==""){
                echo "<B><CENTER><li>คุณไม่ได้ใส่Passwordหรือใส่ไม่ครบ8ตัว.</CENTER></B>";
                $flag=false;
              }
              if ($Mem_Name ==""){
                echo "<B><CENTER><li>คุณไม่ได้ใส่ชื่อ.</CENTER></B>";
                $flag=false;
              }
              if ($Mem_Add ==""){
                echo "<B><CENTER><li>คุณไม่ได้ใส่ที่อยู่.</CENTER></B>";
                $flag=false;
              }
              if($Mem_Mail ==""){
                echo "<B><CENTER><li>คุณไม่ได้ใส่E-mail.</CENTER></B>";
                $flag=false;
              }
              if ($Mem_Tel ==""){
                echo "<B><CENTER><li>คุณไม่ได้ใส่เบอร์โทรศัพท์.</CENTER></B>";
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


            $sql = "insert into member values('','$Mem_Name','$Mem_Pass','$Mem_Add','$Mem_Mail','$Mem_Tel','$Mem_Id')";
            mysql_query($sql,$conn) or die("INSERT ลงตาราง member มีข้อผิดพลาดเกิดขึ้น".mysql_error());
            ?>
            <script>window.location.replace("DBMember.php");</script>
            <?php
          }

         }
         if(isset($_POST['comfirm'])!="ยืนยัน" || $flag == false){
    ?>
        <center><form method="post" action="DBMember.php"><div class="divprocess">
          <table>
            <tr >
              <td colspan="3"> <h2 align=center> เพิ่มข้อมูล </h2></td>
            </tr>
            <tr>
              <td >Username </td><td>:</td>
              <td><input type="text" name="Mem_Id" placeholder="กรอกUsername" size=20 value="<?php echo $Mem_Id; ?>">
              </td>
            </tr>
            <tr>
              <td >Password <font size=2 color = #FF3300>(กรุณาใส่8ตัว) </td><td>:</td>
                <td><input type="pass" min=11111111 max=99999999 name="Mem_Pass" placeholder="กรอกPassword" size=25  value="<?php echo $Mem_Pass; ?>">
              </td>
            </tr>
            <tr>
              <td >ชื่อ </td><td>:</td>
              <td><input type="text" name="Mem_Name" placeholder="กรอกชื่อนามสกุล" size=30 value="<?php echo $Mem_Name; ?>">
              </td>
            </tr>
            <tr>
              <td >ที่อยู่ </td><td>:</td>
              <td><input type="text" name="Mem_Add" placeholder="กรอกที่อยู่" size=40 value="<?php echo $Mem_Add; ?>">
              </td>
            </tr>
            <tr>
              <td>E-mail </td><td>:</td>
              <td><input type="email" name="Mem_Mail" placeholder="กรอกอีเมล" size=30 value="<?php echo $Mem_Mail; ?>">
              </td>
            </tr>
            <tr>
              <td >เบอร์โทรศัพท์ </td><td>:</td>
              <td><input type="number" name="Mem_Tel" placeholder="กรอกเบอร์โทรศัพท์" size=10 value="<?php echo $Mem_Tel; ?>">
              </td>
            </tr>
            <tr><td colspan=3 align=center><input type="submit" name ="comfirm" value="ยืนยัน"
               style="background-color:#4bed53;border-radius:10px;width:70px;height:30px;"></td></tr>
          </table>
</div></form></center>
    <?php
    }
      }

      else if (isset($_POST['show']) == "show"){
        ?>
            <script>window.location.replace("DBMember.php");</script>
        <?php
      }
        else if ($_POST['id'] == "Yes"){
        $hostname = "localhost";
        $username = "root";
        $password = "1234";
        $dbname = "cakestore";
        $conn = mysql_connect( $hostname, $username, $password );
        if ( ! $conn ) die ( "ไม่สามารถติดต่อกับ MySQL ได้");
        mysql_select_db ( $dbname, $conn )or die ( "ไม่สามารถเปิดตารางได้");
        mysql_query("SET NAMES UTF8");
        $sqltxt = "DELETE FROM member where User_ID = '$id' ";
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
    $sqltxt = "SELECT * FROM member order by User_ID";
    $result = mysql_query ( $sqltxt, $conn );
    ?>
    <center><div style="width:50%;height:auto;background-color:#36c1a1;margin-top:20px;border-radius:15px;">
    <?php
      while ( $rs = mysql_fetch_array ( $result ) ){

        echo '<div style="width:80%;height:auto;background-color:#6dedcf;margin-top:20px;border-radius:15px;">';
        echo '<table align="center"><tr><td>รหัสสมาชิก </td><td>:</td>
              <td >'.$rs[0].'</td>';
        echo '<tr><td>Username </td><td>:</td><td>'.$rs[6].'</td></tr>';
        echo '<tr><td>Password </td><td>:</td><td>'.$rs[2].'</td></tr>';
        echo '<tr><td>ชื่อ </td><td>:</td><td>'.$rs[1].'</td></tr>';
        echo '<tr><td>ที่อยู่ </td><td>:</td><td>'.$rs[3].'</td></tr>';
        echo '<tr><td>E-mail </td><td>:</td><td>'.$rs[4].'</td></tr>';
        echo '<tr><td>เบอร์โทรศัพท์ </td><td>:</td><td>'.$rs[5].'</td></tr>';
        echo '<tr><td align="center" class="do" colspan=6><form method="post" ><button style="background-color:red;"type="submit" formaction="Deletemem.php?id='.$rs[0].'" name="Delete" value="ok" onclick="return confirm(\'ยืนยันการลบข้อมูลสมาชิก '.$rs[1].'\')">ลบข้อมูล</button>
          <button type="submit" name="Update" value="ok" formaction="Updatemem.php?id='.$rs[0].'&User='.$rs[6].'&Pass='.$rs[2].'&Name='.$rs[1].'&Add='.$rs[3].'&Mail='.$rs[4].'&Tel='.$rs[5].'">แก้ไข</button></form></form></td></tr></table>';
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
