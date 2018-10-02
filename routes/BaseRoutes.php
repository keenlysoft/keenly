<?php
namespace keenly\routes;

use keenly\config;
use keenly\base\baseApp;
/**
 * This file is part of keenly from.
 * @author brain_yang<qiaopi520@qq.com>
 * (c) brain_yang
 * github: https://github.com/keenlysoft/
 * @time 2018年8月27日
 * For the full copyright and license information, please view the LICENSE
 */
class BaseRoutes{
    
    
    public static  $C;
    
    

    public static  function set_error_Model(){
       baseApp::I()->_int();
       self::$C = config::reload('config')->Get();
       if(self::$C['debug']){
            error_reporting(-1);
            ini_set('error_reporting', E_ALL);
        }else{
             error_reporting(0);
        }
    }
    
}