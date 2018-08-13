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
  if(isset($_POST['update'])){
    $name = $_POST['product_name'];
    $price = $_POST['product_price'];
    $amount = $_POST['product_amount'];
    $hostname = "localhost";
    $username = "root";
    $password = "1234";
    $dbname = "cakestore";
    $conn = mysql_connect( $hostname, $username, $password );
    if ( ! $conn ) die ( "ไม่สามารถติดต่อกับ MySQL ได้");
    mysql_select_db ( $dbname, $conn )or die ( "ไม่สามารถเปิดตารางได้");
    mysql_query("SET NAMES UTF8");
    $sqltxt = "UPDATE product SET Product_Name='$name',Product_Price='$price',Product_Amount='$amount' WHERE Product_ID=$id";
    $result = mysql_query ( $sqltxt, $conn );
    mysql_close($conn);
    ?>
    <script>window.location.replace("DBProduct.php");</script>
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
  button{
  border-radius: 10px;
    outline: none;
    padding: 14px 16px;
      box-shadow: 0px 8px 16px 0px rgba(0,0,0,0.2);
      background-color:#59ff6c;
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
    <li class="li-right"><a href ="updateproduct.php?logout=true" style="color:blue;">logoff</a></li>
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
    <center><form method="post" action="updateproduct.php?id=<?php echo $id;?>"><div class="divprocess">
      Update ข้อมูล
      <table>
        <tr><td >รหัสสินค้า </td><td>:</td><td><input type="text" name="product_id"  size=10 value="<?php echo $id; ?>" disabled></td></tr>
        <tr><td >ชื่อสินค้า </td><td>:</td><td><input type="text" name="product_name" placeholder="กรอกชื่อสินค้า" size=40 value="<?php echo $name; ?>"></td></tr>
        <tr><td >ราคาสินค้า </td><td>:</td><td><input type="number" min=1 max=9999 name="product_price" placeholder="กรอกราคาสินค้า" size=10 value="<?php echo $price; ?>"></td></tr>
        <tr><td >จำนวนสินค้า </td><td>:</td><td><input type="number" min=0 max=999 name="product_amount" placeholder="กรอกจำนวนสินค้า" size=10 value="<?php echo $amount; ?>"></td></tr>
        <tr><td colspan=3 align=center><input type="submit"class="button" name="update" value="ยืนยัน"></td></tr>

      </table>
    </div></form></center>


  </fieldset>
    </body>
</html>
