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

			$res = $mysqli->query("SELECT count(*) from v9_news_temp");
			$count = $res->fetch_row();
			if ($count[0]==0) {
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
			$res = $mysqli->query("SELECT count(*) from v9_news_temp");
			//将资源类型的数据转为数组
			$count = $res->fetch_row();
			//取出数组唯一一个元素,即数据条目总数
			$total = $count[0];

			//实例化Page分页类的对象,每页显示10条数据
			$page = new Page($total,10,"",true);

			//查看数据库并显示
			if ($result = $mysqli->query("SELECT id,title,inputtime,url from v9_news_temp  ".$page->limit))
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
		public function insertData($catid)
		{
			$mysqli = new mysqli('127.0.0.1', 'root', '','phpcmsv9');
			if ($mysqli->connect_error) {
				die('Connect Error (' . $mysqli->connect_error() . ') '. $mysqli->connect_error());
			}
			//设置utf-8编码
			$mysqli->query('SET NAMES utf8');
			$mysqli->query("update v9_news_temp set catid = ".$catid);

			$result = $mysqli->query("insert into v9_news (catid,
typeid,
title,
style,
thumb,
keywords,
description,
posids,
url,
listorder,
`status`,
sysadd,
islink,
username,
inputtime,
updatetime)
SELECT
v9_news_temp.catid,
v9_news_temp.typeid,
v9_news_temp.title,
v9_news_temp.style,
v9_news_temp.thumb,
v9_news_temp.keywords,
v9_news_temp.description,
v9_news_temp.posids,
v9_news_temp.url,
v9_news_temp.listorder,
v9_news_temp.`status`,
v9_news_temp.sysadd,
v9_news_temp.islink,
v9_news_temp.username,
v9_news_temp.inputtime,
v9_news_temp.updatetime
from v9_news_temp
");
			if ($result) {
				$result = $mysqli->query("insert into v9_news_data(content,
readpoint,
groupids_view,
paginationtype,
maxcharperpage,
template,
paytype,
relation,
voteid,
allow_comment,
copyfrom)
SELECT
v9_news_data_temp.content,
v9_news_data_temp.readpoint,
v9_news_data_temp.groupids_view,
v9_news_data_temp.paginationtype,
v9_news_data_temp.maxcharperpage,
v9_news_data_temp.template,
v9_news_data_temp.paytype,
v9_news_data_temp.relation,
v9_news_data_temp.voteid,
v9_news_data_temp.allow_comment,
v9_news_data_temp.copyfrom
from v9_news_data_temp
");
				if (!$result) {
					echo "表v9_news插入数据失败!";
				}
			}else
			{
				echo "表v9_news_data插入数据失败！";
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

			$result = $mysqli->query("delete from v9_news_temp");
			if ($result) {
				$result = $mysqli->query("delete from v9_news_data_temp");
				if (!$result) {
					echo "清空临时表v9_news_data_temp数据失败";
				}
			}else
			{
				echo "清空临时表v9_news_temp数据失败";
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

			$result = $mysqli->query("select catid,catname from v9_category where modelid=1");
			if ($result) {
				while($row=$result->fetch_array()){
					echo "<option value=".$row[0].">".$row[1]."</option>";
				}
			}

			$result->close();
			$mysqli->close();	
		}

		/*
		修改栏目id
		*/
		public function modify($catid)
		{
			$mysqli = new mysqli('127.0.0.1', 'root', '','phpcmsv9');
			if ($mysqli->connect_error) {
				die('Connect Error (' . $mysqli->connect_error() . ') '. $mysqli->connect_error());
			}
			//设置utf-8编码
			$mysqli->query('SET NAMES utf8');

			$result = $mysqli->query("select id,catid,url from v9_news_temp");

			if ($result) {
				//一次性改变所有数据的栏目id
				// $mysqli->query("update v9_python_test set catid = ".$catid);

				while ($row = $result->fetch_array()) {
					$mysqli->query("update v9_news set url = 'http://127.0.0.1/phpcms/index.php?m=content&c=index&a=show&catid=".$row[1]."&id=".$row[0]."' where id= ".$row[0]."");

				}
			}
			$result->close();
			$mysqli->close();
		}

		

	}