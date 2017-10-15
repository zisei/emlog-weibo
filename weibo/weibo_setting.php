<?php
!defined('EMLOG_ROOT') && exit('access deined!');
function plugin_setting_view(){
include_once( 'Loginws/config.php' );
?>
<div class="com-hd">
<h2>新浪微博登录设置</h2>
<b>你的登录微博地址为：<?php echo $url.'/content/plugins/weibo/';?></b>
</div>
<form action="plugin.php?plugin=weibo&action=setting" method="post">
<table class="tb-set">
<tr>
<td align="right"><b>AKEY：</b></td>
<td><input type="text" class="txt" name="akey" value="<?php echo $akey;?>" /></td>
<td align="right"></td>
</tr>
<tr>
<td align="right"><b>SKEY：</b></td>
<td><input type="text" class="txt" name="skey" value="<?php echo $skey;?>"/></td>
<td align="right"></td>
</tr>
<tr>
<td align="right"><b>CALL：</b></td>
<td><input type="text" class="txt" name="callback" value="<?php echo $callback;?>" /></td>
<td align="right"></td>
</tr>
<tr>
<td align="right"><b>URL：</b></td>
<td><input type="text" class="txt" name="url" value="<?php echo $url;?>" /></td>
<td align="right"></td>
</tr>
<tr>
<td>&nbsp;</td>
<td><input type="submit" name="submit" value="保存" />
<td align="right"></td>
</td>
</tr>
</table>
</form>

<?php
}
function plugin_setting(){
$akey = addslashes($_POST["akey"]);
$skey = addslashes($_POST["skey"]);
$callback = addslashes($_POST["callback"]);
$url = addslashes($_POST["url"]);
$newConfig = '<?php
session_start();
header("Content-Type: text/html; charset=UTF-8");
define( "WB_AKEY" , "'.$akey.'" );
define( "WB_SKEY" , "'.$skey.'" );
define( "WB_CALLBACK_URL" , "'.$callback.'" );
$akey = "'.$akey.'";
$skey = "'.$skey.'";
$callback = "'.$callback.'";
$url = "'.$url.'";
';

echo $newConfig;
@file_put_contents(EMLOG_ROOT.'/content/plugins/weibo/Loginws/config.php', $newConfig);
}
?>
        
        
        
        
        
        
        
        