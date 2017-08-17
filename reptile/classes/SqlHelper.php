<?php 
	/**
	* SqlHelper 数据库操作类
	*/
	class SqlHelper
	{
		public function queryAll()
		{
			$mysqli = new mysqli('127.0.0.1', 'root', '','phpcmsv9');
			if ($mysqli->connect_error) {
				die('Connect Error (' . $mysqli->connect_error() . ') '. $mysqli->connect_error());
			}
			//设置utf-8编码
			$mysqli->query('SET NAMES utf8');

			if ($result = $mysqli->query("SELECT id,title,inputtime,url from v9_python"))
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
  					//echo "------------------------------------------------------";
  				}
  				$result->close();
			}
			$mysqli->close();
		}
	}