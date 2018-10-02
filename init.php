#!/usr/bin/env php
<?php
use keenly\base\binModel;
use keenly\base\command;
define("DIR",realpath(getcwd()));
require DIR.'/vendor/autoload.php';

function commit_all(){
    list($param,$options)= Calibrate_Mode();
    switch ($param){
        case 'model':
            (new binModel())->CreateModel($options);
            break;
        case 'cli':
            (new command())->line_interface($options);
            break;
        default :
            
            break;
    }
    
}





















function Calibrate_Mode(){
    global $argv;
    $commit = isset($argv['1'])?$argv['1']:false;
    unset($argv['0'],$argv['1']);
    $options = [];
    if(isset($argv['2'])){
        foreach ($argv as $val){
            $options[] = $val;
        }
    }
    return [$commit,$options];
}
commit_all();
