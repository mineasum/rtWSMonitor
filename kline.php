<?php


require "init.php";

$key=@$_GET['key'];
$data=array();
if( preg_match( '/^t\.([^.]+)\.tw$/' , $key , $m ) ){
	$data['stockId'] = $m[1];
	$data['akey']="t.1m.".$data['stockId'].".tw";
	$data['datalist']=$redis->zrange($data['akey'],0,-1);
}

view( 'kline.tpl.php' , $data ) ;
