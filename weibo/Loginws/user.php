<?php 
include("sql.php");
if($_GET["name"] != ""){
$youx =$_GET["name"];
    $sql="select * from ".$DB_PREFIX."weibo where uid ='$youx'";
      $rs=mysql_query($sql);
	  if(mysql_fetch_array($rs) == ""){echo "3";}else{
	  $rs=mysql_query($sql);
	  while ($result = mysql_fetch_array($rs)) {
	  if($result['weibo_user'] == ""){echo "1";}
	  else if($result['weibo_user'] != ""){echo "0";}
	  }}
}
?>