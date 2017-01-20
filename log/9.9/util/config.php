<?php
/****************************/
/***用户中心数据库连接开始***/
/****************************/
$_SC = array();
$_SC['dbhost']  		= '192.168.121.113';			//服务器地址
$_SC['dbuser']  		= 'mysql'; 					//用户	
$_SC['dbpw'] 	 		= 'yonghai2012';			//密码
$_SC['dbcharset'] 		= 'utf8';					//字符集
$_SC['pconnect'] 		= 0;						//是否持续连接
$_SC['dbname']  		= 'tidemedia_home_demo';			//数据库
$_SC['dbuchome']  		= 'uchome';					//数据库 默认为空不和uchome关联
$_SC['charset'] 		= 'utf-8';					//页面字符集

$_SC['tplrefresh']		= 1;						//判断模板是否更新的效率等级，数值越大，效>率越高; 设置为0则永久不判断
$_SC['gzipcompress']    = 0;						//启用gzip

$_SC['cmsname']			= "tidemedia_cms";			//cms数据库
$_SC['vmsname']  		= 'tidemedia_vms';			//vms数据库
$_SC['tjname']  		= 'tidemedia_tongji';		//统计数据库
/****************************/
/***用户中心数据库连接结束***/
/****************************/





/*******************************/
/***jsp接口及相关变量配置开始***/
/*******************************/


$_TIDE['Token']				= "64a44ca438b5e05cd009d1d4d7f399d2";				//Token
$_TIDE['url']				= "http://10.161.68.90:8888/home/api/additem.jsp";	//入库接口
$_TIDE['get_content_url']	= "http://10.161.68.90:8888/home/api/get_content_url.jsp";	//查询内容页url
$_TIDE['vms_url']			= "http://10.161.68.90:8888/vms/api/sns_upload.jsp";	//视频信息入库接口


/*******************************/
/***jsp接口及相关变量配置结束***/
/*******************************/





/****************************/
/****获取视频信息配置开始****/
/****************************/
$_CONFIG['now_ip']			= "http://115.29.150.217:5002";		//当前预览地址,需要更改地址
$_CONFIG['now_ip_i']		= "115.29.150.217:5002";		//作用和上面一样
$_CONFIG['now']				= "115.29.150.217:5002";		//视频中无效的ip地址
$_CONFIG['v_table']			= "channel_s4_a_d" ;			//视频库的表名 去这个表查找相关信息
$_CONFIG['b_table']			= "channel_s4_a_e";			//博客视频的表名 去这个表查找相关信息
$_CONFIG['z_table']			= "channel_transcode";			//转码表
$_CONFIG['type']			= 1;								//转码类型 0为channel_transcode 1为channel_video_url
/*****************************/
/*** 获取视频信息配置结束*****/
/*****************************/




/********************/
/****转码配置开始****/
/********************/
$_TIDE['video_switch']		= 1;						//转码开关
$_TIDE['vms_category']		= "15122";									//转码频道编号
$_TIDE['video_source']		= "http://115.29.150.217:5002/";						//转码video_source_folder
$_TIDE['video_domain']		= "http://vod.windia.tv/";							//转码后视频预览地址
/*********************/
/****转码配置结束*****/
/*********************/


/****************************/
/*****分段上传配置开始*******/
/****************************/
$_TIDE['tmp_path']		= "/web_demo/tidehome/_tmp/";	//临时目录--从根目录开始
$_TIDE['real_path']		= "/web_demo/tidehome/upload/";	//合并目录--从根目录开始
/****************************/
/*****分段上传配置结束*******/
/****************************/


/****************************/
/********爆料配置开始********/
/****************************/
$bao['targetFolder']	= "upload";					//爆料上传文件的目录名
$bao['route']			= "http://115.29.150.217/";	//这是视频的显示地址的域名或者ip
/****************************/
/********爆料配置结束********/
/****************************/



