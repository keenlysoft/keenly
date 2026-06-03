<?php
namespace  keenly\session;
/**
 * This file is part of keenly from.
 * @author brain_yang<qiaopi520@qq.com>
 * (c) brain_yang
 * github: https://github.com/keenlysoft/
 * @time 2018年8月27日
 * For the full copyright and license information, please view the LICENSE
 */
use keenly\common;
use keenly\config;
use database;

class sessionHandler  extends \SessionHandler {
    
    use common;
    
    private $key;
    
    public $name;
    

    public function __construct()
    {
        $session = config::reload('session')->Get();
        if($session['save_state']){
            ini_set("session.save_handler", $session['save_handler']);
            ini_set("session.save_path", $session['save_path']);
        }
        
        $this->key = isset($session['key'])?$session['key']:'';
        $this->name = $session['session_n'];
        $this->setSession($session);
    }

    /* public function read($id)
    {
        return $data = parent::read($id);
        if (!$data) {
            return "";
        } else {
            return $this->decrypt($data, $this->key);
        }
    }

    
    public function write($id, $data)
    {
        //$data = $this->encrypt($data, $this->key);
        return parent::write($id, $data);
    } */
    
   
    
    
    
    private function setSession($C){
        session_set_cookie_params([
            'lifetime' => $C['session_indate'],
            'path' => $C['session_path'],
            'domain' => $C['session_domain'],
            'secure' => $C['http_session_secure'],
            'httponly' => $C['session_httponly'],
            'samesite' => isset($C['session_samesite']) ? $C['session_samesite'] : 'Lax',
        ]);
    }
    
    
    
    
    
}
