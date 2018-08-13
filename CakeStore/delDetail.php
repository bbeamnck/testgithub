<?php
  session_start();
  if($_SESSION['Username'] != "admin" && $_SESSION['Password'] != "1234"){
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
  <body>
    <?php
        echo "Ready for Insert in Database";
        $hostname = "localhost";
        $username = "root";
        $password = "Thanadon11";
        $dbname = "cakestore";
        $conn = mysql_connect( $hostname, $username, $password );
        if ( ! $conn ) die ( "ไม่สามารถติดต่อกับ MySQL ได้");
        mysql_select_db ( $dbname, $conn )or die ( "ไม่สามารถเปิดตารางได้");
        mysql_query("SET NAMES UTF8");
        $user = $_POST['sent_ID'];
        $sql = "delete from detailorder where DO_ID = '$user'";
        mysql_query($sql,$conn) or die(" $user ".mysql_error());
        mysql_close($conn);
        ?>
        <script>window.location.replace("DBDetailOrder.php");</script>
  </body>
</html>
