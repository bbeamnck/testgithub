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
    <title>จัดการข้อมูล</title>
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
  <body>

<header>
<img src="2.jpg" style="width:100%;height:300px;">
</header>

<div><ul>
  <li class="li-left"><a href ="CakeIndex.php">หน้าแรก</a></li>
  <li class="li-left"><a href ="Tel.php"> ติดต่อเรา </a></li>

  <div class="dropdown">
    <button class="dropbtn">Database ▼
      <i class="fa fa-caret-down"></i>
    </button>
  <div class="dropdown-content">
       <a href="DBProduct.php">Product</a>
       <a href="DBOrder.php">Order</a>
       <a href="DBDetailOrder.php">DetailOrder</a>
       <a href="DBMember.php">Member</a>
     </div></div>
  <li class="li-right"><a href ="MainDatabase.php?logout=true" style="color:blue;">logoff</a></li>
  <li style="float: right;font-size:20px;display: block;color: white;text-align:center;padding: 14px 16px;text-decoration: none;"></li>
  <div class="dropdown" style="float:right;">
    <button class="dropbtn">Hi Administator,Welcome to Database Management. ▼
      <i class="fa fa-caret-down"></i>
    </button>
  <div class="dropdown-content">
       <a href="ShoppingCart.php">รถเข็น</a>
       <a href="UserOrder.php">ใบรายการสั่งซื้อ</a>
       <a href="FixMember.php">แก้ไขข้อมูลส่วนตัว</a>

     </div></div>

</ul></div>

  </body>
</html>
