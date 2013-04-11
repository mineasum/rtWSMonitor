<?php
require "init.php";
$data=array();
$data['config'] = $config;


view('overview.tpl.php',$data);

function pingRedis($addr){
	try{
		$r=new Redis();
		$r->connect( $addr ) ;
		$status= ( $r->ping() == "+PONG" ? true :false );
		$r->close();
		return $status;
	}catch( RedisException $e ) {
	
	}	
	return false;
}

function checkRTWS(){
	$url = "http://192.168.10.155/QuoteService/Hits";	
	$curl=@curl_init();
	@curl_setopt($curl, CURLOPT_URL,$url);
	@curl_setopt($curl,CURLOPT_RETURNTRANSFER,1);
	$ret=@curl_exec($curl);
	return ( $ret ) ? true : false;
}

