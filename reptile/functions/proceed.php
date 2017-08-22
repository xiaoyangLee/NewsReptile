<?php 
	include '../classes/SqlHelper.php';

	$db = new SqlHelper();

	if ($_GET['m'] == 'insert') {
		//$db->insertData();
		echo "插入数据成功，2秒后返回...";
		//延时跳转
		header("Refresh:2;url=proceedSubmit.php");
		
	}else 
	if ($_GET['m'] == 'clear') {
		//$db->deleteAll();
		echo "清空数据成功,2秒后返回...";

		//延时跳转
		header("Refresh:2;url=proceedSubmit.php");
	}
