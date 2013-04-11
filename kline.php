<?php


require "init.php";

$key=@$_GET['key'];
$type=@$_GET['type'];
$data=array();

if( preg_match( '/^t\.([^.]+)\.tw$/' , $key , $m ) ){
	$data['stockId'] = $m[1];
 	if( $type == '1M' )	
		$data['akey']="t.1m.".$data['stockId'].".tw";
	else if( $type == '5M' )
		$data['akey']="k.5m.".$data['stockId'].".tw";
	else if( $type == 'D' )
		$data['akey']="k.d.".$data['stockId'].".tw";
	else if( $type == 'M' )
		$data['akey']="k.m.".$data['stockId'].".tw";
	else if( $type == 'W' )
		$data['akey']="k.w.".$data['stockId'].".tw";
	$data['datalist']=$redis->zrange($data['akey'],0,-1);
}

view( 'kline.tpl.php' , $data ) ;
