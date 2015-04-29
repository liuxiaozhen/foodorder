<?php
ini_set('display_errors', 1);
error_reporting(E_ERROR);
date_default_timezone_set('Asia/Chongqing');
function check_cgi_var($var){
	return strip_tags(trim(urldecode($var)));	
}
$name = check_cgi_var($_GET['name']);
$phone = check_cgi_var($_GET['phone']);
$message = check_cgi_var($_GET['message']);
$name_arr = explode(" ", $name);
foreach($name_arr as $k=>$each){
	if($each == ''){
		unset($name_arr[$k]);
	}
}
$res['num'] =  count($name_arr);
$redis = new redis;
$prekey = 'tigerjoys_food_'.date("Ymd");
try{
	$redis->connect('127.0.0.1', 6379);
	foreach($name_arr as $eachname){
		$redis->hset($prekey, $eachname, json_encode(array('name'=>$eachname, 'phone'=>$phone, 'message'=>$message)));
	}	
}catch(Exception $e){
	$res['num'] = 0;
}
echo json_encode($res);
exit;
?>
