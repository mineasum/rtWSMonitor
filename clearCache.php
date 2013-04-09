<?php

require "init.php";
$keys=$redis->keys('t.*.tw');
foreach ( $keys as $k ) {
	if ( preg_match( '/t\.\dm.([^.]+)\.tw/' , $k , $m ) ){
		echo "$k\n";
		$redis->delete( $k ) ;
	}
}
$redis->save();
$data=array();

view('','Success');




