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

                            <h3>添加商品</h3>
                            <form action="insert.php" method="post" enctype="multipart/form-data">
                                <table width="70%"  border="1" cellpadding="5" cellspacing="0" bgcolor="#cccccc">
                                    <tr>
                                        <td align="right">商品名称</td>
                                        <td>
                                            <input type="text" name="name"  placeholder="请输入商品名称"/>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td align="right">状态</td>
                                        <td>
                                            <input type="text" name="status"  placeholder="状态"/>
                                        </td>
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
                                        <td colspan="2">
                                            <input type="submit"  value="添加商品"/>
                                        </td>
                                    </tr>
                                </table>
                            </form>
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
</html>