<?php 
//此文件放在phpcms/model目录下
defined('IN_PHPCMS') or exit('No permission resources.');
pc_base::load_sys_class('model', '', 0);

class reptile_model extends model {

	public function __construct()
	{
		$this->db_config = pc_base::load_config('database');
		$this->db_setting = 'default';
		$this->table_name = 'v9_reptile';
		parent::__construct();
	}

}

 ?>