<?php
return [
      'mysql' =>[
          'separation' => true,//读写分离  写主 读从
          'fields_strict'   => false,//严格检查字段
          'persistenet' =>  true,//长连接
          
          'clusters'=>[
              'master'=>[ //主库
                  'driver'    => 'mysql',
                  'host'      => 'localhost',
                  'dbname'  => 'keenly',
                  'username'  => 'root',
                  'password'  => '123456',
                  'charset'   => 'utf8',
                  'collation' => 'utf8_general_ci',
                  'prefix'    => '',
               ],
              'vice-'=>[ //从
                  'driver'    => 'mysql',
                  'host'      => 'localhost',
                  'dbname'  => 'keenly',
                  'username'  => 'root',
                  'password'  => '123456',
                  'charset'   => 'utf8',
                  'collation' => 'utf8_general_ci',
                  'prefix'    => '',
              ],
          ]
      ],
     'redis' =>[
        'driver'    => 'pconnect', //or connect redis attended mode 
        'host'      => '127.0.0.1',
        'port'      => '6379',
        'password'  => '1234567',
        'selectDB'  => '0', //默认数据库
        'timeout'   => '1',
        'rebinding' => '100'
     ],

];