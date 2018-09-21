# 视图使用

视图封装[smarty](https://github.com/smarty-php/smarty "smarty")配置视图 实例 分别配置admin和index模块 
```
// view config 
    'view' => [
        'admin' =>[ //set admin project
            'file_postfix' => '.html', //静态文件格式
            'template_dir' => '/view/',//模版根目录路径
            'template_cache' => '/cache/',
            'compile_dir' => '/cache/',
            'cache' => false, // false = off ,true = on //缓存是否开启
            'cache_time' => 3600, //second 缓存时间
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
```
## 在控制器中使用
``
     k::render('index',[
       'name' => 'zhang'
    ],true,3600)
``
### 参数
| 参数  |是否必填|  类型|  说明 |
| ------------ |------------ | ------------ | ------------ |
|  1 | 是|string  | 文件路径  |
|  2 | 否|array  | 数组格式参数  |
|  3 | 否|bool  | 是否开启缓存 当前设置优先 config配置  |
|  4 | 否|int  | 缓存时间  秒为单位 |