/****************************/
/********开关配置开始********/
/****************************/
$_TIDE['zan_switch']	= 1;				//每天可赞 1开启 0关闭
$_TIDE['filter_switch']	= 1;				//过滤敏感词 1开启 0关闭
$_TIDE['if_bind']		= 0;				//app三方登录后是否绑定用户 1绑定 0不绑定
/****************************/
/********开关配置结束********/
/****************************/




/****************************/
/********表名配置开始********/
/****************************/
$_TIDE['tide_member']		= "channel_s3_a_ab";		//tide用户表
$_TIDE['tide_spacefield']	= "tide_spacefield";		//tide用户资料表
$_TIDE['tide_action']		= "channel_s3_a_ad";		//tide动作表
$_TIDE['tide_action_detail']= "tide_action_detail";		//tide动作详细表
$_TIDE['tide_comment']		= "channel_s3_a_a";			//tide评论表
$_TIDE['tide_bao']			= "channel_s3_a_b";			//tide爆料表
$_TIDE['tide_collect']		= "channel_s3_a_ae";		//tide收藏表
$_TIDE['tide_feedback']		= "channel_feedback";		//tide意见反馈表
$_TIDE['tide_vote']			= "tide_vote";				//tide投票详情表
$_TIDE['tide_wxpay']		= "channel_pay_info";		//tide微信支付
$_TIDE['tide_alipay']		= "channel_alipay";			//tide支付宝支付
$_TIDE['tide_order']		= "channel_order";			//tide订单表
$_TIDE['tide_auth']			= "channel_auth";			//tide短信验证码表
$_TIDE['tide_transcode']	= "channel_transcode";		//tide转码表
$_TIDE['tide_podcast']		= "channel_podcast";		//tide播客视频表
$_TIDE['tide_zan']			= "channel_zan";			//tide点赞表
$_TIDE['tide_address']		= "channel_address";		//tide收货地址表
$_TIDE['tide_survey']		= "channel_survey";			//tide调查表
$_TIDE['tide_filter']		= "channel_sensitive_word";	//tide cms敏感词表
/****************************/
/********表名配置结束********/
/****************************/




/****************************/
/******频道编号配置开始******/
/****************************/
$_TIDE['tide_member_id']	= "20188";				//tide用户表id
$_TIDE['tide_action_id']	= "20191";				//tide动作表id
$_TIDE['tide_comment_id']	= "20196";				//tide评论表id
$_TIDE['tide_collect_id']	= "20192";				//tide收藏表id
$_TIDE['tide_feedback_id']	= "20203";				//tide反馈表id
$_TIDE['tide_bao_id']		= "20201";				//tide爆料表id
$_TIDE['tide_wxpay_id']		= "";				//tide微信支付表id
$_TIDE['tide_alipay_id']	= "";				//tide支付宝支付表id
/****************************/
/******频道编号配置结束******/
/****************************/



/****************************/
/***频道id对应表名配置开始***/
/****************************/
$table_name = array();			
$table_name[3]		= "channel_s3_a";
$table_name[5794]	= "channel_s8_b";
$table_name[13862]	= "channel_poll";
/****************************/
/***频道id对应表名配置结束***/
/****************************/



/**********************/
/***投票规则配置开始***/
/**********************/
$_TIDE['vote_type']		= 0;	//投票类型：1只有一个投票主题 0一个投票主题多个投票选项
$_TIDE['vote_number']	= 1;	//投票选项类型：1单选 0多选
$_TIDE['vote_login']	= 1;	//是否需要登录：1需要登录 0不需要登录
$_TIDE['vote_date']		= 0;	//是否有时间段的限制：1有限制 0无限制
$_TIDE['vote_times']	= 12;	//一个用户可以投几票（不可以为0）
$_TIDE['vote_everyday']	= 1;	//是否每天都可以投：1是 0总共只可以投一次
/****************************/
/***投票规则配置结束***/
/****************************/



