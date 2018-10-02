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
          
     ],

];