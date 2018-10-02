<?php
namespace keenly\request;
use keenly\base\Singleton;

/**
 * This file is part of keenly from.
 * @author brain_yang<qiaopi520@qq.com>
 * (c) brain_yang
 * github: https://github.com/keenlysoft/
 * @time 2018年4月27日
 * For the full copyright and license information, please view the LICENSE
 */
class request{
    
    use Singleton;
    
    private $_bodyParams;
    
    private $_queryParams;
    
    public $methodParam = '_method';
    
    public  $_rawBody;
    
    
    public function post($name = NULL,$defaultValue = null){
        if ($name === null) {
            return $this->getBodyParams();
        } else {
            return $this->getBodyParam($name, $defaultValue);
        }
    }
    
    
    public function get($name = null, $defaultValue = null)
    {
        if ($name === null) {
            return $this->getQueryParams();
        } else {
            return $this->getQueryParam($name, $defaultValue);
        }
    }
    
    
    public function getQueryParam($name, $defaultValue = null)
    {
        $params = $this->getQueryParams();
        
        return isset($params[$name]) ? $params[$name] : $defaultValue;
    }
    
    
    
    public function getQueryParams()
    {
        if ($this->_queryParams === null) {
            return $_GET;
        }
        
        return $this->_queryParams;
    }
    
    
    
    public function getBodyParam($name, $defaultValue = null)
    {
        $params = $this->getBodyParams();
    
        return isset($params[$name]) ? $params[$name] : $defaultValue;
    }
    
 
    
    
    public function getBodyParams()
    {
        if ($this->_bodyParams === null) {
            if (isset($_POST[$this->methodParam])) {
                $this->_bodyParams = $_POST;
                unset($this->_bodyParams[$this->methodParam]);
                return $this->_bodyParams;
            }
            $rawContentType = $this->getContentType();
            if (($pos = strpos($rawContentType, ';')) !== false) {
                // e.g. application/json; charset=UTF-8
                $contentType = substr($rawContentType, 0, $pos);
            } else {
                $contentType = $rawContentType;
            }
            if ($this->getMethod() === 'POST') {
                //todo 
                $this->_bodyParams = $_POST;
            } else {
                $this->_bodyParams = [];
                mb_parse_str($this->getRawBody(), $this->_bodyParams);
            }
        }
    
        return $this->_bodyParams;
    }
    
    
    
    
    public function getMethod()
    {
        if (isset($_POST[$this->methodParam])) {
            return strtoupper($_POST[$this->methodParam]);
        }
    
        if (isset($_SERVER['HTTP_X_HTTP_METHOD_OVERRIDE'])) {
            return strtoupper($_SERVER['HTTP_X_HTTP_METHOD_OVERRIDE']);
        }
    
        if (isset($_SERVER['REQUEST_METHOD'])) {
            return strtoupper($_SERVER['REQUEST_METHOD']);
        }
    
        return 'GET';
    }
    

    
    public function getContentType()
    {
        if (isset($_SERVER['CONTENT_TYPE'])) {
            return $_SERVER['CONTENT_TYPE'];
        } elseif (isset($_SERVER['HTTP_CONTENT_TYPE'])) {
            return $_SERVER['HTTP_CONTENT_TYPE'];
        }
        return null;
    }
    
    
    
    
    
    public function getRawBody()
    {
        if ($this->_rawBody === null) {
            $this->_rawBody = file_get_contents('php://input');
        }
    
        return $this->_rawBody;
    }
}