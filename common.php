<?php
/**
 * @Description:      
 * @Author:      Abner<346882795@qq.com>
 * @DateTime:    2017-10-25 11:21:55
 */
use think\Config;
use think\Db;
use think\Url;
// use dir\Dir;
use think\Route;
use think\Loader;
use think\Request;
// use cmf\lib\Storage;


// 应用公共文件

//设置插件入口路由
Route::any('plugin/[:_plugin]/[:_controller]/[:_action]', "\\cmf\\controller\\PluginController@index");
Route::get('captcha/new', "\\cmf\\controller\\CaptchaController@index");


/**
 * 获取网站根目录
 * @return string 网站根目录
 */

 /**
 * 判断 cmf 核心是否安装
 * @return bool
 */

function cmf_is_installed()
{
	static $cmfIsInstalled;
	if (empty($cmfIsInstalled))
	{
		$cmfIsInstalled = file_exists( CMF_ROOT. 'data/install.lock');
	}
	return $cmfIsInstalled;
}