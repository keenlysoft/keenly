<?php
return [
    'debug' => true, // debug 开启状态
    'api' =>[
        'api' => true,
    ],
    // view config 
    'view' => [
        'admin' =>[ //set admin project
            'file_postfix' => '.html',
            'template_dir' => '/view/',
            'template_cache' => '/cache/',
            'compile_dir' => '/cache/',
            'cache' => false, // false = off ,true = on
            'cache_time' => 3600, //second
        ],
        'index' =>[
            'file_postfix' => '.html',
            'template_dir' => '/view/',
            'template_cache' => '/cache/',
            'compile_dir' => '/cache/',
            'cache' => false, // false = off ,true = on
            'cache_time' => 3600, //second
        ],
    ],
    //routes config
    'routes' =>[
        'default_index' =>'index',
        'routesName'  => 'controllers',
        'routesClass' => 'Controller',
    ],
    
];