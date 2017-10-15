<style>
*{margin:0px;padding:0px;}
body{background:#fff}
#top{width:100%;height:50px;font-size:25px;text-align:center;margin-bottom:5px;background:#fff;line-height:50px;}
#contentwb{background:#fff;height:100%;text-align:center;padding-top:35px;font-size:20px;}
</style>
<?php
session_start();
include_once( 'Loginws/config.php' );
include_once( 'Loginws/oauth.class.php' );
$o = new SaeTOAuthV2( WB_AKEY , WB_SKEY );
$c = new SaeTClientV2( WB_AKEY , WB_SKEY , $_SESSION['token']['access_token'] );
$uid_get = $c->get_uid();
$uid = $uid_get['uid'];
$user_message = $c->show_user_by_id( $uid);//根据ID获取用户等基本信息
if (isset($_REQUEST['code'])) {
	$keys = array();
	$keys['code'] = $_REQUEST['code'];
	$keys['redirect_uri'] = WB_CALLBACK_URL;
	try {
		$token = $o->getAccessToken( 'code', $keys ) ;
	} catch (OAuthException $e) {
	}
}

if(ROLE == 'admin' || ROLE == 'writer'){
    header("Location: ".BLOG_URL);
    exit();
}

if ($token) {
    $_SESSION['token'] = $token;
    setcookie( 'weibojs_'.$o->client_id, http_build_query($token) );
    header("location:".$url."/content/plugins/weibo/Loginws");
}else{
    echo '<script>alert("授权失败");history.go(-1);</script>';
}
?>
        
        
        
        
        
        
        
        
        
        
        
        
        
        
        
        
        
        
        
        
        
        
        