<?php
/*
* 方法整理
*
* liuxinyue 2016/08/26
*/


/*
* 开启session
*/
function sessionstart($session){
	session_id($session);
	session_start();
}


/*
* 防止sql注入
*/
function html_strips_trim($str){
	$str = htmlspecialchars(stripslashes(trim($str)));
	$str = preg_replace('/[\'"<>;%&=\(\)\+\*\[\]\t\f\n\r]+/','',$str);
	return $str;
}


/*
* 跨域
*/
function echo_arr($arr){
	global $callback;
	$callback = preg_replace('/[\'"<>;%&=\*\(\)\+,\s]+/','',$callback);
	if($callback){
		echo $callback."(".json_encode($arr).")";exit;
	}else{
		echo json_encode($arr);exit;
	}
}


/*
* null转字符串
*/
function null2str($str){
	if(empty($str)){
		return '';
	}else{
		return $str;
	}
}


/*
* 获取表名
*
- channelid	频道编号
- db		数据库
*/
function get_tbname($channelid,$db){
	global $_SGLOBAL;
	$sql = "select SerialNo,parent,type from channel where id=".$channelid;
	$query = $_SGLOBAL[$db]->query($sql);
	$row = $_SGLOBAL[$db]->fetch_array($query);
	if($row['type']==0){
		return 'channel_'.$row['SerialNo'];
	}else{
		return get_tbname($row['parent'],$db);
	}
}


/*
* 获取时间描述
*
- date	频道编号
- db		数据库
*/
function get_date($date,$type=0){

	$now = time();
    $time_diff = $now-$date;

    if($time_diff<60)
    {
        $desc = $time_diff.'秒前';
    }
    elseif($time_diff>=60 && $time_diff<3600)
    {
        $desc = floor($time_diff/60).'分钟前';
    }
    elseif($time_diff>=3600 && $time_diff<86400)
    {
        $desc = floor($time_diff/3600).'小时前';
    }
    elseif($time_diff>=86400 && $time_diff<2592000 && $type==0)
    {
        $desc = floor($time_diff/86400).'天前';
    }
    elseif($time_diff>=2592000 && $time_diff<62208000 && $type==0)
    {
        $desc = floor($time_diff/2592000).'个月前';
    }
    elseif($time_diff>=62208000 && $type==0)
    {
        $desc = floor($time_diff/62208000).'年前';
    }else
	{
		$desc = date('Y-m-d H:i:s',$date);
	}
	
	return $desc;
}


/*
* 中文字符串截断
*
- string	字符串
- length	截取长度
- flag		尾标
*/
function substring($string,$length,$flag=""){

	$len = strlen($string);

		//截断字符
		$wordscut = '';
			//utf8编码
			$n = 0;
			$tn = 0;
			$noc = 0;
			while ($n < strlen($string)) {
				$t = ord($string[$n]);
				if($t == 9 || $t == 10 || (32 <= $t && $t <= 126)) {
					$tn = 1;
					$n++;
					$noc++;
				} elseif(194 <= $t && $t <= 223) {
					$tn = 2;
					$n += 2;
					$noc += 2;
				} elseif(224 <= $t && $t < 239) {
					$tn = 3;
					$n += 3;
					$noc += 2;
				} elseif(240 <= $t && $t <= 247) {
					$tn = 4;
					$n += 4;
					$noc += 2;
				} elseif(248 <= $t && $t <= 251) {
					$tn = 5;
					$n += 5;
					$noc += 2;
				} elseif($t == 252 || $t == 253) {
					$tn = 6;
					$n += 6;
					$noc += 2;
				} else {
					$n++;
				}
				if ($noc >= $length) {
					break;
				}
			}
			if ($noc > $length) {
				$n -= $tn;
			}
	$wordscut = substr($string, 0, $n);

	if($wordscut!=$string) $wordscut .= $flag;

	return ($wordscut);
}

