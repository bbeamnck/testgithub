<?php
  session_start();
  if($_SESSION['RegisSuccess'] == null){
    ?>
    <script>window.location.replace("CakeIndex.php");</script>
    <?
  }
  if($logout){
    session_destroy();
    ?>
    <script>window.location.replace("CakeLogin.php");</script>
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

  </style>
  <body>
    <header>
    <img src="2.jpg" style="width:100%;height:300px;">
    </header>
<div><ul>
  <li class="li-left"><a href ="CakeIndex.php">หน้าแรก</a></li>
  <li class="li-left"><a href ="Tel.php"> ติดต่อเรา </a></li>
  <li class="li-right"><a href ="CakeLogin.php">เข้าสู่ระบบ/ลงทะเบียน</a></li>
</ul></div>
<fieldset style="height:auto;">
  <legend align="center" style="font-size:28px;"> Register Success </legend>
    <center><h1> Register Complete </h1><br />
    <h2><a href="RegisSuccess.php?logout=true"> กลับไปหน้า Login </a></h2></center>
  </fieldset>
  </body>
</html>
