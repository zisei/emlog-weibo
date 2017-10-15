<?php defined('EMLOG_ROOT') or die('本页面禁止直接访问!');
/*
Plugin Name: 新浪微博登录
Version: 2.0
Plugin URL: http://www.zisei.com
Description: 新浪微博开放平台申请
Author: 宋稳
Author URL: http://www.zisei.com*/

addAction('adm_sidebar_ext', 'weibo_ht');

function weibo_ht() {
	echo '<div class="sidebarsubmenu" id="qq_land"><a href="./plugin.php?plugin=weibo">微博登录</a></div>';
}

addAction('weibo', 'weibo_qt');

function weibo_qt() {
	echo '<a href="content/plugins/weibo" target="_blank"><img src="content/plugins/weibo/weibo_login.gif" /></a>';
}