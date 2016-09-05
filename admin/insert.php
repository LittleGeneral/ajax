<?php
require_once('./db.php');
// require_once('../file.php');
// isset($_GET['page']) ? $_GET['page'] : 1;
$name=isset($_POST['name']) ? $_POST['name'] : 1;
$status=isset($_POST['status']) ? $_POST['status'] : 1;
$desc=isset($_POST['description']) ? $_POST['description'] : 1;
$img=isset($_FILES['img']['name']) ? $_FILES['img']['name'] : 1;
// var_dump($img);
// echo $img;

if (!empty($img)) {
    $path="./uploads/";
    if(!file_exists($path)) mkdir("$path", 0700);
    $filename = date("YmdHis").strstr($img, ".");
    $file2 = $path.$filename;
    $result=move_uploaded_file($_FILES['img']['tmp_name'], $file2);
}

// 插入数据
$connect = Db::getInstance()->connect();
$sql = "INSERT INTO video (name, status,description, img) VALUES ('$name','$status', '$desc','$file2')";
$result = mysql_query($sql, $connect);
if($result){
     header('Location:index.php');
}

