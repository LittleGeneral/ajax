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
                   <!--  <div class="details_operation clearfix">
                        <div class="bui_select">
                            <a href="./add.php"><input type="button" value="添&nbsp;&nbsp;加" class="add"></a>
                        </div>
                    </div> -->
                    <!--表格-->
                    <table class="table" cellspacing="0" cellpadding="0">
                        <thead>
                            <tr>
                                <th width="2%">编号</th>
                                <th width="10%">产品名称</th>
                                <th width="15%">图片</th>
                                <th width="10%">状态</th>
                                <th width="30%">描述</th>
                                <th>操作</th>
                            </tr>
                        </thead>
                        <tbody id="tbody"></tbody>
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
                    </li>
                </ul>
            </div>
        </div>
    </div>
</body>
<script type="text/javascript">
    // 编辑
    function edit(id){
      window.location="edit.php?id="+id;
    }

    /*//ajax异步删除 $.get方式
    function del(id) {
        if (window.confirm('确定删除id为'+id+'产品？')) {
            var url = 'del.php';
            var data = {'id':id};
            var success = function (response) {
                if (response.errno == 0) {
                    $('#del_'+id).parent().parent().remove();
                    // window.loction.reload();
                    // alert('删除成功');
                }
            };
            $.get(url,data,success,'json');
        }
    }*/

    //ajax异步删除 ajax get方式
    function del(id) {
        if (window.confirm('确定删除id为'+id+'产品？')) {
            var url     =  'del.php';
            var type    = 'get';
            var data    = {'id': id};
            var dataType= 'json';
            var success = function(response) {
                    if (response.errno ==0 ) {
                        // $(obj).parents("tr").remove();
                        // $('#del_'+id).parent().parent().remove();
                        $('#del_'+id).parents("tr").remove();
                    }
                };
            var error   = function(response) {
                    if (response.errno ==-1 ) {
                        alert('删除失败');
                    }
                };

            $.ajax({url,type,data,dataType,success,error});
        }

    }

    //ajax异步加载 $.get()方法
    function ajaxload() {
        var url = 'ajaxload.php';
        var success = function (response) {
            if (response.errno == 0) {
                var str="";
                var jsonList =response.data;
                $.each(jsonList,function(i,n){
                    str+="<tr><td>"
                            +n.id+"</td><td>"
                            +n.name+"</td><td><img width='100' height='100' src="
                            +n.img+"></td><td>"
                            +n.status+"</td><td>"
                            +n.description+"</td><td align='center'><input type='button' value='修改' class='btn' onclick='edit("
                            +n.id+")'><input type='button' value='删除' class='btn' id='del_"
                            +n.id+"' onclick='del("
                            +n.id+")'>"
                            +"</td></tr>";
              })
              $('#tbody').html(str);
            }else{
                alert('异步加载失败');
            }
        }
        $.get(url,success,'json');
    }



    //ajax异步加载 使用getJSON函数加载json数据
    function ajaxload1() {

        // $("#tbody").html("<font color=green>数据加载中。。。</font>");
          $.getJSON("ajaxload.php",function(response){
            if (response.errno == 0) {
              var str="";
              var jsonList =response.data;

              /*//方法1：each遍历 两个参数
              $.each(jsonList,function(i,n){
                    str+="<tr>"+"<td>"
                            +n.id+"</td><td>"
                            +n.name+"</td><td><img width='100' height='100' src="
                            +n.img+"></td><td>"
                            +n.status+"</td><td>"
                            +n.description+"</td><td align='center'><input type='button' value='修改' class='btn' onclick='edit("
                            +n.id+")'><input type='button' value='删除' class='btn' id='del_"
                            +n.id+"' onclick='del("
                            +n.id+")'>"
                            +"</td></tr>";
              })*/

              /*//方法2： each遍历 一个参数
              $.each(jsonList,function(i){
                   str+="<tr>"+"<td>"
                            +jsonList[i].id+"</td><td>"
                            +jsonList[i].name+"</td><td><img width='100' height='100' src="
                            +jsonList[i].img+"></td><td>"
                            +jsonList[i].status+"</td><td>"
                            +jsonList[i].description+"</td><td align='center'><input type='button' value='修改' class='btn' onclick='edit("
                            +n.id+")'><input type='button' value='删除' class='btn' id='del_"
                            +n.id+"' onclick='del("
                            +n.id+")'>"
                            +"</td></tr>";
              })*/

                /*
              //方法3：for in 遍历
              for (i in jsonList) {
                        str+="<tr>"+"<td>"
                            +jsonList[i].id+"</td><td>"
                            +jsonList[i].name+"</td><td><img width='100' height='100' src="
                            +jsonList[i].img+"></td><td>"
                            +jsonList[i].status+"</td><td>"
                            +jsonList[i].description+"</td><td align='center'><input type='button' value='修改' class='btn' onclick='edit("
                            +n.id+")'><input type='button' value='删除' class='btn' id='del_"
                            +n.id+"' onclick='del("
                            +n.id+")'>"
                            +"</td></tr>";
              }*/
              $("#tbody").html(str);
            }
          });
    }

</script>
</html>