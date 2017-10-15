<?php 
require_once("../../../init.php");
if($_GET["action"] == "weibo"){
$username = $_GET['user'];
LoginAuth::setAuthCookie($username, $ispersis);?>
<script language="javascript" type="text/javascript">
window.location.href="<?php echo "http://".$_SERVER['HTTP_HOST']."/admin"; ?>";</script>
<?php 
}
?>