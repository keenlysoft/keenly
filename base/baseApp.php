<?php
/**
 * This file is part of keenly from.
 * @author brain_yang<qiaopi520@qq.com>
 * (c) brain_yang
 * github: https://github.com/keenlysoft/
 * @time 2017年7月27日
 * For the full copyright and license information, please view the LICENSE
 */
namespace keenly\base;

use keenly;
use keenly\config;
/**
 * keenly 
 * @property \keenly\request\request $request The request component. This property is read-only.
 * @author jack_yang <463247339@qq.com>
 *
 */
class baseApp{

    
    public function __construct(){
        keenly::$app = $this;
        return $this;
    }
    
    
    public function _int(){
        
        
    }
    
    
    public function __get($name){
        if(isset($name)){
            $cName = $this->getClass($name);
            return $this->createObject($cName);
        }
    }
    
    
    private function getClass($name){
        $componts = $this->coreComponents();
        return isset($componts[$name])?$componts[$name]:null;
    }
    
    
    private function createObject($name){
        if(class_exists($name["class"])){
           $this->request =  new $name["class"]();
           return $this->request;
        }
        return false;
    }
    
    /**
     * @name loading Class Type of container
     * @return string[][]
     * @author <jack_yang.>
     */
    public function coreComponents()
    {
        return [
            'request' => ['class' => 'keenly\request\request'],
            'config' => ['class' => 'keenly\config']
        ];
    }
    
}