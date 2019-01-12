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
        
       $port = $_SERVER['SERVER_PORT'] == $this->port?"":':'.$_SERVER['SERVER_PORT'];
       return $_SERVER['REQUEST_SCHEME'].'://'.$_SERVER['HTTP_HOST'].$port.$_SERVER["REQUEST_URI"];
       
    }
    
    
    
    
}