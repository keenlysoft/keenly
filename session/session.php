<?php
namespace keenly\session;
/**
 * This file is part of keenly from.
 * @author brain_yang<qiaopi520@qq.com>
 * (c) brain_yang
 * github: https://github.com/keenlysoft/
 * @time 2018年8月27日
 * For the full copyright and license information, please view the LICENSE
 */
class session implements \ArrayAccess{
    
    
    private $session ;
    
    private $handler;
    
    protected $name;
    
    public function __construct(){
        session_set_save_handler($this->handler  = new sessionHandler(), true);
        $this->open();
    }
    
    
    
    public function open(){
        if (!$this->IsActive()){
            session_name($this->handler->name);
            session_start();
            $this->session = $_SESSION;
        }
    }
    
    
    
    public function IsActive(){
        return session_status() == PHP_SESSION_ACTIVE;
    }
    
    
    
    public function createId($id = null){
       $this->DelCookie();
       return $this->sid = session_id();
    }
    
    
    public function __set($name, $value)
    {
        $this->open();
        $_SESSION[$name] = $value;
	    return session_write_close();
    }
    
    
    
    public function &__get($offset){
        $this->open();
        return isset($_SESSION[$offset])?$_SESSION[$offset]:null;
    }
    
    
    
    public function __isset($offset){
        $this->open();
        return isset($_SESSION[$offset]);
    }
    
    
    
    public function offsetExists ($offset) {
        $this->open();
        return isset($_SESSION[$offset]);
    }

	/**
	 * @param offset
	 */
	public function offsetGet ($offset) {
	    $this->open();
	    return isset($_SESSION[$offset])?$_SESSION[$offset]:null;
	    
	}

	/**
	 * @param offset
	 * @param value
	 */
	public function offsetSet ($offset, $value) {
	    $_SESSION[$offset] = $value;
	    return session_commit();
	}

	/**
	 * @param offset
	 */
	public function offsetUnset ($offset) {   
	    unset($_SESSION[$offset],$this->session[$offset]);
	    return session_destroy($offset);
	}
    

	public function RestID(){
	    session_regenerate_id();
	    return $this;
	}
    
	
	
	private function DelCookie(){
	   if(isset($_COOKIE[$this->name])){
	       setcookie($_COOKIE[$this->name],'',time()-3600);
	   }
	}
	
    public function setSession($name,$value){
        $_SESSION[$name] = $value;
        session_commit();
    }
	
}