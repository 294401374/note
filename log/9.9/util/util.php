<?php
/*
	[tide comment system] (C) 2011 www.tidemedia.com
	$Id: db.php 2011-07-06 lixiulian(lixiulian1987@163.com)$
*/
class util{

	var $conn;
	var $config = "";

    function __construct()
    {
		$a = func_get_args();
        $i = func_num_args();
        if (method_exists($this,$f='__construct'.$i)) {
            call_user_func_array(array($this,$f),$a);
        } 
    }
   
    function __construct1($c)
    {
        $this->config = $c;
		//echo $c;exit();
    } 

	//获取用户对象
	static function getUser($userid)
	{
			return new user($userid);
	}


	//根据用户昵称获取用户编号
	static function getUserID($username)
	{
		global $_SGLOBAL;
		//echo "select uid from uchome_space where name='".$username."'";
		$uid = $_SGLOBAL['db']->result_first("select uid from uchome_space where name='".$username."' or username='".$username."'");
		return $uid;
	}

	//缓存对象设置
	static function setCache() {
		global $_SGLOBAL;

		if(empty($_SGLOBAL['cache'])) {
			$_SGLOBAL['cache'] = new Memcache;
			$_SGLOBAL['cache']->addServer($_SGLOBAL['cache_ip'], $_SGLOBAL['cache_port']);
		}
	}

	
	//不存在就设置默认值
	static function increment($key,$o)
	{
		global $_SGLOBAL;
		$cache = $_SGLOBAL['cache'];
		$num = $cache->get($key);
		if($num)
		{
			return $cache->increment($key,$o);
		}
		else
		{
			return $cache->set($key,$o);
		}
	}

	static function decrement($key,$o)
	{
		global $_SGLOBAL;
		$cache = $_SGLOBAL['cache'];
		$num = $cache->get($key);
		if($num)
		{
			return $cache->decrement($key,$o);
		}
		else
		{
			return $cache->set($key,0);
		}
	}

	//获取视频榜单数据 如getVideo_Top10("day");  getCartoon_Top10("week");
	static function getVideo_Top10($type,$channelid)
	{
		//echo 111;exit;
		global $_SGLOBAL;
		$cache = $_SGLOBAL['cache']; 
		if($type=="day")
			$key = "video_top_".$channelid."_".date("Y_m_d");
		else if($type=="week")
			$key = "video_top_".$channelid."_w".date("Y_W");
		else if($type=="month")
			$key = "video_top_".$channelid."_".date("Y_m");
		else
			return array();
//echo $key;
		$o = $cache->get($key);
		if($o)
		{
		}
		else
		{
			$o =array();
		}

		
		$oo = array();
		$i = 1;
		//print_r($o);exit;
		foreach($o as $v)
		{
			if($v['number']>0)
			{
				$v['video'] = util::getItem($v['id']);
				$v['index'] = $i;
				$i = $i + 1;
                                if(!empty($v['video']))
				    $oo["id_".$v['id']] = $v;
			}
		}
		
		//print_r($o);
		//print_r($oo);

		return $oo;
	}

	//设置榜单数据
	static function setVideo_Top10($type,$o,$channelid)
	{
		global $_SGLOBAL;
		$cache = $_SGLOBAL['cache']; 
		if($type=="day")
			$key = "video_top_".$channelid."_".date("Y_m_d");
		else if($type=="week")
			$key = "video_top_".$channelid."_w".date("Y_W");
		else if($type=="month")
			$key = "video_top_".$channelid."_".date("Y_m");
		else
			return;

		util::setValue($key,$o);
	}

	static function getItem($id)
	{
		include_once('./Service.php');

		global $_SGLOBAL;
		$cache = $_SGLOBAL['cache']; 
		$key = "item_object_".$id;
		
		$o = $cache->get($key);

		if($o)
		{
		}
		else
		{
			$o = new item($id);
			$solr = new Apache_Solr_Service('192.168.121.111',888,'/solr/twsite');
			$docs = array();

			if ($solr->ping())
			{  
				//echo 'ok';exit;
				$query = "id:".$id;
				$response = $solr->search($query);
				$docs = $response->response->docs;
				$docs2=$docs[0];

				if($docs2){
				$o->href = $docs2->href;
				$o->title = $docs2->title;
				$o->photo = $docs2->photo;
				//$o->length = $docs2->length;
				//print_r($o);
				//echo "solr";exit();
				}
			}
			$cache->set($key,$o);
		}
                if($o->title)
		     return $o;
                else 
                     return ""; 
	}