/************************/
/**app支付信息配置开始***/
/************************/

//站点根目录
$_TIDE['root_dir']			= "/mnt/collector/";					//从根到tidehome目录，最后有/

//支付宝配置
$_TIDE['ali_seller']		= "cangjiaquan@tidemedia.com";			//支付宝卖家账号
$_TIDE['ali_partner']		= "2088123456789123";					//合作身份者id,以2088开头的16位纯数字
$_TIDE['ali_key']			= "vnwysjgf62846hcnwodmau487vasw7n";	//安全检验码，以数字和字母组成的32位字符
$_TIDE['ali_seller']		= "cangjiaquan@tidemedia.com";			//支付宝卖家账号

/************************/
/**app支付信息配置结束***/
/************************/



/****************************/
/******用户中心配置开始******/
/****************************/
//tidehome目录前的目录
$_TIDE['root'] = "/web_demo";
$_TIDE['domain'] = "http://115.29.150.217:5500/";
//目录、接口等
define("APP_JPATH",$_TIDE['root']);						//站点目录
define("DOMAIN_NAME",$_TIDE['domain']);		//完整域名+tp根目录
define("MAIN_PATH",$_TIDE['root']."/tidehome");				//站点目录+TP根目录
define("USER_IMAGE_PATH",$_TIDE['domain']."/images/head/");//用户头像目录（带域名）
define("USER_UPIMAGE_PATH",$_TIDE['domain']."/images/photos/");//用户头像目录（带域名）
define("IMAGE_PATH",$_TIDE['root']."/tidehome/images/photos/");//上传图片目录（从站点目录开始）
define("VIDEO_PATH",$_TIDE['root']);		//上传视频目录（从站点目录开始）
define("USER_UPVIDEO_PATH",$_TIDE['domain']."/video/");	//视频目录（带域名）
define("VIDEO_PATH1","/tidehome/video/");								//上传视频目录（从tp根目录开始）
define("DATA_TOKEN",$_TIDE['Token']);				//数据库Token
define("DATA_URL",$_TIDE['url']);		//数据库URL
define("VMS_URL",$_TIDE['vms_url']);		//视频信息入库接口
define("USER_CHANNELID",20188);			//用户表ChannelID
define("IMAGE_CHANNELID",20189);		//图片表ChannelID
define("VIDEO_CHANNELID",12992);		//播客视频Category
define("VIDEO_SOURCE_FOLDER",$_TIDE['video_source']);					//源视频的预览域名或IP地址加端口
define("CONNECT_VMS","mysql://root:tidemedia2013@127.0.0.1:3306/tidemedia_vms_demo");			//vms库连接信息
define("CONNECT_UCHOME","mysql://root:tidemedia2013@127.0.0.1:3306/tidemedia_uchome_demo");		//uchome库连接信息

//开关switch; 开启1 关闭0
define("S_EMAIL",0);					//注册时是否进行邮件验证
define("S_QQ",1);						//QQ登录
define("S_SINA",1);						//新浪微博登录
define("S_WEIXIN",0);					//微信登录

//发送邮件
define("EMAIL_SMTP","tidemedia.com");			//邮件发送服务器
define("EMAIL_PORS",25);						//邮件服务器端口
define("EMAIL_LOGIN","liuxinyue@tidemedia.com");//邮件服务器登录用户
define("EMAIL_PASS","..1234567890");			//邮件服务器登录密码
define("EMAIL_FROM","liuxinyue");				//邮件发送人
define("EMAIL_COME","liuxinyue@tidemedia");		//接收邮件回复地址
define("EMAIL_TITLE","您的邮箱验证");			//邮件主题

