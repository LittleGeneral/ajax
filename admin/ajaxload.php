<?php
require_once('./db.php');

$connect = Db::getInstance()->connect();

$page = isset($_GET['page']) ? $_GET['page'] : 1;
$pageSize = isset($_GET['pagesize']) ? $_GET['pagesize'] : 15;
if(!is_numeric($page) || !is_numeric($pageSize)) {
    return Response::show(401, '数据不合法');
}

$offset = ($page - 1) * $pageSize;

// $sql = "select * from video";
$sql = "select * from video where status = 1 order by orderby desc limit ". $offset ." , ".$pageSize;

$result = mysql_query($sql, $connect);

/*while($video = mysql_fetch_assoc($result)) {
        $data[] = $video;
    }
echo json_encode($data);

*/

while($video = mysql_fetch_assoc($result)) {
        $data[] = $video;
    }
 if($result){
     $respose = array(
        'errno' => 0,
        'errmsg'=>'success',
        'data'  =>$data,
    );
}else{
     $respose = array(
        'errno' => -1,
        'errmsg'=>'fail',
        'data'  =>false,
    );
}
echo json_encode($respose);


// echo json_encode($videos);die();
 ?>
