<?php 
require_once("../init.php");
require_once("sql.php");
$user_cache = array();
		$query = mysql_query("SELECT * FROM " .$DB_PREFIX."user");
		while ($row = mysql_fetch_array($query)) {
			$photo = array();
			$avatar = '';
			if(!empty($row['photo'])){
				$photosrc = str_replace("../", '', $row['photo']);
				$imgsize = chImageSize($row['photo'], Option::ICON_MAX_W, Option::ICON_MAX_H);
				$photo['src'] = htmlspecialchars($photosrc);
				$photo['width'] = $imgsize['w'];
				$photo['height'] = $imgsize['h'];

				$avatar = strstr($photosrc, 'thum') ? str_replace('thum', 'thum52', $photosrc) : preg_replace("/^(.*)\/(.*)$/", "\$1/thum52-\$2", $photosrc);
				$avatar = file_exists('../' . $avatar) ? $avatar : $photosrc;
			}
			$row['nickname'] = empty($row['nickname']) ? $row['username'] : $row['nickname'];
			$user_cache[$row['uid']] = array(
				'photo' => $photo,
				'avatar' => $avatar,
				'name_orig' => $row['nickname'],
				'name' => htmlspecialchars($row['nickname']),
				'mail' => htmlspecialchars($row['email']),
				'des' => htmlClean($row['description'])
				);
		}
		$cacheData = serialize($user_cache);
$cachefile =  '../content/cache/user.php';
		$cacheData = "<?php exit;//" . $cacheData;
		@ $fp = fopen($cachefile, 'wb') OR emMsg('读取缓存失败。如果您使用的是Unix/Linux主机，请修改缓存目录 (content/cache) 下所有文件的权限为777。如果您使用的是Windows主机，请联系管理员，将该目录下所有文件设为可写');
		@ $fw = fwrite($fp, $cacheData) OR emMsg('写入缓存失败，缓存目录 (content/cache) 不可写');
		fclose($fp);
?>
	注册成功<span id="totalSecond">5</span>秒后自动跳转到登陆页
<script language="javascript" type="text/javascript">  
var second = totalSecond.innerText;  
setInterval("redirect()", 1000);  
function redirect(){  
totalSecond.innerText=--second;  
if(second<0) 
location.href='../admin/';
}  
</script> 