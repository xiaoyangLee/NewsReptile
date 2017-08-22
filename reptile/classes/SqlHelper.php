<?php 
	/**
	* SqlHelper 数据库操作类
	*/
	include 'Page.php';

	class SqlHelper
	{
		//查看临时表中数据是否为空
		public function dataIsNull()
		{
			$mysqli = new mysqli('127.0.0.1', 'root', '','phpcmsv9');
			if ($mysqli->connect_error) {
				die('Connect Error (' . $mysqli->connect_error() . ') '. $mysqli->connect_error());
			}
			//设置utf-8编码
			$mysqli->query('SET NAMES utf8');

			$result = $mysqli->query("select * from v9_python");
			if ($result) {
				return true;	
			}else
			{
				return false;
			}
	}

		//查询临时表中的数据
		public function queryAll()
		{
			$mysqli = new mysqli('127.0.0.1', 'root', '','phpcmsv9');
			if ($mysqli->connect_error) {
				die('Connect Error (' . $mysqli->connect_error() . ') '. $mysqli->connect_error());
			}
			//设置utf-8编码
			$mysqli->query('SET NAMES utf8');

			//查询数据中所有的条目数，存在变量$total中
			$res = $mysqli->query("SELECT count(*) from v9_python");
			//将资源类型的数据转为数组
			$count = $res->fetch_row();
			//取出数组唯一一个元素,即数据条目总数
			$total = $count[0];

			//实例化Page分页类的对象,每页显示10条数据
			$page = new Page($total,10,"",true);

			//查看数据库并显示
			if ($result = $mysqli->query("SELECT id,title,inputtime,url from v9_python  ".$page->limit))
			{

				while($row=$result->fetch_array()){	
   					echo "<tr>";
   					echo "<td>";
   					echo $row[0];
  					echo "</td>";

  					echo "<td>";
   					echo "<a href=".$row[3]." target='_blank'>".$row[1]."</a>";
  					echo "</td>";

  					echo "<td>";
   					echo date('r',$row[2]);
  					echo "</td>";
  					echo "</tr>";
  				}
  				//分页功能的底层栏显示
  				echo "<tr><td colspan='3'>".$page->fpage()."</td></tr>";
  				$result->close();
			}
			$mysqli->close();
		}

		/*
		将从临时表里获取的数据插入到正式的表中
		*/
		public function insertData()
		{
			$mysqli = new mysqli('127.0.0.1', 'root', '','phpcmsv9');
			if ($mysqli->connect_error) {
				die('Connect Error (' . $mysqli->connect_error() . ') '. $mysqli->connect_error());
			}
			//设置utf-8编码
			$mysqli->query('SET NAMES utf8');

			$result = $mysqli->query("insert into v9_python_test (SELECT * from v9_python)");
			if ($result) {
				$result = $mysqli->query("insert into v9_python_data_test (SELECT * from v9_python_data)");
				if (!$result) {
					echo "表v9_python_test插入数据失败!";
				}
			}else
			{
				echo "表v9_python_data_test插入数据失败！";
			}
			//$result->close();
			$mysqli->close();

			
		}

		/**
		清空临时表数据
		*/	
		public function deleteAll()
		{
			$mysqli = new mysqli('127.0.0.1', 'root', '','phpcmsv9');
			if ($mysqli->connect_error) {
				die('Connect Error (' . $mysqli->connect_error() . ') '. $mysqli->connect_error());
			}
			//设置utf-8编码
			$mysqli->query('SET NAMES utf8');

			$result = $mysqli->query("delete from v9_python_test");
			if ($result) {
				$result = $mysqli->query("delete from v9_python_data_test");
				if (!$result) {
					echo "清空临时表v9_python_data数据失败";
				}
			}else
			{
				echo "清空临时表v9_python数据失败";
			}

			//$result->close();
			$mysqli->close();
		}

		/*
		查询栏目id
		*/
		public function queryCat()
		{
			$mysqli = new mysqli('127.0.0.1', 'root', '','phpcmsv9');
			if ($mysqli->connect_error) {
				die('Connect Error (' . $mysqli->connect_error() . ') '. $mysqli->connect_error());
			}
			//设置utf-8编码
			$mysqli->query('SET NAMES utf8');

			$result = $mysqli->query("select catid,catname from v9_category WHERE catid > 5");
			if ($result) {
				while($row=$result->fetch_array()){
					echo "<option>".$row[0]."_".$row[1]."</option>";
				}
			}

			$result->close();
			$mysqli->close();	
		}
		
	}