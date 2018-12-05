k<?php
namespace keenly\component;
use keenly\base\Singleton;

class Di
{
    use Singleton;
    private $container = [];
    
    public function set($key, $obj,...$arg):void
    {
        if(count($arg) == 1 && is_array($arg[0])){
            $arg = $arg[0];
        }
        $this->container[$key] = array(
                "obj"=>$obj,
                "params"=>$arg,
        );
    }
    
    function delete($key):void
    {
        unset($this->container[$key]);
    }
    
    function clear():void
    {
        $this->container = array();
    }
    
    function get($key)
    {
        if(isset($this->container[$key])){
            $result = $this->container[$key];
            if(is_object($result['obj'])){
                return $result['obj'];
            }else if(is_callable($result['obj'])){
                return $this->container[$key]['obj'];
            }else if(is_string($result['obj']) && class_exists($result['obj'])){
                $reflection = new \ReflectionClass ( $result['obj'] );
                $ins =  $reflection->newInstanceArgs ( $result['params'] );
                $this->container[$key]['obj'] = $ins;
                return $this->container[$key]['obj'];
            }else{
                return $result['obj'];
            }
        }else{
            return null;
        }
    }
}