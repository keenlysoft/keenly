<?php
namespace keenly;
/**
 * This file is part of keenly from.
 * @author brain_yang<qiaopi520@qq.com>
 * (c) brain_yang
 * github: https://github.com/keenlysoft/
 * @time 2018年6月27日
 * For the full copyright and license information, please view the LICENSE
 */
class config {
    
    private static $rangePath = '../config/';
    
    private static $format = 'php';
    
    private static $name;
    
    protected static $config;
    
    private static $instance;
    
    private static $defule = 'database';
    
    public function Get($name = null,$value = null){
        if(!isset($name)) return  self::$config;
        return  isset($value)?self::$config[$name][$value]:self::$config[$name];
    }
    
    
    
    public static function reload($file,$rangePath = null){
        if(!empty($rangePath)){
            self::$rangePath = $rangePath;
        }
        $file = self::$rangePath.$file.'.'.self::$format;
        $name = strtolower($file);
        $type = pathinfo($file, PATHINFO_EXTENSION);
        if(self::$format == $type)
        return self::set(include $file);  
    }
    
    
    
    
   private static function set($config){
        self::$config = $config;
        if(!isset(self::$instance)){
            self::$instance = new static();
        }
        return self::$instance;
    }
    
    
}