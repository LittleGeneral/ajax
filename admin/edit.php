<?php
require_once('./db.php');
$id=$_GET['id'];

// 插入数据
$connect = Db::getInstance()->connect();
$sql = "SELECT * FROM video WHERE id= $id ";
$result = mysql_query($sql, $connect);
$video = mysql_fetch_assoc($result);
// var_dump($video);
// if($result){
//      header('Location:index.php');
// }

?>

<!doctype html>
<html>
<head>
<meta charset="utf-8">
<title>-.-</title>

</head>
<body>
<h3>修改商品</h3>
<form action="update.php" method="post" enctype="multipart/form-data">
<table width="70%"  border="1" cellpadding="5" cellspacing="0" bgcolor="#cccccc">
<input type="hidden" name="id" value="<?php echo $video['id'];?>" />
    <tr>
        <td align="right">商品名称</td>
        <td><input type="text" name="name" value="<?php echo $video['name'];?>" /></td>
    </tr>
    <tr>
        <td align="right">状态</td>
        <td><input type="text" name="status"  value="<?php echo $video['status'];?>"/></td>
    </tr>
    <tr>
        <td align="right">商品描述</td>
        <td>
            <textarea name="description" id="editor_id" style="width:100%;height:150px;" ><?php echo $video['description'];?></textarea>
        </td>
    </tr>
    <tr>
        <td align="right">商品图像</td>
        <td>
            <img width="100" height="100" src="<?php echo $video['img'];?>" alt=""/>
        </td>
    </tr>
    <tr>
        <td align="right">商品图像</td>
        <td>
            <input type="file" name="img" />
            <div id="attachList" class="clear"></div>
        </td>
    </tr>
    <tr>
        <td colspan="2"><input type="submit"  value="修改商品"/></td>
    </tr>
</table>
</form>
</body>
</html>