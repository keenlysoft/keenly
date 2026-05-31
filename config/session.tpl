<?php
return [
	    'key' => '', // Generate a unique secret for each deployed application.
    
    'session_status' => TRUE,
    'session_n' => 'studious_name',//session name
	    'save_state' => false, // Enable when a custom session handler is configured.
	    'save_handler'=> 'files', // or redis
	    'save_path' => sys_get_temp_dir(),
    'session_path' => '/',
    'session_domain' => '', //默认当前域名
    'session_indate' => 72*3600,
    'http_session_secure' => false, //ture = https,flase = http,
    'session_httponly' => TRUE,
];
