<?php
/*
* 
*获取视频信息
*
*@auther  qiaotengfei
*@version 2015/06-29 modify
*/
define("VMS",TRUE);
include('../common/common.php');
dbvmsconnect();
//接收参数
//此接口直接使用GlobalID查找
/*
empty($_REQUEST['GlobalID'])?exit("缺少参数!"):$GlobalID=trim($_REQUEST['GlobalID']);
$callback=empty($_REQUEST['funcname'])?"":trim($_REQUEST['funcname']);
if(!is_numeric($GlobalID)) exit("参数值错误!");
*/
$GlobalID = empty($_REQUEST['GlobalID'])?0:(int)trim($_REQUEST['GlobalID']);
// $GlobalID = 1018309;
$callback=empty($_REQUEST['funcname'])?"":trim($_REQUEST['funcname']);
if($GlobalID == 0){
	echo_arr(array("status"=>0,"message"=>"缺少参数"));exit;
}

//去视频表里面查相关信息
$data=array();
$duration=0;
$sql = "select * from channel_s4_a_d where active=1 and GlobalId=".$GlobalID;
// $sql="select * from ".$_CONFIG['v_table']." where active=1 and GlobalID=".$GlobalID;/*添加条件active=1，文件是存在的。*/
$query=mysql_query($sql);
if($arr=mysql_fetch_array($query)){
   $data['id']=$arr['GlobalID'];
 // $data['id']=$GlobalID;
   $data['title']=$arr['Title'];
      if($arr['Duration'])
   {
  	$duration=$arr['Duration'];
  }
   $arr['Photo']?$data['photo']=$arr['Photo']:$data['photo']="";
}else{
	$sql2="select * from channel_s4_a_d where GlobalID=".$GlobalID;
	$query2=mysql_query($sql2);
	if($arr=mysql_fetch_array($query2)){
		$data['id']=$GlobalID;
		$data['title']=$arr['Title'];
		$arr['Photo']?$data['photo']=$arr['Photo']:$data['photo']="";
	}else
		echo_arr(array("status"=>0,"message"=>"参数有误"));exit;
}

if($data['id'])$GlobalID=$data['id'];
//转码表
$sql="select * from channel_transcode where Parent=".$GlobalID;
$query=mysql_query($sql);
$v=array();
$mod=array();


while($arr=mysql_fetch_array($query)) {
   $mod[]=$arr;

}

$last=array(1=>"",2=>"",3=>"",4=>"");
// echo $_CONFIG['type'];
// $_CONFIG['type']			= 0;	
if($_CONFIG['type'] == 0){
	foreach($mod as $v){
			if($v['video_type']==1){
				empty($v['video_dest'])?"":preg_match("/http/i",$v['video_dest'])?$last[1]=str_replace($_CONFIG['now'],$_CONFIG['now_ip_i'],$v['video_dest']):$last[1]=$_CONFIG['now_ip'].$v['video_dest'];
			}elseif($v['video_type']==2){
				empty($v['video_dest'])?"":preg_match("/http/i",$v['video_dest'])?$last[2]=str_replace($_CONFIG['now'],$_CONFIG['now_ip_i'],$v['video_dest']):$last[2]=$_CONFIG['now_ip'].$v['video_dest'];
			}elseif($v['video_type']==3){
				empty($v['video_dest'])?"":preg_match("/http/i",$v['video_dest'])?$last[3]=str_replace($_CONFIG['now'],$_CONFIG['now_ip_i'],$v['video_dest']):$last[3]=$_CONFIG['now_ip'].$v['video_dest'];
			}else{
				if($last[4]=="")
				empty($v['video_dest'])?"":preg_match("/http/i",$v['video_dest'])?$last[4]=str_replace($_CONFIG['now'],$_CONFIG['now_ip_i'],$v['video_dest']):$last[4]=$_CONFIG['now_ip'].$v['video_dest'];
			}
	}
}else{
	foreach($mod as $v){
			if($v['video_type']==1){
				empty($v['Url'])?"":preg_match("/http/i",$v['Url'])?$last[1]=str_replace($_CONFIG['now'],$_CONFIG['now_ip_i'],$v['Url']):$last[1]=$_CONFIG['now_ip'].$v['Url'];
			}elseif($v['video_type']==2){
				empty($v['Url'])?"":preg_match("/http/i",$v['Url'])?$last[2]=str_replace($_CONFIG['now'],$_CONFIG['now_ip_i'],$v['Url']):$last[2]=$_CONFIG['now_ip'].$v['Url'];
			}elseif($v['video_type']==3){
				empty($v['Url'])?"":preg_match("/http/i",$v['Url'])?$last[3]=str_replace($_CONFIG['now'],$_CONFIG['now_ip_i'],$v['Url']):$last[3]=$_CONFIG['now_ip'].$v['Url'];
			}else{
				if($last[4]=="")
				empty($v['Url'])?"":preg_match("/http/i",$v['Url'])?$last[4]=str_replace($_CONFIG['now'],$_CONFIG['now_ip_i'],$v['Url']):$last[4]=$_CONFIG['now_ip'].$v['Url'];
			}
	}
}
//print_r($last);
//exit();
//拼数组
//$last[3]="";
$videos=array(array("type"=>"v_sd","url"=>$last[3]),array("type"=>"v_hd","url"=>$last[2]),array("type"=>"v","url"=>$last[1]));
$data['videos']=$videos;
$data['duration']=$duration;
//返回json
echo_arr(array("status"=>1,"message"=>"成功","result"=>$data));
?>

