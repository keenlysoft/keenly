<?php
return [
    'key' => 'fYV5ax93ET.76QgJL3E34Lr49vTtY333',
    
    'session_status' => TRUE,
    'session_n' => 'studious_name',//session name
    'save_state' => true, //redis储存 路径 
    'save_handler'=> 'redis',// or file
    'save_path' =>'tcp://192.168.20.153:6379?auth=',// or /temp
    'session_path' => '/',
    'session_domain' => '', //默认当前域名
    'session_indate' => 72*3600,
    'http_session_secure' => false, //ture = https,flase = http,
    'session_httponly' => TRUE,
];