//表名
define("DB_USER","channel_s3_a_ab");			//用户表
define("DB_PHOTO","channel_s3_a_ac");			//图片表
define("DB_COLLECT","channel_s3_a_ae");			//收藏表
define("DB_CONTENT","channel_s3_a");			//内容表
define("DB_ACTION","channel_s3_a_ad");			//动作表
define("DB_VIDEO","channel_podcast");			//视频表
define("DB_TRANSCODE","channel_transcode");		//转码表
define("DB_COMMENT",$_TIDE['tide_comment']);	//评论表
define("DB_BAOLIAO",$_TIDE['tide_bao']);		//爆料表
define("DB_ADDRESS",$_TIDE['tide_address']);	//地址表
define("DB_ORDER",$_TIDE['tide_order']);		//订单表
define("DB_VOTE",$_TIDE['tide_vote']);		//投票表

//第三方登录
define("QQ_APPID","101274521");							//QQ登录appid
define("QQ_APPKEY","45c3b5ce489c466d8dce04b79ca823ab");	//QQ登录appkey
define("QQ_URL",$_TIDE['domain']);	//QQ登录后用户信息的返回地址
define("LOGIN_BACK","http://www.szntv.tv");	//登录成功跳转页面

define("SINA_APPKEY","1111454206");							//新浪登录app_key
define("SINA_APPSECRET","0b46367a7594a1ef122d6ba1a46fa7f5");	//新浪登录app_secret

define("WEIXIN_APPID","wx48e58bd348ce03e9");							//微信登录appid
define("WEIXIN_APPSECRET","d70b0b35e2f870b970688c2b8f3dcb60");	//微信登录appkey
define("WEIXIN_URL",$_TIDE['domain']);	//微信登录后用户信息的返回地址

//TP系统配置
return array(
	//'配置项'=>'配置值'
	'DEFAULT_MODULE'        =>  'Home',  // 默认模块
	'DEFAULT_CONTROLLER'    =>  'Login', // 默认控制器名称
	'DEFAULT_ACTION'        =>  'login', // 默认操作名称

	'TMPL_TEMPLATE_SUFFIX'	=>	'.shtml',
	//'URL_ROUTER_ON'		=>	true,	//URL路由
	//'URL_MODEL'			=>	2,		// URL模式
	'LAYOUT_ON'				=>	true,//开启布局
	"LAYOUT_NAME"			=>	"Layout/layout",//布局的名称
	'DB_TYPE'               =>  'mysql',     // 数据库类型
	'DB_HOST'               =>  $_SC['dbhost'], // 服务器地址
	'DB_NAME'               =>  $_SC['dbname'],          // 数据库名
	'DB_USER'               =>  $_SC['dbuser'],      // 用户名
	'DB_PWD'                =>  $_SC['dbpw'],          // 密码
	'DB_PORT'               =>  '3306',        // 端口
	'DB_PREFIX'             =>  '',    // 数据库表前缀
	'DB_FIELDTYPE_CHECK'    =>  false,       // 是否进行字段类型检查
	'DB_FIELDS_CACHE'       =>  false,        // 启用字段缓存
	'DB_CHARSET'            =>  'utf8',      // 数据库编码默认采用utf8
	'DB_DEPLOY_TYPE'        =>  0, // 数据库部署方式:0 集中式(单一服务器),1 分布式(主从服务器)
	'DB_RW_SEPARATE'        =>  false,       // 数据库读写是否分离 主从式有效
	'DB_MASTER_NUM'         =>  1, // 读写分离后 主服务器数量
	'DB_SLAVE_NO'           =>  '', // 指定从服务器序号
	'DB_SQL_BUILD_CACHE'    =>  false, // 数据库查询的SQL创建缓存
	'DB_SQL_BUILD_QUEUE'    =>  'file',   // SQL缓存队列的缓存方式 支持 file xcache和apc
	'DB_SQL_BUILD_LENGTH'   =>  20, // SQL缓存的队列长度
	'DB_SQL_LOG'            =>  false, // SQL执行日志记录
	'DB_BIND_PARAM'         =>  false, // 数据库写入数据自动参数绑定
);
/****************************/
/******用户中心配置结束******/
/****************************/

?>
