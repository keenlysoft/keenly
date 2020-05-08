<?php
namespace keenly\component\swoole;

class Http
{
    
    public $request;
    
    
    public $response;
    
    
    function run()
    {
        $http = new \Swoole\Http\Server("127.0.0.1", 9501);
        $http->on('request', function ($request, $response) {
            var_dump($request);
            $response->end($request);
        });
        $http->start();
    }
    
    
    
}