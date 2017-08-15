<?php 
	/**
	* 
	*/
	class SqlHelper
	{
		public function queryAll()
		{
			$mysqli = new mysqli('127.0.0.1', 'root', '','phpcmsv9');
			if ($mysqli->connect_error) {
				die('Connect Error (' . $mysqli->connect_errno . ') '. $mysqli->connect_error);
			}
			//设置utf-8编码
			$mysqli->query('SET NAMES utf8');

			if ($result = $mysqli->query("SELECT id,title from v9_python")
			{
				
			}
		}
	}