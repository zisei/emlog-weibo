<meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
<?php
header("Content-Type:text/html;charset=utf8");
include("sql.php");
$DB_HOST = constant("DB_HOST");
$DB_USER = constant("DB_USER");
$DB_PASSWD = constant("DB_PASSWD");
$DB_NAME = constant("DB_NAME");
$DB_PREFIX = constant("DB_PREFIX");
$db=mysql_connect($DB_HOST,$DB_USER,$DB_PASSWD);
mysql_select_db($DB_NAME,$db);
mysql_query("SET NAMES 'utf8'",$db);
$emailx = $_POST['name_mailbox'];
$weibo_id = $_POST['weiboid'];
$avatar = $_POST['avatar'];
$nickname = $_POST['nickname'];
$username = $_POST['username'];
$password = '';
$hash = password_hash("$password", PASSWORD_DEFAULT);
$sql="select * from ".$DB_PREFIX."weibo where uid ='$username'";
$crque = mysql_query($sql);
if(mysql_num_rows($crque) == ""){
$cre = mysql_query("select * from ".$DB_PREFIX."user where username ='$username'");
if(mysql_num_rows($cre) == ""){
mysql_query("INSERT INTO ".$DB_PREFIX."weibo (uid,weibo_user) VALUES ('$username','$weibo_id')");
$sqlx = "INSERT INTO ".$DB_PREFIX."user (username,nickname,role,photo,email) VALUES ('$username','$nickname','writer','$avatar','$emailx')";
if(mysql_query($sqlx) == "1"){
header("location:".$url."/content/plugins/weibo/ht.php?action=weibo&user=".$username);
}
}else{
$sx = "INSERT INTO ".$DB_PREFIX." weibo (uid,weibo_user) VALUES ('$username','$weibo_id')";
mysql_query($sx);
if(mysql_query($sx) == "1"){
header("location:".$url."/content/plugins/weibo/ht.php?action=weibo&user=".$username);
}
}
}
?>