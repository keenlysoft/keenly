<?php
/**
 * This file is part of keenly from.
 * @author brain_yang<qiaopi520@qq.com>
 * (c) brain_yang
 * github: https://github.com/keenlysoft/
 * @time 2018年5月27日
 * For the full copyright and license information, please view the LICENSE
 */
namespace keenly\routes;


use keenly\view\k;
/**
 * @name   keenly is php Frame
 * @method static get(['api'=>'home@api','getname'=>'home@getname']);
 * @method static post(['api'=>'home@api','getname'=>'home@getname']);
 * @method static api('request'['api'=>'home@api']);
 * @author jack_yang
 * @link
 *
 */
class routes extends BaseRoutes{
    
    const req = 'API';
    
    const HTTP_Method = [
            'GET',
            'HEAD',
            'POST',
            'PUT',
            'DELETE',
            'CONNECT',
            'OPTIONS',
            'TRACE',
            'API'
    ];
    
    
    private static  $Rule = [];
    
    private static $Uri = [];
    
    private static $funcback = [];
    
    private static $PathParams = [];
    
    private static $Ruri;
    
    private static $Rmethod;
    
    
    
    
    public static function  __callstatic($method,$params){
        self::set_error_Model();
        if(strtoupper($method) == self::req){
            
            
        }else{
            $Rule = $method;
            $uri = strpos($params[0], DIRECTORY_SEPARATOR) === 0 ? $params[0] : DIRECTORY_SEPARATOR . $params[0];
            self::$PathParams[$uri][] = $params[1];
            $funcback = $params['1'];
            array_push(self::$PathParams[$uri], $method);
            array_push(self::$Rule, $Rule);
            array_push(self::$Uri, $uri);
            array_push(self::$funcback, $funcback);
        }
        
    }
    
    
    
    public  static  function  keenly(){
        self::$Ruri = parse_url($_SERVER['REQUEST_URI'],PHP_URL_PATH);
        self::$Rmethod = $_SERVER['REQUEST_METHOD'];
        self::RequestValidation(self::$Rmethod,self::$Ruri);
        if(in_array(strtolower(self::$Rmethod), self::$Rule) && in_array(strtoupper(self::$Rmethod), self::HTTP_Method)){
            if(in_array(strtolower(self::$Ruri), self::$Uri)){
                if(strpos(self::$PathParams[self::$Ruri]['0'], '@')){
                    $path = explode('@', self::$PathParams[self::$Ruri]['0']);
                    self::InstancePath($path);
                    return ;
                }
            }else{
                self::allRule();
                return ;
            }
        }
        self::error();
    }
    
    
    //@todo view web
    private static  function error(){
        header($_SERVER['SERVER_PROTOCOL']." 404 Not Found");
        k::render('404');
    }
    //
    private static function allRule(){
        if(in_array("/(:all)",self::$Uri)){
            $pathurl = mb_substr(self::$Ruri, 1);
            //if(strpos($pathurl,DIRECTORY_SEPARATOR)){
            $pathMethod = explode(DIRECTORY_SEPARATOR, $pathurl);
            self::InstancePath($pathMethod);
            return ;
            //}
        }
        self::error();
    }
    
    
    private static  function InstancePath($path){
        $c = self::$C['routes'];
        if(count($path) > 2 ){
            $class = $path['0'].'\\'.$c['routesName'].'\\'.$path['1'].$c['routesClass'];
            $fun = $path['2'];
        }else{
            $routesClass = (DIRECTORY_SEPARATOR == self::$Ruri)?
            $c['default_index'].'\\'.$c['routesName'].'\\'.$path['0'].$c['routesClass']:
            $c['default_index'].'\\'. $c['routesName'].'\\'.$path['0'].$c['routesClass'];//The default judgment index
            $class = $routesClass;
            $fun = empty($path['1'])?$c['default_index']:$path['1'];
        }
        self::call_fun($class, $fun);
    }
    
    private static  function call_fun($class,$fun){
        
        if(!class_exists($class)) {
            echo "controller not class ". $class;
            return ;
        }
        
        $control = new $class();
        if (!method_exists($control, $fun)) {
            echo "controller and action not found";
            return ;
        } else {
            $control->$fun();
            return ;
        }
    }
    
    /**
     * @name func
     *
     * @param unknown $method
     * @param unknown $uri
     */
    private static function RequestValidation($method,$uri){
        if(strtolower($method) != (isset(self::$PathParams[$uri])?self::$PathParams[$uri]['1']:strtolower($method))){
            header($_SERVER['SERVER_PROTOCOL']." 404 Not Found");
            die("Request mode error");
        }
    }
    
    
}