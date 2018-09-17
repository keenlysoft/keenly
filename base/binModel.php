<?php
namespace keenly\base;
/**
 * This file is part of keenly from.
 * @author brain_yang<qiaopi520@qq.com>
 * (c) brain_yang
 * github: https://github.com/keenlysoft/
 * @time 2018年7月20日
 * For the full copyright and license information, please view the LICENSE
 */
use database\models;
use keenly\config;
define("KEENLY_CLI_DS", realpath(dirname(dirname(dirname(dirname(dirname(__FILE__)))))));

class binModel extends models{
    
    private $tplModel;
    
    private $Tpl;
    
    private $prefix;
    
    private $tables = [];
    
    
    public function CreateModel($parame = NULL){
        if(empty($parame)){
            $this->CreateAllModel();
        }else{
            $this->CreateOneModel($parame);
        }
    }
    
    
    
    public function CreateAllModel(){
        $this->tables = $this->GetTableName();
        if(is_array($this->tables) && !empty($this->tables)){
            foreach ($this->tables as $table){
                $this->CreateOneModel($table);
                
            }
        }
    }
    
    
    public function CreateOneModel($parame = NULL){
        if(empty($this->tables)){
            $this->tables = $this->GetTableName();
        }
        if(is_array($parame) && isset($parame['0'])){
            if(strtolower($parame['0']) == '-f' && isset($parame['1'])){
                $this->CrateTable($parame['1']);
            }
        }elseif (isset($parame)){
            
            $this->CrateTable($parame);
        }
    }
    
    
    
    private function CrateTable($Tables){
        $Table = $this->TableName($Tables);
        
        $this->writeFile($Table['cName'],$Table['tName'],false);
    }
    
    
    
    
    
    private function TableName($tbname){
        $tName = $this->wipePrefix($tbname);
        if(!in_array($tName,$this->tables)){
           exit('Error:Database tables do not exist'.PHP_EOL); 
        }
         return [
            'tName' => strtolower($tName),
            'cName' => ucfirst($tName),
         ];
    }
    
    
    
    private function writeFile($className,$tableName,$status = TRUE){
        $file_path = KEENLY_CLI_DS.DIRECTORY_SEPARATOR.'models'.DIRECTORY_SEPARATOR.$className.'.php';
        $this->ModelTpl($className,$tableName);
        if (!file_exists($file_path) && $status){
            file_put_contents($file_path, $this->Tpl);
            $status = true;
        }elseif (!$status){
            file_put_contents($file_path, $this->Tpl);
            $status = true;
        }else{
            $status = false;
        }
        $this->showModelTip($tableName,$status);
    }
    
    
    
    private function showModelTip($table,$status){
        echo 'generative:'.$table.'  '.($status?'succeed':'exist').PHP_EOL;
    }
    
    
    private function wipePrefix($table){
        return str_replace($this->prefix, "", $table);
    }
    
    
    
    private function GetTableName(){
        $res = $this->query("SHOW TABLES")->all();
        $res = array_column($res, 'Tables_in_keenly');
        $this->prefix = $this->dbh->dh->db['prefix'];
        return $res;
    }
    
    
    
    
    private function disposePrefix(){
        config::reload('database')->Get('mysql');
        return config::reload('database')->Get('mysql');
    }
    
    
    
    
    private function ModelTpl($className,$tableName){
        $this->Tpl =  <<<'ModelTpl'
<?php
namespace models;
use database\models;
/**
 * This file is part of keenly from Model ::tableClass .
 * @author keenly model Generate 
 * (c) keenly soft 
 * github: https://github.com/keenlysoft/
 * @time ::time
 * For the full copyright and license information, please view the LICENSE
 */
class ::tableClass extends models{
    protected $table = '::table';
}
ModelTpl;
        $this->Tpl = str_replace(
                array('::tableClass', '::table','::time'),
                array($className, $tableName,date("Y-m-d H:i:s",time())), 
                $this->Tpl);
    }
    
    
    
    
}