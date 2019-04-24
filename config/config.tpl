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
    'security' =>[
    	'fontsize' => 6,
    	
    ],
     // 自定义类的加载
    // 需要使用  use Singleton; 单利模式加载
    // keenly::$app->xxxy->fun();
    'used_ioc' =>[
        //'xxxy' => ['class' => 'keenly\config']
    ],
];