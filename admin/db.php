<?php

class Db {
	static private $_instance;
	static private $_connectSource;
	private $_dbConfig = array(
		'host' => '127.0.0.1',
		'user' => 'root',
		'password' => '',
		'database' => 'video',
	);

	private function __construct() {
	}

	static public function getInstance() {
		if(!(self::$_instance instanceof self)) {
			self::$_instance = new self();
		}
		return self::$_instance;
	}

	public function connect() {
		if(!self::$_connectSource) {
			self::$_connectSource = @mysql_connect($this->_dbConfig['host'], $this->_dbConfig['user'], $this->_dbConfig['password']);

			if(!self::$_connectSource) {
				throw new Exception('mysql connect error ' . mysql_error());
				//die('mysql connect error' . mysql_error());
			}

			mysql_select_db($this->_dbConfig['database'], self::$_connectSource);
			mysql_query("set names UTF8", self::$_connectSource);
		}
		return self::$_connectSource;
	}
}
/*
$connect = Db::getInstance()->connect();

$sql = "select * from video";
$result = mysql_query($sql, $connect);
echo mysql_num_rows($result);
var_dump($result);
*/

/*
// 插入数据
$connect = Db::getInstance()->connect();
$sql = "INSERT INTO `video`.`video` (`id`, `category_id`, ` name`, `description`, `thumb`, `discount`, `source`, `tag`, `create_time`, `update_time`, `recommend`, `img`, `status`, `orderby`) VALUES ('', '1', 'owifi', '全新OWIFI智能办公设备，超强无线WIFI+考勤机+办公系统3合1，告别传统企业仍需独立购买路由、考勤机、办公OA系统，实现办公OA系统+考勤机+路由，真正实现软件+硬件开发。做到其他软件做不到的功能，多种功能结合让企业管理更强大。', 'www.owifi.com', '0.1', '天猫', '智能硬件', '1470797623', '1470797626', '\r\n全新OWIFI智能办公设备', 'https://usepanda.com/img/source-icons/svg/github.svg', '1', '2');
";
$result = mysql_query($sql, $connect);
// echo $result;
echo "添加数据成功";
*/


// echo mysql_num_rows($result);


/*// 查询显示列表数据

$connect = Db::getInstance()->connect();
$sql = "select * from video";
$result = mysql_query($sql, $connect);
while($video = mysql_fetch_assoc($result)) {
		$videos[] = $video;
	}
foreach ($videos as $value) {
		echo "<pre>";
	foreach ($value as $v) {
		// echo $v['id'];
		echo $v.'|';
		// var_dump($v);
	}
}
*/

// $connect = Db::getInstance()->connect();
// $sql = "select * from video";
// $result = mysql_query($sql, $connect);

// while($video = mysql_fetch_assoc($result)) {
// 		$videos[] = $video;
// 	}

// foreach ($videos as $video) {
// 		echo "<pre>";
// 		echo $video['tag'];
// 		echo $video['source'];
// 		echo $video['id'];
// 		echo $video['category_id'];
// }


// foreach ($video as $v) {
// 	echo $video['id'];
// 	echo $video['tag'];
// 	echo $video['source'];
// }

// while($video = mysql_fetch_assoc($result)) {
// 		$videos[] = $video;
// 	}
// foreach ($videos as $value) {
// 		echo "<pre>";
// 	foreach ($value as $v) {
// 		// echo $v['id'];
// 		echo $v.'|';
// 		// var_dump($v);
// 	}
// }

