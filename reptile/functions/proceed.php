<?php 
	include '../classes/SqlHelper.php';

	$db = new SqlHelper();

	if ($_GET['m'] == 'insert') {
	
		//获取用户选择的栏目
		$catid = $_GET['catid'];
		//插入数据
		$db->insertData($_GET['catid']);
		//修改url
		$db->modify($catid);
		//$db->deleteAll();
		echo "插入数据成功，2秒后返回...";

		//延时跳转 
		header("Refresh:2;url=proceedSubmit.php");
		
	}else 
	if ($_GET['m'] == 'clear') {
		$db->deleteAll();
		echo "清空数据成功,2秒后返回...";
 
		//延时跳转
		header("Refresh:2;url=proceedSubmit.php");
	}
