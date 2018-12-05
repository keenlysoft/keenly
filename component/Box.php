<?php
namespace keenly\component;
/**
 * This file is part of keenly from.
 * @author brain_yang<qiaopi520@qq.com>
 * (c) brain_yang
 * github: https://github.com/keenlysoft/
 * @time 2018年8月27日
 * For the full copyright and license information, please view the LICENSE
 */
use keenly\base\Singleton;

class Box{
    
    use Singleton;
    
    private $_container = [];
    
    
    public function add($key,$callable,...$args):bool
    {
        if(is_callable($callable)){
            $this->_container[$key]['func'] = \Closure::bind($callable, $this, get_class());
            $this->_container[$key]['param'] = $args;
            return true;
        }
        return false;
    }
    
    
    public function get($key)
    {
        if(isset($this->_container[$key])){
            return $this->_container[$key];
        }
        return null;
    }
    
    
    public function del($key):bool
    {
        if(isset($this->_container[$key])){
            unset($this->_container[$key]);
            return true;
        }
        return false;
    }
    
    
    public function all():array
    {
        return $this->_container;
    }
    
    
    public function call($key){
        if(isset($this->_container[$key])){
            if(is_array($this->_container[$key]['param'])){
                return call_user_func_array($this->_container[$key]['func'], $this->_container[$key]['param']);
            }else{
                return call_user_func($this->_container[$key]['func'],$this->_container[$key]['param']);
            }
        }
    }
    
    
}