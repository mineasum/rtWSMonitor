<?php

require "init.php";
$data=array();

$node=$_GET['node'];
if( $node=='kv.master' ){
	$data['info']= $redis->info();
}else if( $node=='kv.slave'){
	$redis_slave=new Redis();
	$redis_slave->connect('192.168.10.155:6579');
	$data['info'] = $redis_slave->info();
}

view( "kv_status.tpl.php" , $data );
