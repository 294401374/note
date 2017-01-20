<?php
$_SC = array();
$_SC['dbhost']  		= '192.168.121.113'; //服务器地址
$_SC['dbuser']  		= 'mysql'; //用户
$_SC['dbpw'] 	 		= 'yonghai2012'; //密码
$_SC['dbcharset'] 		= 'utf8'; //字符集
$_SC['pconnect'] 		= 0; //是否持续连接
$_SC['dbname']  		= 'tidemedia_vms'; //数据库
$_SC['charset'] 		= 'utf-8'; //页面字符集
$_SC['tplrefresh']		= 1; //判断模板是否更新的效率等级，数值越大，效率越高; 设置为0则永久不判断
$_SC['gzipcompress'] 	= 0; //启用gzip
$_SC['tplrefresh']		= 1;						//判断模板是否更新的效率等级，数值越大，效率越高; 设置为0则永久不判断
$_SC['gzipcompress'] 	= 0;						//启用gzip
$_SC['cookiepre'] 		= 'uchome_'; 				//COOKIE前缀
$_SC['cookiepath'] 		= '/'; 						//COOKIE作用路径
$_SC['cookiedomain'] 	= ''; //COOKIE作用域
$_SC['tongjidb']  		= 'tidemedia_tongji'; //数据库
//vms
$_SC['vmshost']  		= '192.168.121.113'; //服务器地址
// $_SC['vmshost']  		= '192.168.10.16'; //服务器地址
$_SC['vmsuser']  		= 'root'; //用户
$_SC['vmspw'] 	 		= 'tidecms2008'; //密码
$_SC['vmsname']  		= 'tidemedia_vms'; //数据库
//表名
$_TIDE['tide_member']		= "tide_member";		//tide用户表
$_TIDE['tide_spacefield']	= "tide_spacefield";	//tide用户资料表
$_TIDE['tide_action']		= "tide_action";		//tide动作表
$_TIDE['tide_vote']		    = "tide_vote";		    //tide动作记录表
$_TIDE['tide_action_detail']= "tide_action_detail";	//tide动作详细表
$_TIDE['tide_comment']		= "tide_comment";		//tide动作表
$_TIDE['uc_members']		= "pre_ucenter_members";			//ucenter用户表
//uchome表
$_TIDE['uchome_member'] 	= "uchome_member";		//uchome用户表的表
$_TIDE['uchome_spacefield']	= "uchome_spacefield"; 	//uchome用户资料表

//点赞是否需要登陆
$_ZAN['user'] = false;								//登陆点赞的话记得打开session
$_ZAN['together'] = false;							//点赞的同时能点踩

//表名与channelid对应配置
$tablename = array();
$tablename[14153] = "channel_s8_a";		//圈贵阳内容中心
$tablename[15816] = "channel_s8_a_s_c";	//圈贵阳年度人物--人物投票
$tablename[15753] = "channel_s8_a_r";	//圈贵阳招牌菜
$tablename[15719] = "channel_s8_a_p_b";	//圈贵阳家政服务大赛--家政投票
$tablename[15721] = "channel_s8_a_p_c";	//圈贵阳家政服务大赛--视频赏析
$tablename[14442] = "channel_s8_a_m_e";	//圈贵阳微电影--作品投票
$tablename[14318] = "channel_s8_a_m_c";	//圈贵阳微电影--经典回放
$tablename[15886] = "channel_s8_a_u_b";	//圈贵阳萌宝记--投票
$tablename[15948] = "channel_s8_a_a_i";	//文明大决战--浏览量

// 
/****************************/
/****获取视频信息配置开始****/
/****************************/
$_CONFIG['now_ip']			= "http://ottvod.n21.cc";		//当前预览地址,需要更改地址
$_CONFIG['now_ip_i']		= "http://ottvod.n21.cc";		//作用和上面一样
$_CONFIG['now']				= "115.29.150.217:5002";		//视频中无效的ip地址
$_CONFIG['v_table']			= "channel_s4_a_b";			//视频库的表名 去这个表查找相关信息
$_CONFIG['b_table']			= "channel_s4_a_e";			//博客视频的表名 去这个表查找相关信息
$_CONFIG['z_table']			= "channel_transcode";			//转码表
$_CONFIG['type']			= 0;								//转码类型 0为channel_transcode 1为channel_video_url$_CONFIG['type'];

define('UC_KEY', '1234'); // 与 UCenter 的通信密钥, 要与 UCenter 保持一致
?>
