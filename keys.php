<?php

require "init.php";

$key=@$_GET['key'];
$empty= @$_GET['empty'];
$lost= @$_GET['lost'];

$data['datalist']=getTickDataList($redis,$key,$empty,$lost);
$redis->close();
view( 'keys.tpl.php' , $data );


