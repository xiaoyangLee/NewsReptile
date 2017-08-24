<?php 

	$keyword = $_GET['keyword1'];
	$pagenum = $_GET['pagenum'];
	$datanum = $_GET['datanum'];

	echo "关键词为:".$keyword;
	echo "<br>";
	echo "页数为:".$pagenum;
	echo "<br>";
	echo "数据数为:".$datanum;
	echo "<br>";
	echo "执行Python爬虫程序中，请稍后...";
	//对关键词空格进行处理
	$keyword = str_replace(' ', '%', $keyword);
	//echo $keyword;
	system("python index.py ".$keyword." ".$pagenum." ".$datanum);

	