<?php
require "init.php";
$data=array();
$text=file_get_contents('notify.list');
$list=(array)json_decode($text,true);
$data['datalist']=$list;
view( 'notify.tpl.php' , $data ) ;
