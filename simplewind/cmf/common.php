<?php
// +----------------------------------------------------------------------
// | ThinkCMF [ WE CAN DO IT MORE SIMPLE ]
// +----------------------------------------------------------------------
// | Copyright (c) 2013-2017 http://www.thinkcmf.com All rights reserved.
// +----------------------------------------------------------------------
// | Licensed ( http://www.apache.org/licenses/LICENSE-2.0 )
// +---------------------------------------------------------------------
// | Author: Dean <zxxjjforever@163.com>
// +----------------------------------------------------------------------
use think\Config;
use think\Db;
use think\Url;
use dir\Dir;
use think\Route;
use think\Loader;
use think\Request;
use cmf\lib\Storage;

// 应用公共文件

//设置插件入口路由
Route::any('plugin/[:_plugin]/[:_controller]/[:_action]', "\\cmf\\controller\\PluginController@index");
Route::get('captcha/new', "\\cmf\\controller\\CaptchaController@index");


/**
 * 判断 cmf 核心是否安装
 * @return bool
 */
function cmf_is_installed()
{
    static $cmfIsInstalled;
    if (empty($cmfIsInstalled)) {
        $cmfIsInstalled = file_exists(CMF_ROOT . 'data/install.lock');
    }
    return $cmfIsInstalled;
}

/**
 * 获取网站根目录
 * @return string 网站根目录
 */
function cmf_get_root()
{
	$request = Request::instance();
	$root    = $request->root();
	$root    = str_replace('/index.php', '', $root);
	if (defined('APP_NAMESPACE') && APP_NAMESPACE == 'api' )
	{
		$root = preg_replace('/\/api$/', '', $root);
		$root = rtrim($root, '/');
	} 
	return $root;
}

/**
 * 获取系统配置，通用
 * @param string $key 配置键值,都小写
 * @return array
 */

function cmf_get_option($key)
{
	if (!is_string($key) || empty($key)) {
        return [];
    }

    static $cmfGetOption; 
    if (empty($cmfGetOption))
    {
    	$cmfGetOption = [];
    }
    else
    {
    	if (!empty($cmfGetOption[$key])) {
            return $cmfGetOption[$key];
        }
    } 
    $optionValue = cache('cmf_options_' . $key);

    if (empty($optionValue)) { 
    	$optionValue = Db::name('option')->where('option_name', $key)->value('option_value');
    	if (!empty($optionValue)) {
            $optionValue = json_decode($optionValue, true);
            cache('cmf_options_' . $key, $optionValue);
        }

    }

    $cmfGetOption[$key] = $optionValue;

    return $optionValue;
    

}