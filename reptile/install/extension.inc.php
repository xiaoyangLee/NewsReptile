<?php 
	defined('IN_PHPCMS') or exit('Access Denied');
	defined('INSTALL') or exit('Access Denied');

	$parentid = $menu_db->insert(array('name' =>'reptile' , 
		'parentid' => '29',
		'm' => 'reptile',
		'c' => 'reptile',
		'a'	=> 'init',
		'data' =>'',
		'listorder' => 0,
		'display' => '1'
		),ture);//true表示返回当前SQL插入的行号，即当前插入的菜单id，因为在插入子菜单时要用到。
		$language =array('reptile' =>'爬虫');//$language数组中的值会追加到system_menu.lang.php的$LANG变量中

 ?>