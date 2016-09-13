<?php
// http://app.com/list.php?page=1&pagesize=12
require_once('./db.php');
$connect = Db::getInstance()->connect();

$page = isset($_GET['page']) ? $_GET['page'] : 2;
$pageSize = isset($_GET['pagesize']) ? $_GET['pagesize'] : 7;
if(!is_numeric($page) || !is_numeric($pageSize)) {
    return Response::show(401, '数据不合法');
}

$offset = ($page - 1) * $pageSize;

// $sql = "select * from video";
$sql = "select * from video where status = 1 order by id desc limit ". $offset ." , ".$pageSize;

$result = mysql_query($sql, $connect);

while($video = mysql_fetch_assoc($result)) {
        $data[] = $video;
    }

echo json_encode($data);

 ?>
