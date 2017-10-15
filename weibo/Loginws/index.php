<?php
session_start();
include_once('config.php' );
include_once('oauth.class.php' );
$c = new SaeTClientV2( WB_AKEY , WB_SKEY , $_SESSION['token']['access_token'] );
$uid_get = $c->get_uid();
$uid = $uid_get['uid'];
$user_message = $c->show_user_by_id( $uid);//根据ID获取用户等基本信息
require_once '../../../../init.php';
require_once '../../../../config.php';
$DB_HOST = constant("DB_HOST");
$DB_USER = constant("DB_USER");
$DB_PASSWD = constant("DB_PASSWD");
$DB_NAME = constant("DB_NAME");
$DB_PREFIX = constant("DB_PREFIX");
$db=mysql_connect($DB_HOST,$DB_USER,$DB_PASSWD);
mysql_select_db($DB_NAME,$db);
  mysql_query("CREATE TABLE IF NOT EXISTS `".DB_PREFIX."weibo` (
  `id` mediumint(10) unsigned NOT NULL AUTO_INCREMENT,
  `uid` varchar(64) NOT NULL,
  `weibo_user` varchar(64) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 AUTO_INCREMENT=1 ;");
      $sql="select * from ".$DB_PREFIX."weibo where weibo_user='$uid'";
      $rs=mysql_query($sql);
	   if(mysql_fetch_array($rs) != ""){ 
	   $rs=mysql_query($sql);
	   while ($result = mysql_fetch_array($rs)) {
	     header("location:".$url."/content/plugins/weibo/ht.php?action=weibo&user=".$result['uid']);
		}
	}
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=Edge">
  <meta name="viewport" content="width=device-width, initial-scale=1.0, user-scalable=0, minimum-scale=1.0, maximum-scale=1.0">
<link rel="stylesheet" href="./views/css/css-login.css" type="text/css" media="screen" /> 
<title>绑定站内账号</title>
</head>
<body>
<script src="jquery-1.7.1.js" type="text/javascript" language="javascript"></script>
<script type="text/javascript">
//--------------------------用户名称
var dd;
var ee;
function  ajaxFunction(){
var name=document.getElementsByName("username")[0].value;
$.ajax({ 
type: "get", 
url: "<?php echo $url."/content/plugins/weibo/Loginws/user.php";?>", 
data: "name="+name,
success: function(datax){ 
if (name == ""){
document.getElementById("repwd_msg").innerHTML='<div><font color=red >账号不能为空!</font></div>';}
else if(document.getElementsByName("username")[0].value.length < 6){
document.getElementById("repwd_msg").innerHTML='<div><font color=red>账号不能少于六!</font></div>';
}else if(datax == 1){
		dd = "1";
		document.getElementById("repwd_msg").innerHTML='<div><font color=green>这个账号已经注册过了你可以绑定本账号!</font></div>';
		} else if(datax == 3){
		dd = "1";
		document.getElementById("repwd_msg").innerHTML='<div><font color=#337fe5>这个账号还没有被注册过你可以绑定本账号!</font></div>';
		}else if(datax == 0){
		document.getElementById("repwd_msg").innerHTML='<div><font color=red>该账号已经被绑定!</font></div>';}
}
}); 
}
//-------------------------邮箱验证
function  mailbox(strEmail){ajaxFunction()
var namet=document.getElementsByName("username")[0].value;
if(namet == ""){alert("请填写账号后在来填写邮箱!");}else{
     var xmlHttp;
 try
    {
   // Firefox, Opera 8.0+, Safari
    xmlHttp=new XMLHttpRequest();
    }
 catch (e)
    {
 // Internet Explorer
   try
      {
      xmlHttp=new ActiveXObject("Msxml2.XMLHTTP");
      }
   catch (e)
      {
     try
         {
         xmlHttp=new ActiveXObject("Microsoft.XMLHTTP");
         }
      catch (e)
         {
         alert("您的浏览器不支持AJAX！");
         return false;
         }
      }
    }
       xmlHttp.onreadystatechange=function()
      {
	   var xx = document.getElementsByName("name_mailbox")[0].value;
if (xx == ""){document.getElementById("mailbox_msg").innerHTML='<div><font color=red>邮箱不能为空!</font></div>';}
else if(strEmail.search(/\w[-\w.+]*@(126|163|sina|sohu|yahoo|qq|sogou|gmail|vip.qq|mdloli|foxmail|hotmail|ckzhw)\.+[A-Za-z]{2,4}/) != -1) {

if(xmlHttp.readyState==4)
        {
       var x = xmlHttp.responseText;//获取传过来的值
	    if(x == 23){ee = "1";
		document.getElementById("mailbox_msg").innerHTML='<div><font color=green>邮箱还没有被注册过!</font></div>';}
        else if(x == 0)
		{ee = "1";
		document.getElementById("mailbox_msg").innerHTML='<div><font color=green>账号和邮箱一至!</font></div>';}
		else if(x == 1)
		{document.getElementById("mailbox_msg").innerHTML='<div><font color=red>账号和邮箱与当初的数据不一至请重新输入!</font></div>';}
		else if(x == 3)
		{document.getElementById("mailbox_msg").innerHTML='<div><font color=red>邮箱已经被注册!</font></div>';}
		}
	 }
	 else{document.getElementById("mailbox_msg").innerHTML='<div><font color=red>邮箱地址不正确</font></div>';}
	 }
  var name=document.myForm.name_mailbox.value;
  var namex=document.myForm.username.value;
 xmlHttp.open("get","mail.php?youx="+name+"&zh="+namex,true);
    xmlHttp.send(null);
}
}
 function check(){
 if(dd != "1"){ajaxFunction();return false;}
 else if(ee != "1"){mailbox();return false;}
 }
</script>

<div class="note">
  <div class="post">
    <div class="article">
        <h3 class="title" style="text-align:center;font-weight:normal">绑定站内账号</h3><hr>
	<div class="show-content sign"><div class="js-sign-in-container">
<div class="avatar"><img src="<?php echo $user_message['avatar_large']; ?>"></div>
<div class="name"><?php echo $user_message['screen_name'];?></div>
<form name="myForm" method="POST" action="reg.php" onsubmit="return check();" >
<input name="weiboid" value="<?php echo $uid_get['uid'];?>" style="display:none" />
<input name="avatar" value="<?php echo $user_message['avatar_large'];?>" style="display:none" />
<input name="nickname" value="<?php echo $user_message['screen_name'];?>" style="display:none" />
<div class="input-group">
  <span class="input-group-addon"><i class="iconfont ic-user"></i></span>
		<input type="text" class="form-control" placeholder="用户名" name="username"  id="username" value="<?php echo $user_message['domain'];?>" onblur="ajaxFunction(name);"   onkeyup="value=value.replace(/[^\w\.\/]/ig,'')"/>
</div>
<div><span id="repwd_msg"></span></div>

<div class="input-group" style="margin-top:5px">
  <span class="input-group-addon"><i class="iconfont ic-email"></i></span>
		<input name="name_mailbox" placeholder="邮箱" class="form-control" id="id_mailbox" onBlur="mailbox(this.value);"  />
</div>
<div><span id="mailbox_msg"></span></div>
<div><button type="submit" class="sign-in-button"/>登录</button></div>
	<div class="login-ext"></div>
</div>
</form>
</body>
</html>