<?php 
include("../../../../config.php");
$DB_HOST = constant("DB_HOST");
$DB_USER = constant("DB_USER");
$DB_PASSWD = constant("DB_PASSWD");
$DB_NAME = constant("DB_NAME");
$DB_PREFIX = constant("DB_PREFIX");
$db=mysql_connect($DB_HOST,$DB_USER,$DB_PASSWD);
mysql_select_db($DB_NAME,$db);
?>