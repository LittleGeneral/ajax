<?php
require_once('./db.php');

// http://app.com/list.php?page=1&pagesize=12

$connect = Db::getInstance()->connect();

$page = isset($_GET['page']) ? $_GET['page'] : 1;
$pageSize = isset($_GET['pagesize']) ? $_GET['pagesize'] : 4;

// $pageCount =

if(!is_numeric($page) || !is_numeric($pageSize)) {
    return Response::show(401, '数据不合法');
}

$offset = ($page - 1) * $pageSize;

// $sql = "select * from video";
// $sql = "select * from video where status = 1 order by orderby desc limit ". $offset ." , ".$pageSize;
$sql = "select * from video where status = 1 order by id desc limit ". $offset ." , ".$pageSize;

$result = mysql_query($sql, $connect);
while($video = mysql_fetch_assoc($result)) {
        $videos[] = $video;
    }
 ?>

<!doctype html>
<html>
<head>
<meta charset="utf-8">
<title>-.-</title>
<link rel="stylesheet" href="style/backstage.css">
<!-- <script type="text/javascript" src="http://apps.bdimg.com/libs/jquery/1.7.2/jquery.min.js"></script> -->
<script type="text/javascript" src="js/jquery1.7.2.min.js"></script>
</head>

<body>
    <div class="head">
            <div class=" fl"><a href="#"></a></div>
            <h3 class="head_text fr">--==--</h3>
    </div>
    <div class="operation_user clearfix">
        <!-- <div class="link fl">
            <a href="#">owifi后台</a>
            <span>&gt;&gt;</span>
            <a href="#">产品管理</a>
            <span>&gt;&gt;</span>
            产品修改
        </div> -->
        <!-- <div class="link fr">
            <a href="#" class="icon icon_i">首页</a>
            <span></span>
            <a href="#" class="icon icon_j">前进</a>
            <span></span>
            <a href="#" class="icon icon_t">后退</a>
            <span></span>
            <a href="#" class="icon icon_n">刷新</a>
            <span></span>
            <a href="#" class="icon icon_e">退出</a>
        </div> -->
    </div>
    <div class="content clearfix">
        <div class="main">
            <!--右侧内容-->
            <div class="cont">
                <div class="title">管理</div>
                <div class="details">
                    <div class="details_operation clearfix">
                        <div class="bui_select">
                            <a href="./add.php"><input type="button" value="添&nbsp;&nbsp;加" class="add"></a>
                        </div>
                    </div>
                    <!--表格-->
                    <table class="table" cellspacing="0" cellpadding="0">
                        <thead>
                            <tr>
                                <th width="2%">编号</th>
                                <th width="10%">产品名称</th>
                                <th width="15%">图片</th>
                                <th width="5%">折扣</th>
                                <th width="10%">来源</th>
                                <th width="10%">标签</th>
                                <th width="10%">状态</th>
                                <th width="30%">描述</th>
                                <th>操作</th>
                            </tr>
                        </thead>
                        <tbody>

                            <?php
                                foreach ($videos as $video):?>

                                <tr>
                                    <td>
                                        <label for="c1" class="label"><?php echo $video['id'];?></label></td>
                                    <td><?php echo $video['name'];?></td>
                                    <td><img width="100" height="100" src="<?php echo $video['img'];?>" alt=""/></td>
                                    <td><?php echo $video['discount'];?></td>
                                    <td><?php echo $video['source'];?></td>
                                    <td><?php echo $video['tag'];?></td>
                                    <td><?php echo $video['status'];?></td>
                                    <td><?php echo $video['description'];?></td>
                                    <td align="center">

                                     <input type="button" value="修改" class="btn" onclick="edit(<?php echo $video['id'];?>)">
                                     <br><br>
                                     <input type="button" value="删除" class="btn" id="del_<?php echo $video['id'];?>" onclick="del(<?php echo $video['id'];?>)">
                                     <!-- <a href="javascript:del(<?php echo $video['id'];?>)" id="del">删除</a> -->
                                      <!-- <a href="javascript:void(0)" onclick="del(<?php echo $video['id'];?>)" id="del">删除</a> -->
                                     </td>
                                </tr>
                              <?php  endforeach;?>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>


        <!--左侧列表-->
        <div class="menu">
            <div class="cont">
                <div class="title">管理员</div>
                <ul class="mList">
                     <li>
                        <h3><span>-</span>管理</h3>
                        <dl>
                            <dd><a href="#">产品列表</a></dd>
                        </dl>
                    </li>
                </ul>
            </div>
        </div>
    </div>
</body>

<script type="text/javascript">

    function edit(id){
            window.location="edit.php?id="+id;
    }
    // function del(id){
    //         if(window.confirm("您确定要删除吗？删除之后不可以恢复哦！！！")){
    //             window.location="del.php?id="+id;
    //         }
    // }

    //ajax异步删除
    function del(id) {
        if (window.confirm('确定删除id为'+id+'产品？')) {
            var url = 'del.php';
            var data = {'id':id};
            var success = function (response) {
                if (response.errno == 0) {
                    $('#del_'+id).parent().parent().remove();
                    // window.loction.reload();
                }
            };
            $.get(url,data,success,'json');
        }
    }

</script>
</html>