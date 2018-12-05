<?php
namespace keenly\component\swoole;

use keenly\base\Singleton;

class table extends \swoole_table{
    
    use Singleton;
    
    const INT    = \swoole_table::TYPE_INT;
    const STRING = \swoole_table::TYPE_STRING;
    const FLOAT  = \swoole_table::TYPE_FLOAT;
    
    
    
    public function __construct($size = 1024){
        return parent::__construct($size);
    }
    
    
    /**
     * 检查是否存在key
     * @param $key
     * @return bool
     */
    function exist($key)
    {
        return  parent::exist($key);
    }
    
    /**
     * 获取key
     * @param $key
     * @return array
     */
    function get($key,$field = NULL)
    {
        return parent::get($key,$field);
    }
    
    /**
     * 设置key
     * @param       $key
     * @param array $array
     * @return bool
     */
    function set($key, array $array)
    {
        return parent::set($key,$array);
    }
    
    /**
     * 删除key
     * @param $key
     * @return bool
     */
    function del($key)
    {
        return parent::del($key);
    }
    
    /**
     * 原子自增操作，可用于整形或浮点型列
     * @param $key
     * @param $column
     * @param $incrby
     * @return bool
     */
    function incr($key, $column, $incrby = 1)
    {
       return parent::incr($key, $column, $incrby);
    }
    
    /**
     * 原子自减操作，可用于整形或浮点型列
     * @param $key
     * @param $column
     * @param $decrby
     */
    function decr($key, $column, $decrby = 1)
    {
        return parent::decr($key, $column, $decrby);
    }
    
    /**
     * 增加字段定义
     * @param     $name
     * @param     $type
     * @param int $len
     */
    function column($name, $type, $len = 4)
    {
        parent::column($name, $type, $len);
        return $this;
    }
    
    /**
     * 创建表，这里会申请操作系统内存
     * @return bool
     */
    function create()
    {
        return parent::create();
    }
    
    /**
     * 返回table中存在的条目数
     */
    function count(){
        return parent::count();
    }
    
}