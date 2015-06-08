<?php

function get_token($str='',$skey='justAKey'){
	$strArr = str_split(base64_encode($str));
	$strCount = count($strArr);
	foreach(str_split($skey) as $k=>$v){
		$k < $strCount && $strArr[$k] .= $v;
	}
	return str_replace(array('=','+','/'),array('O0O0O','o000o','oo00o'),join('',$strArr));
}

function check_token($token='',$skey='justAKey'){
	$strArr = str_split(str_replace(array('O0O0O','o000o','oo00o'), array('=','+','/'), $token),2);
	$strCount = count($strArr);
	foreach(str_split($skey) as $k=>$v){
		$k <= $strCount && $strArr[$k][1] === $v && $strArr[$k] = $strArr[$k][0];
	}
	return base64_decode(join('',$strArr));
}

function check_email($email){
    $email = strtolower($email);
	$reg = '/^([a-zA-Z0-9]+[_|\_|\.]?)*[a-zA-Z0-9]+@([a-zA-Z0-9]+[_|\_|\.]?)*[a-zA-Z0-9]+\.[a-zA-Z]{2,3}$/';
    $res = preg_match($reg,$email);
    return $res;
}

function check_password($password){
    $reg = '/(?!^\\d+$)(?!^[a-zA-Z]+$).{6,16}/';
    $res = preg_match($reg,$password);
    return $res;
}

function md5_password($password){
    return md5('KStart'.$password);
}

function check_username($username){
    $reg = '/^[0-9a-zA-Z_\x{4e00}-\x{9fa5}]{2,16}$/u';
    $res = preg_match($reg,$username);
    return $res;
}

function http_status($ds){
	$code = '';
	$message = '';
	switch ($ds) {
		case 200:
			$code = 200;
			$message = 'ok';
			break;
		case 201:
			$code = 201; //用户新建或修改数据成功
			$message = 'created';
			break;
		case 204:
			$code = 204; //用户删除数据成功
			$message = 'no content';
		case 304:
			$code = 304; //HTTP缓存有效
			$message = 'not modified';
			break;
		case 400: //用户发出的请求有错误，服务器没有进行新建或者修改数据的操作
			$code = 400;
			$message = 'bad request';
			break;
		case 401: //未授权
			$code = 401;
			$message = 'unauthorized';
			break;
		case 403: //鉴定权限成功，但是该用户没有权限
			$code = 403;
			$message = 'forbidden';
			break;
		case 404:
			$code = 404;
			$message = 'not found';
			break;
		case 405:
			$code = 405;
			$message = 'method not allowed';
			break;
		case 410:
			$code = 410;
			$message = 'gone';
			break;
		case 415: //请求类型错误
			$code = 415;
			$message = 'unsupported media type';
			break;
		case 422:
			$code = 422;
			$message = 'unprocessable entity';
			break;
		case 429: //请求过多
			$code = 429;
			$message = 'too many request';
			break;
		default:
			$code = 500; // 服务器发生错误，用户将无法判断发出的请求是否成功
			$message = 'internal server error';
			break;
	}
	return array('code'=>$code,'message'=>$message);
}
