<?php 
	defined('IN_PHPCMS') or exit('No permission resources.');
	pc_base::load_app_class('admin','admin',0);
	
	class reptile extends admin{
		function __construct(){
			parent::__construct();
		}

		public function init()
		{
			include $this->admin_tpl('reptile');
			// echo "测试测试";
		}
	}

 ?>