<?php
/*
分页函数

* Created on 2011-07-28
* Author : LKK , http://lianq.net
* 使用方法：
require_once('mypage.php');
//获取每页显示数量
//$pageSize = isset($_GET['pagesize']) ? $_GET['pagesize'] : 5;
$result=mysql_query("select * from mytable", $myconn);
$total=mysql_num_rows($result);    //取得信息总数

//pageDivide($total,$pageSize);     //调用分页函数
pageDivide($total,10);     //调用分页函数

//数据库操作
$result=mysql_query("select * from mytable limit $offset,$pageSize", $myconn);
while($row=mysql_fetch_array($result)){
...您的操作($videos[] = $row;)
}
echo $pageList;    //在分页位置输出分页导航内容即可
*/


if(!function_exists("pageDivide")){
	#$total     信息总数
	#$pageSize    显示数量,默认20
	#$url     本页链接
	function pageDivide($total,$pageSize=15,$url=''){

		#$page 当前页码
		#$offset mysql数据库起始项
		#$pageList    分页导航内容
		global $page,$offset,$pageList,$_SERVER;
		$GLOBALS["pageSize"]=$pageSize;

		if(isset($_GET['page'])){
			$page=$_GET['page'];
		}else {
			$page=1;
		}

		#如果$url使用默认,即空值,则赋值为本页URL
		if(!$url){
		 $url=$_SERVER["REQUEST_URI"];
		}

		#URL分析
		$parse_url=parse_url($url);
		@$url_query=$parse_url["query"];    //取出在问号?之后内容

		if($url_query){
			$url_query=preg_replace("/(&?)(page=$page)/","",$url_query);
			$url = str_replace($parse_url["query"],$url_query,$url);
			if($url_query){
				$url .= "&page";
			}else $url .= "page";
		}else{
			$url .= "?page";
		}

		#页码计算
		$lastpg   =ceil($total/$pageSize);    //最后页,总页数
		$page     =min($lastpg,$page);
		$prepg    =$page-1; //上一页
		$nextpg   =($page==$lastpg ? 0 : $page+1); //下一页
		$offset =($page-1)*$pageSize;

		$showPage = 5;
		$pageoffset = ($showPage-1)/2;

		#开始分页导航内容
		$pageList = "";
		// $pageList = "共 <B>$total</B> 条记录,显示第 ".($total?($offset+1):0)."-".min($offset+$pageSize,$total)." 条记录";
		if($lastpg<=1) return false;    //如果只有一页则跳出

		if($page!=1) $pageList .=" <a href='$url=1'>首页</a> "; else $pageList .=" 首页 ";
		if($prepg) $pageList .=" <a href='$url=$prepg'>«上一页</a> "; else $pageList .=" «上一页 ";

		//初始化数据
		$start = 1;
		$end = $lastpg;
		if ($lastpg > $showPage) {
			// 头部省略
			if ($page > $pageoffset + 1) {
				$pageList.="...";
			}

			if ($page > $pageoffset) {
				$start = $page - $pageoffset;
				$end = $lastpg > $page+$pageoffset?$page+$pageoffset:$lastpg;
			}else {
				$start = 1;
				$end = $lastpg > $showPage ? $showPage:$lastpg;
			}

			if ($page + $pageoffset > $lastpg) {
				$start = $start-($page + $pageoffset - $end);
			}

			for ($i = $start; $i < $end; $i++) {
				$pageList.="<a href='".$_SERVER['PHP_SELF']."?page=".$i."'>{$i}</a> ";
			}

			// 尾部省略
			if ($lastpg > $page + $pageoffset){
				$pageList.="...";
			}
		}


		if($nextpg) $pageList .=" <a href='$url=$nextpg'>下一页»</a> "; else $pageList .=" 下一页» ";
		if($page!=$lastpg) $pageList.=" <a href='$url=$lastpg'>尾页</a> "; else $pageList .=" 尾页 ";

		$pageList .= "共 $lastpg 页 <B>$total</B> 条";
		#下拉跳转列表,循环列出所有页码
		$pageList .="　第 <select name='topage' size='1' onchange='window.location=\"$url=\"+this.value'>\n";
		for($i=1;$i<=$lastpg;$i++){
			if($i==$page){
			 	$pageList .="<option value='$i' selected>$i</option>\n";
			}else{
				$pageList .="<option value='$i'>$i</option>\n";
			}
		}
		$pageList .="</select> 页，第".($total?($offset+1):0)."-".min($offset+$pageSize,$total)."条";

		// 使用输入框输入来跳转到相应页面
		$pageList .="<form action='listPage.php' method='get'>";
		$pageList .="到第<input style='border:1px solid black' type='text' size='2' name='page'>页";
		$pageList .="<input style='border:1px solid black' type='submit' value='确定'>";
		$pageList .="</form>";
	}
}else die('pageDivide()同名函数已经存在!');

?>