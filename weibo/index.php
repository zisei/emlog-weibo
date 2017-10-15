<meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
<meta http-equiv="ragma" content="no-cache" />
<meta http-equiv="cache-Control" content="no-cache"/>
<meta http-equiv="expires" content="0" />
<?php
session_start();
include_once( 'Loginws/config.php' );
include_once( 'Loginws/oauth.class.php' );
$o = new SaeTOAuthV2( WB_AKEY , WB_SKEY );
$code_url = $o->getAuthorizeURL( WB_CALLBACK_URL );
header("Location: $code_url");
?>
        
        