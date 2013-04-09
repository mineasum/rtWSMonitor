<?php

$config=array();
$config['redis']='192.168.10.155:6379';
$config['redis_slave']='192.168.10.155:6579';
//method=GetStkByJSON&paras=10200.tw&ptr=-1&limit=15 last 15 rows
//method=GetStockInfoJSON&paras=10200.tw
//method=GetStockInfoQuote&paras=10200.tw
$config['command']='http://192.168.10.155/QuoteService/GetCommand?';
$config['db']=array(
	'usr'=>'root',
	'password' => 'iamroot'
);

try{
	$redis=new Redis();
	$redis->connect($config['redis']);
}catch(Exception $e){
	echo $e->getMessage();
	exit(0);
}
function view( $filename,$data ){
	include "html_begin.php";
	if(empty($filename)){
	  echo $data;
	}else{
		include "tpl/".$filename;
	}
	include "html_end.php";
}
function getTickDataList( $redis , $key , $empty , $lost ){
	$keys=$redis->keys("info.*$key*.tw");
	$data=array();
	$datalist=array();
	$data['tdate']=$redis->get('g_tdate');
	foreach( $keys as $k ){
		if( preg_match( '/^info\.([^.]*)\.tw$/' , $k , $m ) ){
			$path='t.'.$m[1].'.tw';
			$ret=$redis->zrange($path,0,-1) ;
			$tot=count($ret);
			//Option tick empty
			if( $empty ){
				if( $tot > 0 ) 	continue;
			}
			//Option ptr lost
			$lostInfo=lostPtr($ret);
			if( $lost ) {
				if(count($lostInfo[2])==0)continue;		
			}
			$datalist[$path] = array( 
				'lostInfo' => $lostInfo
			);
		}
	}
	ksort($datalist);
	return $datalist;
}


function lostPtr($arr){
	$lost=array();
	$t=array();
	$last=-1;
	sort($arr);
	$tot=count($arr);
	foreach ( $arr as $text ) {
					$pairs=explode( '|' , $text , 2 );
					$ptr=$pairs[0]+0;
					$t[$ptr]=1;
					$last=$ptr;
	}
	for($i=0;$i<=$last;$i++){
		if( !array_key_exists($i,$t) ){
			$lost[]=$i;
		}
	}
	$tiny_lost=bindLost($lost);
	return array( $last , $tot, $lost ,$tiny_lost) ;
}

function bindLost($lost){
	$temp=array();	
	$last=-1;
	$p=null;
	$idx=0;
	foreach( $lost as $v ) {
			if( ($last != -1) && ($last+1) == $v ) {
			}else{
				$temp[$idx]=array();
				$p=&$temp[$idx];	
				$idx++;
			}
			$p[]=$v;
			$last=$v;
	}
	$ret = array();
	foreach( $temp as $v ) {
		$tot=count($v);
		if( $tot > 1 ) {
			$ret[]=$v[0].'-'.$v[$tot-1];
		}else{
			$ret[]=$v[0];
		}
	}
	return $ret;
}
