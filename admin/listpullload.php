<?php
require_once('./db.php');
// http://app.com/list.php?page=1&pagesize=12
$connect = Db::getInstance()->connect();

$page = isset($_GET['page']) ? $_GET['page'] : 1;
$pageSize = isset($_GET['pagesize']) ? $_GET['pagesize'] : 7;

if(!is_numeric($page) || !is_numeric($pageSize)) {
    return Response::show(401, '数据不合法');
}

$offset = ($page - 1) * $pageSize;

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
                <div class="title"><a href="./index.php" class="icon icon_i">首页</a></div>
                <div class="details">
                    <div class="details_operation clearfix">
                        <!-- <div class="bui_select">
                            <a href="./add.php"><input type="button" value="添&nbsp;&nbsp;加" class="add"></a>
                        </div> -->
                    </div>
                    <!--表格-->
                    <table class="table" cellspacing="0" cellpadding="0">
                        <thead>
                            <tr>
                                <th width="2%">编号</th>
                                <th width="10%">产品名称</th>
                                <th width="15%">图片</th>
                                <th width="10%">状态</th>
                                <th width="30%">描述</th>
                            </tr>
                        </thead>
                        <tbody id="tbody">
                             <?php
                                foreach ($videos as $video):?>
                                <tr>
                                    <td>
                                        <label for="c1" class="label"><?php echo $video['id'];?></label></td>
                                    <td><?php echo $video['name'];?></td>
                                    <td><img width="100" height="100" src="<?php echo $video['img'];?>" alt=""/></td>
                                    <td><?php echo $video['status'];?></td>
                                    <td><?php echo $video['description'];?></td>
                                </tr>
                              <?php  endforeach;?>
                        </tbody>
                    </table>
                </div>
                <div class="nodata"></div>
                <!-- <div style="text-align:center">
                    <button><a href="javascript:void(0)" onclick="ajaxload()">ajax异步加载列表</a></button>
                </div> -->
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
                            <!-- <dd><a href="javascript:ajaxload()">ajax异步加载</a></dd> -->
                            <dd><a href="javascript:void(0)" onclick="ajaxload()">ajax异步加载列表</a></dd>
                        </dl>
                        <dl>
                            <!-- <dd><a href="./add.php"><input type="button" value="添&nbsp;&nbsp;加" class="add"></a></dd> -->
                            <dd><a href="./add.php">添&nbsp;&nbsp;加</a></dd>
                        </dl>
                        <dl>
                            <dd><a href="./listPage.php">带分页列表</a></dd>
                        </dl>
                        <dl>
                            <dd><a href="./listpullload.php">下拉无刷新列表</a></dd>
                        </dl>
                    </li>
                </ul>
            </div>
        </div>
    </div>
</body>

<script type="text/javascript">
    //ajax下拉异步刷新加载
     $(function(){
          var winH = $(window).height(); //页面可视区域高度
          var i = 2; //设置当前页数
          $(window).scroll(function () {
            var pageH = $(document.body).height();
            var scrollT = $(window).scrollTop(); //滚动条top
            var aa = (pageH-winH-scrollT)/winH;
            if(aa<0.02){
              $.getJSON("ajaxpullload.php",{page:i},function(data){
                if(data){
                  var str = "";
                  $.each(data,function(index,n){
                        str+="<tr><td>"
                            +n.id+"</td><td>"
                            +n.name+"</td><td><img width='100' height='100' src="
                            +n.img+"></td><td>"
                            +n.status+"</td><td>"
                            +n.description+"</td></tr>";
                        $("#tbody").append(str);
                  })
                  i++;
                }else{
                  $(".nodata").html("别滚动了，已经到底了。。。");
                  return false;
                }
              });
            }
          });
    });

</script>
</html>