<?php
namespace keenly\view;
/**
 * This file is part of keenly from.
 * @author brain_yang<qiaopi520@qq.com>
 * (c) brain_yang
 * github: https://github.com/keenlysoft/
 * @time 2017年7月25日
 * For the full copyright and license information, please view the LICENSE
 */
use keenly\config;
use keenly\exception\dbException;



class k{
    
    private static $tempEngine;
    private static $config;
    private static $dir;
    private static $param;
    private static $project;
    
    /**
    * k::render('index',[
    *   'name' => 'zhang'
    * ],true,3600)
    * @author brain_yang <qiaopi520@qq.com>
    * @name view
    * @date: 2017年7月25日 下午8:35:21
    * @author: brain_yang
    * @param: $dir is view file
    * @param: $param is array
    * @param: $cache  Cache enabled  defaults to off
    * @param: $ctime  cacheTime
    * @return:
    */
    public static function render($dir, array $param = null,$cache = NULL,$ctime = NULL){
        $trace = debug_backtrace(1);
        self::$param = $param;
        $project = isset($trace['3']['args']['0']['0'])?$trace['3']['args']['0']['0']:'admin';
        self::ReloadConfig($project);
        self::setTemplate();
        self::setCache($cache,$ctime);
        self::setParam();
        self::setView($dir);
    }
    
    
   private static function ReloadConfig($project){
       self::$project  = $project;
       self::$config = config::reload('config')->Get('view',$project);
       if(!self::$config){
           throw new dbException('Routing not configured');
       }
       self::$dir = self::MkBaseDir();
       self::$tempEngine = new \Smarty();
    }
    
    
    
    private static function setTemplate(){
        self::$tempEngine->template_dir = self::$dir.self::$config['template_dir'];
        
    }
    
    
    
    private static function setParam(){
        if(is_array(self::$param) && !empty(self::$param)){
            foreach (self::$param as $name => $variate){
                self::$tempEngine->assign($name,$variate);
            }
            
        }
        return true;  
    }
    
    
    private static function setView($file){
        
        self::$tempEngine->display($file.self::$config['file_postfix']);
    }
    
    
    private static function setCache($cache,$ctime){
        $switch = is_bool($cache)?$cache:self::$config['cache'];
        self::$tempEngine->cache_dir =  self::$dir.self::$config['template_cache'];
        self::$tempEngine->compile_dir =  self::$dir.self::$config['compile_dir'];
        self::$tempEngine->caching = $switch;
        $time = empty($ctime)?self::$config['cache_time']:$ctime;
        self::$tempEngine->setCacheLifetime($time);
    }
    
    
    
    private static function MkBaseDir(){
        $vendorDir = dirname(dirname(__FILE__));
        $baseDir = dirname($vendorDir);
        return dirname(dirname($baseDir)).DIRECTORY_SEPARATOR.self::$project;
    }
    
    
}