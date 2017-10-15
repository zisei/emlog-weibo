<?php 
include("sql.php");
if($_GET['youx'] != ""){
$youx = $_GET['youx'];
$name = $_GET['zh'];
      $sql="select * from ".$DB_PREFIX."user where email ='$youx'";
      $rs=mysql_query($sql);
	  $sqll="select * from ".$DB_PREFIX."user where username ='$name'";
      $rsl=mysql_query($sqll);
	  if(mysql_fetch_array($rs) == ""){
	  if(mysql_fetch_array($rsl) == ""){
      echo "2";}
	  }
	  $rsl=mysql_query($sqll);
	  if(mysql_fetch_array($rsl) == ""){
	  echo "3";}

	  $qs="select * from ".$DB_PREFIX."user where username ='$name'";
      $l=mysql_query($qs);
      while ($result = mysql_fetch_array($l)) {
	  if($result['email'] == $youx){echo "0";}
	  else if($result['email'] != $youx) {echo "1";}
  
   }

 }
?>