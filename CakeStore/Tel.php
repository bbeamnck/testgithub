<? session_start(); ?>
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
  b {
    width: 400px;
    height: 200px;
    padding: 20px 20px 20px 50px;
    background-color: #FFA07A;
    border-radius: 15px;
    position: right;

  }
</style>
  <body >
<header>
<img src="2.jpg" style="width:100%;height:320px;">
</header>
<div><ul>
  <li class="li-left"><a href ="CakeIndex.php">หน้าแรก</a></li>
  <li class="li-left"><a href ="Tel.php"> ติดต่อเรา </a></li>

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
  <?php
  }
  else{
    ?>
    <li class="li-right"><a href ="CakeLogin.php">เข้าสู่ระบบ/ลงทะเบียน</a></li>
    <?php
  }
   ?>
</ul></div>
<body>

    <fieldset style="height:auto;">
      <legend align="center" style="font-size:28px;">ติดต่อเรา</legend>
      <center>
        <img src="beam.jpg" width="900px" height="600px">

    </fieldset>

</body>
</html>
