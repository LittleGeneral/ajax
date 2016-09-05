<!doctype html>
<html>
<head>
<meta charset="utf-8">
<title>-.-</title>

</head>
<body>
<h3>添加商品</h3>
<form action="insert.php" method="post" enctype="multipart/form-data">
<table width="70%"  border="1" cellpadding="5" cellspacing="0" bgcolor="#cccccc">
    <tr>
        <td align="right">商品名称</td>
        <td><input type="text" name="name"  placeholder="请输入商品名称"/></td>
    </tr>
    <tr>
        <td align="right">状态</td>
        <td><input type="text" name="status"  placeholder="状态"/></td>
    </tr>
    <tr>
        <td align="right">商品描述</td>
        <td>
            <textarea name="description" id="editor_id" style="width:100%;height:150px;"></textarea>
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
        <td colspan="2"><input type="submit"  value="添加商品"/></td>
    </tr>
</table>
</form>
</body>
</html>