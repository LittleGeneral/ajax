<?php
require_once('./db.php');
$id=$_GET['id'];

// 插入数据
$connect = Db::getInstance()->connect();
$sql = "DELETE FROM video WHERE id=$id";
$result = mysql_query($sql, $connect);
// echo $result;die();

// if($result){
//      header('Location:index.php');
// }

 if($result){
     $respose = array(
     	'errno' => 0,
     	'errmsg'=>'success',
     	'data'  =>true,
 	);
}else{
     $respose = array(
	 	'errno' => -1,
	 	'errmsg'=>'fail',
	 	'data'  =>false,
 	);
}
echo json_encode($respose);