/*
* 分页
*
- num		总条数
- perpage	每页条数
- curpage	当前页
- fun		方法名
*/
function multi_page($num, $perpage, $curpage, $fun) {
	global  $_SGLOBAL;
	$multipage = '';
	$realpages = @ceil($num/ $perpage);
	if($realpages<=1)
		return "";

	if($curpage==1)
	{
		$multipage .= '<span class="begin_end">上一页</span>';
		$multipage .= '<span class="on">1</span>';
	}
	else
	{
		$multipage .= '<span class="begin_end"><a href="javascript:'.$fun.'('.($curpage-1).');">上一页</a></span>';
		$multipage .='<span><a href="javascript:'.$fun.'(1);">1</a></span>';
	}
	if($curpage>4) $multipage .='<span class="con_pages_break">...</span>';

	if($curpage>4)
	{
		$from=$curpage-1;
		if($from<1) $from=1;
	}
	else
		$from=1;
	if($curpage>3)
	{
		$to = $curpage+1;	
	}
	else
		$to=4;

	if($to>$realpages) $to = $realpages;

	if($realpages>1)
	{
		for($i = $from; $i <= $to; $i++) {
			if($i != 1 && $i != $realpages)
			{
				if($curpage==$i)
					$multipage .='<span class="on">'.$i.'</span>';
				else
					$multipage .='<span><a href="javascript:'.$fun.'('.$i.');">'.$i.'</a></span>';
			}	
		}
	}
	if($to<$realpages) $multipage .='<span class="con_pages_break">...</span>';

	if($curpage==$realpages)
	{
		$multipage .= '<span class="on">'.$realpages.'</span>';
		$multipage .= '<span class="begin_end">下一页</span>';
	}
	else
	{
		$multipage .='<span><a href="javascript:'.$fun.'('.$realpages.');">'.$realpages.'</a></span>';
		$multipage .= '<span class="begin_end"><a href="javascript:'.$fun.'('.($curpage+1).');">下一页</a></span>';
	}
	return $multipage;
}


/*
* 字符串解密加密
*/
function authcode($string, $operation = 'DECODE', $key = '', $expiry = 0) {

	$ckey_length = 4;	// 随机密钥长度 取值 0-32;
				// 加入随机密钥，可以令密文无任何规律，即便是原文和密钥完全相同，加密结果也会每次不同，增大破解难度。
				// 取值越大，密文变动规律越大，密文变化 = 16 的 $ckey_length 次方
				// 当此值为 0 时，则不产生随机密钥

	$key = md5($key ? $key : UC_KEY);
	$keya = md5(substr($key, 0, 16));
	$keyb = md5(substr($key, 16, 16));
	$keyc = $ckey_length ? ($operation == 'DECODE' ? substr($string, 0, $ckey_length): substr(md5(microtime()), -$ckey_length)) : '';

	$cryptkey = $keya.md5($keya.$keyc);
	$key_length = strlen($cryptkey);

	$string = $operation == 'DECODE' ? base64_decode(substr($string, $ckey_length)) : sprintf('%010d', $expiry ? $expiry + time() : 0).substr(md5($string.$keyb), 0, 16).$string;
	$string_length = strlen($string);

	$result = '';
	$box = range(0, 255);

	$rndkey = array();
	for($i = 0; $i <= 255; $i++) {
		$rndkey[$i] = ord($cryptkey[$i % $key_length]);
	}

	for($j = $i = 0; $i < 256; $i++) {
		$j = ($j + $box[$i] + $rndkey[$i]) % 256;
		$tmp = $box[$i];
		$box[$i] = $box[$j];
		$box[$j] = $tmp;
	}

	for($a = $j = $i = 0; $i < $string_length; $i++) {
		$a = ($a + 1) % 256;
		$j = ($j + $box[$a]) % 256;
		$tmp = $box[$a];
		$box[$a] = $box[$j];
		$box[$j] = $tmp;
		$result .= chr(ord($string[$i]) ^ ($box[($box[$a] + $box[$j]) % 256]));
	}

	if($operation == 'DECODE') {
		if((substr($result, 0, 10) == 0 || substr($result, 0, 10) - time() > 0) && substr($result, 10, 16) == substr(md5(substr($result, 26).$keyb), 0, 16)) {
			return substr($result, 26);
		} else {
			return '';
		}
	} else {
		return $keyc.str_replace('=', '', base64_encode($result));
	}
}


/*
* 获取IP地址
*/
function getIP(){
    if(getenv("HTTP_CLIENT_IP") && strcasecmp(getenv("HTTP_CLIENT_IP"), "unknown")) 
            $ip = getenv("HTTP_CLIENT_IP"); 
    elseif(getenv("HTTP_X_FORWARDED_FOR") && strcasecmp(getenv("HTTP_X_FORWARDED_FOR"), "unknown")) 
            $ip = getenv("HTTP_X_FORWARDED_FOR"); 
    elseif (getenv("REMOTE_ADDR") && strcasecmp(getenv("REMOTE_ADDR"), "unknown")) 
            $ip = getenv("REMOTE_ADDR"); 
    elseif (isset($_SERVER['REMOTE_ADDR']) && $_SERVER['REMOTE_ADDR'] && strcasecmp($_SERVER['REMOTE_ADDR'], "unknown")) 
            $ip = $_SERVER['REMOTE_ADDR']; 
    else 
            $ip = "0.0.0.0"; 
    return $ip;
}



?>
