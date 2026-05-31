<?php
namespace keenly\routes;
use keenly\base\Singleton;

/**
 * This file is part of keenly from.
 * @author brain_yang<qiaopi520@qq.com>
 * (c) brain_yang
 * github: https://github.com/keenlysoft/
 * @time 2018年10月27日
 * For the full copyright and license information, please view the LICENSE
 */
class url {
    
    use Singleton;
    
    private $port = 80;
    
    public $web;
    
    public function __construct(){
        $this->web = $this->weburl();
    }
    
    private function weburl(){
       $host = isset($_SERVER['SERVER_NAME'])?$_SERVER['SERVER_NAME']:'localhost';
       if(!preg_match('/^[A-Za-z0-9.-]+$/', $host)){
           $host = 'localhost';
       }
       $serverPort = isset($_SERVER['SERVER_PORT'])?(int)$_SERVER['SERVER_PORT']:$this->port;
       $port = $serverPort == $this->port?"":':'.$serverPort;
       $scheme = (!empty($_SERVER['HTTPS']) && $_SERVER['HTTPS'] !== 'off')?'https':'http';
       $requestUri = isset($_SERVER['REQUEST_URI'])?$_SERVER['REQUEST_URI']:'/';
       return $scheme.'://'.$host.$port.$requestUri;
       
    }
    
    
    
    
}
