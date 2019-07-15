<?php
namespace keenly\base;



class command{
    
    
   public function line_interface($param){
        baseApp::I()->_int(); //add init baseApp  keenly::$box;
        $env = isset($param['0'])?explode("@", $param['0']):0;
        unset($param['0']);
        if(count($env) == 3){
            $envZero = $env['0'];
            $envOne  =  $env['1'];
            $controller = "{$envZero}\controllers\\{$envOne}Controller";
            $handler = [$controller,$env['2']];
            if(class_exists($controller)){
                $roller = new $controller;
                $par = isset($param) && is_array($param) ? 
                array_values($param):
                [];
                call_user_func_array([$roller,$env['2']],$par);
            }
            
        }
    }
    
    
    
    
    public function start($param){
        switch ($param){
            case 'rpc':
                
                break;
            default :
                
                break;
        }
    }
    
    
    
    
    
    
    
    
    
    
}
