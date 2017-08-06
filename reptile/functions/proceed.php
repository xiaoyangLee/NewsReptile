<?php 
	echo "正在处理中，请稍后......";
	echo "<br>";
	$str  = $_POST['keyword1'];

	#处理用户输入的空格,填以/符号
	$str = str_replace(" ","/",$str);

	//echo $str;

	system("python index.py ".$str);
	
	echo "<br>";
	echo "处理完成！请到模块->全站搜索->重建索引 中重建索引，否则搜索功能无法检索到新闻。";
 ?>