	static function getValue($key)
	{
		global $_SGLOBAL;
		$cache = $_SGLOBAL['cache'];
		return $cache->get($key);
	}

	static function getIntValue($key)
	{
		global $_SGLOBAL;
		$cache = $_SGLOBAL['cache'];
		$num = $cache->get($key);
		if($num)
			return $num;
		else
			return 0;
	}

	//$time==-1 永久 $time==0 30天
	static function setValue($key,$o,$time=0)
	{
		global $_SGLOBAL;
		if($time==0)
		{
			$time = 2492000;//60×60×24×30;
		}
		else if($time==-1)
		{
			$time = 0;
		}
		$cache = $_SGLOBAL['cache'];
		return $cache->set($key,$o,false,$time);
	}

	static function delValue($key)
	{
		global $_SGLOBAL;
		$cache = $_SGLOBAL['cache']; 
		$cache->delete($key);
	}

	//中文字符串截断
	static function substring($string,$length,$flag="")
	{
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

	//solr更新
	static function updateSolr($id,$field)
	{
	   /* $ip = "192.168.121.123";
		$url = "/app/update_api.php?id=".$id."&field=".$field;

		$fp = @fsockopen($ip, 80, $errno, $errstr, 30);  
		if (!$fp) {  
			echo "$errstr ($errno)<br />\n";  
		} else {  
			$out = "GET ".$url." HTTP/1.1\r\n";  
			$out .= "Host:search.ishangman.com\r\n";  
			$out .= "Connection: Close\r\n\r\n";  
		  
			$result = "";
			fwrite($fp, $out);  
			while (!feof($fp)) {  
				$result .= fgets($fp, 128);  
			}  
			//util::printlog("result:".$result);
			fclose($fp);  
		} 
		*/
		$url="http://192.168.121.123/app/update_api2.php?id=".$id."&field=".$field;
		//echo $url;exit;
		$content=file_get_contents($url);
	}

	//图片为空，返回默认图片
	static function image($img)
	{
		if($img)
			return $img;
		else
			return "http://image.cutv.com/video/cutv_video.jpg";
	}
	//分页
	static function multi_page($num, $perpage, $curpage, $fun,$mpurl='') {
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

//最新记录 id:globalid  type：2 图文 3视频(同solr中的分类)

static function getTopItems($id,$type)
{
	include_once('./Service.php');
	global $_SGLOBAL;
	$cache = $_SGLOBAL['cache']; 
	$m=date("i");
	$m=floor($m/10);
	$key = "item_top_".$type."_".date("Y_m_d")."_".date("H")."_".$m;

	$arr2 = array();
	$arr3 = array();
	$o = $cache->get($key);
		if($o)
		{
		}	
		else
		{
			$solr = new Apache_Solr_Service('192.168.121.111',888,'/solr/twsite');
			$docs = array();

			if ($solr->ping())
			{  
				$perpage=25;
				$query = "*:* AND videotype:".$type;
				$arr_0=array("","dateline desc","play_num desc");
				$params['sort'] = $arr_0[1];
				$totalpage=$perpage*2;
				$response = $solr->search($query, 0, $totalpage,$params);
				$docs = $response->response->docs;
				
			foreach ($docs as $v) 
			{
				$arr['id']=$v->id;
				$arr['dateline']=$v->dateline;
					$arr['title']=$v->title;
					$arr['href']=$v->href;
					$arr['photo']=$v->photo;			
					$arr['length']=$v->length;
					$arr['pid']=$v->pid;
					$o[] = $arr;
			}
				
			}
			$cache->set($key,$o,800);
		}
	
	//	$i=1;
			foreach ($o as $v) 
			{
				if($v['id'] != $id && $id!=0)
				{
					$arr = array();
					$arr['id']=$v['id'];
					$arr['dateline']=$v['dateline'];
					$arr['title']=$v['title'];
					$arr['href']=$v['href'];
					$arr['photo']=$v['photo'];			
					$arr['length']=$v['length'];
					$arr['pid']=$v['pid'];
					$arr2[] = $arr;
				
				//if($i==25)
					//	break;

				//	$i=$i+1;
				}	
				
			}

	return $arr2;
}

}	

//数组排序用 根据number
function my_sort_by_number($a, $b)
{
	 if ($a['number'] == $b['number']) return 0;
	 return ($a['number'] > $b['number']) ? -1 : 1;
}

?>
