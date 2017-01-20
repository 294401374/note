<?php
/*
* 收藏
*
* author liuxinyue 2015/12/09
*/
class Collect{

	function ifcollect($id,$userid){
		//判断是否收藏过
		global $_SGLOBAL,$_TIDE;
		$sql = "select * from ".$_TIDE['tide_collect']." where item_gid=".$id." and userid=".$userid;
		$result = $_SGLOBAL['db']->query($sql);
		$row = $_SGLOBAL['db']->num_rows($result);
		if($row){
			return 0;
		}else{
			return 1;
		}
	}

	function add($url,$userid,$type,$title,$id){
		//收藏
		global $_SGLOBAL,$_TIDE;
		$ifcollect = $this->ifcollect($id,$userid);
		if($ifcollect==0){
			return echo_arr(array('status'=>0,'msg'=>'已经收藏过该内容'));
		}else{
			//动作表中是否存在
			$sql1 = "select collectnum from ".$_TIDE['tide_action']." where item_gid=".$id;
			$result1 = $_SGLOBAL['db']->query($sql1);
			$num = $_SGLOBAL['db']->num_rows($result1);
			$row1 = $_SGLOBAL['db']->fetch_array($result1);
			if($num==0){
				$query = $_SGLOBAL['db']->query("insert into ".$_TIDE['tide_action']." (item_gid,collectnum,Active,Status)values(".$id.",1,1,1)");
			}else{
				$sql_u = "update ".$_TIDE['tide_action']." set collectnum=collectnum+1 where item_gid=".$id;
				$query_u = $_SGLOBAL['db']->query($sql_u);
			}
			//插入收藏表
			$time = time();
			$result = $_SGLOBAL['db']->query("insert into ".$_TIDE['tide_collect']." (Title,item_gid,userid,url,type,CreateDate,Active,Status)values('".$title."',".$id.",".$userid.",'".$url."',".$type.",".time().",1,0)");
			if($result){
				$sql_u_f="update channel_favorite set number=number+1 where id=".$userid;
				$rs = $_SGLOBAL['db']->query($sql_u_f);
				if(!$rs){
					return echo_arr(array('status'=>0,'msg'=>'添加未成功，测试number'));
				}
				return echo_arr(array('status'=>1,'msg'=>'收藏成功'));
			}else{
				return echo_arr(array('status'=>0,'msg'=>'收藏失败'));
			}
		}
	}

}

?>