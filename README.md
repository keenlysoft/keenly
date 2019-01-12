# 安装
使用Composer来安装keenly框架
### composer源使用
`
composer config  repo.packagist composer https://packagist.laravel-china.org
`
### 创建项目
`
composer create-project keenlysoft/app keenly
`
### nginx配置
```
server{
           listen 80;
           #access_log  /usr/local/keenly.log;
           #error_log /usr/local/nginx/logs/keenly_error.log;
           server_name  keenly.com;
           index index.html index.htm index.php;
           root /keenly/web;
           location / {
                try_files $uri $uri/ /index.php?$query_string;
           }
           location ~* ^/protected/views/.*\.(php|php5)$
           {
             deny all;
           }
           location ~ [^/]\.php(/|$)
           {
             try_files $uri =404;
             fastcgi_pass  unix:/dev/shm/php-cgi.sock;
             fastcgi_index index.php;
             include fastcgi.conf;
           }
           location ~ .*\.(gif|jpg|jpeg|png|bmp|swf|flv|ico)$ {
             add_header Cache-Control 'no-store';
           }
}
```


* 注意 fastcgi_pass 请更换自己服务器环境正确地址；

* Web.config 写iis配置文件 service 2008

## 生成 model
在网站更目录使用
```
php keenly model #生成全部
php keenly model user #生成某一个
php keenly model -f user  #强制生成

```
## cli模式运行
php keenly cli admin@index@index 参数1 参数2
说明：admin@index@index === 项目@控制类名称@方法 参数可选
## redis 连接
### config/database.php 配置设置
```
'redis' =>[
           'driver'    => 'pconnect', //or connect redis attended mode 
           'host'      => '127.0.0.1',
           'port'      => '6379',
           'password'  => '1234567',
           'selectDB'  => '0',  //默认数据库
           'timeout'   => '1',  //超时秒
           'rebinding' => '100' //重连机制
     ],
```

```
use keenly;
keenly::$box->redis->set();
// use() 设置数据库
redis::I()->use('0')->set();
```
## 分页
```
/**
 *pagination()
 *参数1：总条数
 *参数2：当前页码
 *参数3：每页条数
 */
  $pag = new pagination($user->Count(), $page,2);
  $list = $user->limit($pag->limit)->offset($pag->offset)->all();
  $pag->page() //视图分页HTML
  //全部实例：
  $user = User::find()->where('id > 0');
        $pag = new pagination($user->Count(), $page,2);
        $list = $user->limit($pag->limit)->offset($pag->offset)->all();
        k::render('test',[
                'list'=>$list,
                'page'=>$pag->page()  
        ]);
   //view页码
   {$page}
```


## [路由配置](https://github.com/keenlysoft/keenly/blob/master/doc/routes.md "路由配置")
## [视图使用](https://github.com/keenlysoft/keenly/blob/master/VIEW.md "视图使用")
## [数据库使用](https://github.com/keenlysoft/database "数据库使用")
