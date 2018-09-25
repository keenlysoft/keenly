# 配置路径  
### 路径： 
/config/routes.php
```
routes::get('','index@index');#为空主页
routes::get('home2/i/w','admin@index@home2');
```
访问 url/home2/i/w 路径到 admin@index@home2 控制器
### 路径请求方式
```
get or post 两种方式路由请求
```
### 按目录结构访问
```
routes::get('(:all)',false); //All urls are unrestricted 
```

**注意如果不添加 请求全部按照 post或get请求方法；
