<?php
session_start();
if(!$_SESSION['User_ID']){
?>
<script>window.location.replace("CakeIndex.php");</script>
<?php
}
$Cart = $_SESSION['Cart'];
$Run =0;
//$Cart = null;
 /*for($i ; $i< count($A);$i++){
   if($i == $row){
     $Run++;

   }
   $Cart[$i][0]=$A[$Run][0];
   $Cart[$i][1]=$A[$Run][1];
   $Run++;
 }*/
array_splice($Cart,$row,1);
session_register('Cart');

 ?>
 <script>window.location.replace("ShoppingCart.php");</script>
