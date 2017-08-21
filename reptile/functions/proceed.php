<?php 
	include '../classes/SqlHelper.php';

	$db = new SqlHelper();

	if ($_GET['m'] == 'insert') {
		//echo "我是处理插入数据的";
		$db->insertData();
		
	}else 
	if ($_GET['m'] == 'clear') {
		//echo "我是处理清空数据的";
		$db->deleteAll();
	}
