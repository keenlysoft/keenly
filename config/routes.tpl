<?php
use keenly\routes\routes;

routes::api('get',[
    'api'=>'Home@api',
    'iapi'=>'Home@api2',
]);

routes::get('','index@index');
routes::get('home2/i/w','admin@index@home2');
routes::post('t','Home@home');
routes::get('(:all)',false); //All urls are unrestricted
routes::keenly();