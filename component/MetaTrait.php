<?php
namespace keenly\component;

trait MetaTrait
{
    
    private $methods = [];
    
    public function addMethod($methodName, $methodCallable)
    {
        if (!is_callable($methodCallable)) {
            throw new \InvalidArgumentException('Second param must be callable');
        }
        $this->methods[$methodName] = \Closure::bind($methodCallable, $this, get_class());
    }
    
    public function __call($methodName, array $args)
    {
        if (isset($this->methods[$methodName])) {
            return call_user_func_array($this->methods[$methodName], $args);
        }
        
        throw new \RunTimeException('There is no method with the given name to call');
    }
    
}