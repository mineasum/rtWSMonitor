<?php
require 'init.php';
require 'class.phpmailer.php';

$emptyStockList=getTickDataList($redis,'',1,0);
$emptyReport = "[Tick無資料]\n";
foreach( $emptyStockList as $k=>$empty ) {
	$emptyReport .=$k."\n";
}

$lostStockList=getTickDataList($redis,'',0,1);
$lostReport="[Tick不完整]\n";
foreach( $lostStockList as $k=>$info ){
	$lostReport .= $k.' '.count($info['lostInfo'][2])."\n";
}

$notifyList=json_decode(file_get_contents('notify.list'),true); 


$userMail="apex.rtws@gmail.com";
$userName="rtws";
$userPassword="rtws@apex";

foreach( $notifyList as $user ){
	$mail=new PHPMailer();
	$mail->IsSMTP();
	$mail->Host='smtp.gmail.com';
	$mail->SMTPAuth=true;
	$mail->Username=$userMail;
	$mail->Password=$userPassword;
	$mail->SMTPSecure='tls';
	$mail->From=$userMail;
	$mail->FromName=$userName;
	$mail->Subject='rtWS '.date('Y-m-d H:i:s'). ' check';
	$mail->Body.=date('Y-m-d H:i:s')."\n";
	$mail->Body.=$emptyReport;
	$mail->Body.=$lostReport;
	$mail->AddAddress($user['email'],$user['email']);
	echo $user['email'],' ',$user['flag'].' ',($user['flag'] &&$mail->Send() )?"Send success":"Send fail","\n";
}
