<?php

require "init.php";

$key=$_GET['key'];

$datalist=$redis->zrange($key,0,-1);
$path=preg_replace( '/t\.([^.]+)\.(.+)$/' , "info.$1.$2" , $key);
$data['id']=$key;
$data['cname']=$redis->hget($path,'cname');
$data['datalist']=$datalist;

view( 'tick.tpl.php' , $data ) ;
