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
      width:20%;
      height:auto;
      background-color: #b0d350;
      padding-left: 10px;
      font-size: 20px;
    }
    .showtable {
      width:40%;
      height:auto;
      background-color:#6dedcf;
      margin-top:20px;
      border-radius:15px;
    }
    .bgdb{
      width:50%;
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
      <li class="li-right"><a href ="upDetail.php?logout=true" style="color:blue;">logoff</a></li>
      <li style="float: right;font-size:20px;display: block;color: white;text-align:center;padding: 14px 16px;text-decoration: none;">Hi Administator,Welcome to Database Management.</li>

    </ul></div>
    <fieldset style="height:auto;">
      <legend align="center" style="font-size:28px;"> จัดการรายละเอียดการสั่งซื้อ </legend>
      <form method="post" action="DBDetailOrder.php">
        <div class="do" align=center >
          <button type="submit" name="insert" value="insert"> Insert </button>
          <button type="submit" name="show" value="show"> Show </button>
        </div>
      </form>
    <?php
      $detail = $_POST['sent_detail'];
      $order = $_POST['sent_order'];
      $product = $_POST['sent_product'];
      $amount = $_POST['sent_amount'];
      $ch = 1;
      if($_POST['issure'] != null)
      {
        if($_POST['ID_order'] == "" )
        {
          echo "<B><center><li> กรุณาใส่รหัสสั่งซื้อ  </center></B>";
          $ch=0;
        }
        if($_POST['ID_product'] == "" )
        {
          echo "<B><center> กรุณาใส่รหัสสินค้า  </center></B>";
          $ch=0;
        }
        if($_POST['ID_amount'] == "")
        {
          echo "<B><center> กรุณาใส่จำนวน  </center></B>";
          $ch=0;
        }
        echo "<br />";
        if($ch==1)
        {
            echo "Ready for Insert in Database";
            $hostname = "localhost";
            $username = "root";
            $password = "Thanadon11";
            $dbname = "cakestore";
            $conn = mysql_connect( $hostname, $username, $password );
            if ( ! $conn ) die ( "ไม่สามารถติดต่อกับ MySQL ได้");
            mysql_select_db ( $dbname, $conn )or die ( "ไม่สามารถเปิดตารางได้");
            mysql_query("SET NAMES UTF8");
            $dborder = $_POST['ID_order'];
            $dbproduct = $_POST['ID_product'];
            $amount = $_POST['ID_amount'];
            $sql = "update detailorder set Order_ID = '$dborder' , Product_ID = '$dbproduct' , Amount = '$amount' where DO_ID = $detail";
            mysql_query($sql,$conn) or die(" ไปเช็คไหม่ ".mysql_error());
            mysql_close($conn);
            ?>
            <script>window.location.replace("DBDetailOrder.php");</script>
            <?php
          }
      }
    ?>
    <form action="upDetail.php" method="post">
    <table align="center"  border=0 bgcolor= #b0d350 class="divprocess">
      <center>
        <tr>
          <td colspan="3"> <h2 align=center > Update ข้อมูล </h2></td>
        </tr>
      <tr> <input type="hidden" name="sent_detail" value="<?=$detail?>" >
        <td align="right">  รหัสรายละเอียดการสั่งซื้อ </td><td> : </td><td> <input type="text" size="10" name="ID_detail" value="<?= $detail ?>" disabled /></td>
      </tr>
      <tr> <input type="hidden" name="sent_order" value="<?=$order?>" >
        <td align="right">  รหัสการสั่งซื้อ </td><td> : </td><td> <input type="text" size="10" name="ID_order" value="<?= $order ?>" /></td>
      </tr>
      <tr> <input type="hidden" name="sent_product" value="<?=$product?>" >
        <td align="right">  รหัสสินค้า </td><td> : </td><td> <input type="text" size="10" name="ID_product" value="<?= $product ?>" /></td>
      </tr>
      <tr> <input type="hidden" name="sent_amount" value="<?=$amount?>" >
        <td align="right">  จำนวนสินค้า </td><td> : </td><td> <input type="text" size="10" name="ID_amount" value="<?= $amount ?>" /></td>
      </tr>
      <tr >
        <td  colspan=3 align=center> <input type="submit" name="issure" value="ยืนยัน"
          style="background-color:#4bed53;border-radius:10px;width:70px;height:30px;margin:10px;"/> </td>
      </tr>
      </center>
    </table>
    </form>
    <?php
      ?>
    </fieldset>
  </body>
</html>
