<?php
namespace keenly\base;
/**
 * This file is part of keenly from.
 * @author brain_yang<qiaopi520@qq.com>
 * (c) brain_yang
 * github: https://github.com/keenlysoft/
 * @time 2018年2月21日
 * For the full copyright and license information, please view the LICENSE
 */
trait Singleton{
    
    
    private static $instance;
    
    static function I(...$args)
    {
        if(!isset(self::$instance)){
            self::$instance = new static(...$args);
        }
        return self::$instance;
    }
    
    
}