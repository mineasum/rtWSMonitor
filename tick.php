<?php

require "init.php";

$key=$_GET['key'];

$datalist=$redis->zrange($key,0,-1);

$data['datalist']=$datalist;

view( 'tick.tpl.php' , $data ) ;
