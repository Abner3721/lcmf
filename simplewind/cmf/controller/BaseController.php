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
namespace cmf\controller;

use think\Controller;
use think\Request;
use think\View;
use think\Config;

class BaseController extends Controller
{
    /**
     * 构造函数
     * @param Request $request Request对象
     * @access public
     */
    public function __construct(Request $request = null)
    {
        
        if (!cmf_is_installed() && $request->module() != 'install') { 
            header('Location: ' . cmf_get_root() . '/?s=install');
            exit;
        }

        if (is_null($request)) {
            $request = Request::instance();
        }

        $this->request = $request;
        $this->_initializeView();   
        $this->view = View::instance(Config::get('template'), Config::get('view_replace_str'));
        
        // 控制器初始化
        $this->_initialize();


        
        

        
    }


   

 


}