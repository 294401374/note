<?php
function operation($Title,$uid,$username,$summary){
	$url = "http://182.92.174.37:888/cms/api/additem.jsp";
	$setarr = array(
		"Title"=>$Title,//"上传头像",
		"uid"=>$uid,
		"username"=>$username,//$_SESSION['Title'],
		"Summary"=>$summary,//$_SESSION['Title']."上传头像，地址为：".$pathname,
		"ChannelID"=>"14174",
		"Status"=>1,
		"Token"=>"f1e323d4491f4b96e0981b9a3e53389e"
	);
	$_v1[] = json_decode(HttpClient::quickPost($url,$setarr),true);
	if($_v1[0]['message'] == 'success'){
		return json_encode(array("status"=>1));
	}else{
		return json_encode(array("status"=>0));
	}
}
function NumToStr($num){
    if (stripos($num,'e')===false) return $num;
    $num = trim(preg_replace('/[=\'"]/','',$num,1),'"');//出现科学计数法，还原成字符串
    $result = "";
    while ($num > 0){
        $v = $num - floor($num / 10)*10;
        $num = floor($num / 10);
        $result   =   $v . $result;
    }
    return $result;
}
	function get_content($url,$postinfo){
		$header = array(
			'Accept: application/json',
			'Content-Type: application/json',
			'Content-Length: ' . strlen($postinfo),
			'Authorization:4einwm3iX6HT9D1I',
		);
		$ch = curl_init();
		curl_setopt($ch, CURLOPT_POST, true);
		curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
		curl_setopt($ch,CURLOPT_SSL_VERIFYPEER,false);
		curl_setopt($ch, CURLOPT_HTTPHEADER, $header);
		curl_setopt($ch, CURLOPT_URL, $url);
		curl_setopt($ch, CURLOPT_POSTFIELDS, $postinfo);
		$response  = curl_exec($ch);
		curl_close($ch);
		return $response;
	}
