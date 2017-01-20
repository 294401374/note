<?php
/*
* api收藏
*
* author liuxinyue 2016/9/12
*/
error_reporting(E_ALL);
ini_set('display_errors','On');

include('../util/common.php');
include('../class/collect.php');

//接收参数
$url = empty($_REQUEST['url'])?'':html_strips_trim($_REQUEST['url']);
// $session = empty($_REQUEST['session'])?"":$_REQUEST['session'];
$title = empty($_REQUEST['title'])?'':$_REQUEST['title'];
$id = empty($_REQUEST['id'])?0:intval($_REQUEST['id']);
$type = empty($_REQUEST['type'])?'':intval($_REQUEST['type']);
// $callback = $_REQUEST['callback'];
$favorite = empty($_REQUEST['favorite'])?0:intval($_REQUEST['favorite']);
// favorite userid id
// ?id=123321&userid=11233&favorite=1

// sessionstart($session);
//判断参数
// if($_SESSION['userid'] == '' || $_SESSION['userid'] == null){
// 	echo_arr(array("status"=>0,"message"=>"对不起请登陆后再执行此操作。"));exit;
// }
// if($url==''||$url==null){
// 	echo_arr(array('status'=>0,'message'=>'请填写收藏的地址'));exit;
// }
// if($type==''||$type==null){
// 	echo_arr(array('status'=>0,'message'=>'请填写收藏的类型'));exit;
// }
// if($title==''||$title==null){
// 	echo_arr(array('status'=>0,'message'=>'请填写收藏的标题'));exit;
// }
if($id==0||$id==null){
	echo_arr(array('status'=>0,'message'=>'请填写收藏的编号g'));exit;
}
if($favorite==0||$favorite==null){
	echo_arr(array('status'=>0,'message'=>'请填写收藏夹的编号'));exit;
}
//判断收藏的总数
$sql = "select number,userid from channel_favorite where id=".$favorite;
// echo $sql;
$result = $_SGLOBAL['db']->query($sql);
$row=$_SGLOBAL['db']->fetch_array($result);
$fnum=$row['number'];
echo '<br>';
if($fnum>299){
// 	// 不能添加
	echo_arr(array('status'=>0,'message'=>'收藏文件已经超出300'));exit;
}
$_SESSION['userid']=11233;
if ($_SESSION['userid']!=$row['userid']) {
	echo_arr(array('status'=>0,'message'=>'用户不统一'));exit;
}

//收藏
$_SESSION['userid']=11233;
$c = new Collect();
$result = $c->add($url,$_SESSION['userid'],$type,$title,$id,$favorite);

?>