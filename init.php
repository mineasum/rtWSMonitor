<?php

$config=array();
$config['redis']['0']['addr']='192.168.10.155:6379';
$config['redis']['0']['title']='master';
$config['redis']['1']['addr']='192.168.10.155:6579';
$config['redis']['1']['title']='slave';

$config['rtws']['host'] = "192.168.10.155";
$config['rtws']['title'] = "開發機";

//method=GetStkByJSON&paras=10200.tw&ptr=-1&limit=15 last 15 rows
//method=GetStockInfoJSON&paras=10200.tw
//method=GetStockInfoQuote&paras=10200.tw
$config['command']='http://192.168.10.155/QuoteService/GetCommand?';
$config['database']=array(
	'usr'=>'root',
	'password' => 'iamroot',
	'db'=>'apex',
	'port'=>3306
);

try{
	$redis=new Redis();
	$redis->connect($config['redis']['0']['addr']);
}catch(Exception $e){
	echo $e->getMessage();
	exit(0);
}


//Global
$global=array();
$global['tdate']=preg_replace( '/\"/' , '' , $redis->get('g.tdate'));

function view( $filename,$data ){
	global $global;
	$tpl_folder='tpl/';
	include $tpl_folder."html_begin.php";
	if(empty($filename)){
	  echo $data;
	}else{
		include $tpl_folder.$filename;
	}
	include $tpl_folder."html_end.php";
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
				'lostInfo' => $lostInfo,
				'cname' => $redis->hget($k,'cname')
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

function htmlStatus($status=false){
	return ( $status ) ? "<img src=\"img/on.png\"/>" : "<img src=\"img/off.png\"/>";	
}
