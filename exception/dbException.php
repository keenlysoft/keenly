<?php
/**
 * This file is part of keenly from.
 * @author brain_yang<qiaopi520@qq.com>
 * (c) brain_yang
 * github: https://github.com/keenlysoft/
 * @time 2018年8月27日
 * For the full copyright and license information, please view the LICENSE
 */
namespace keenly\exception;

class dbException extends \Exception{
    
    
    
    function get(){
       return $this->message;
    }
    
    public function getName()
    {
        return 'Invalid Dbguration';
    }
    
    
}