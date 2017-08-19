<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8">
	<title>Proceed Submit</title>
	<style type="text/css">
		.top{
			
			margin-top: 10px;
			text-align: center;
		}
		.btn{
			width: 70px;
		}
	</style>
	<script type="text/javascript" src="js/jquery-3.2.1.min.js">
	</script>
	<script type="text/javascript">
		function insertData() {
			window.alert("插入数据库");
		}
		function clearData() {
			var i = window.confirm("确定要清理数据吗？");
			alert(i);
		}
	</script>
</head>
<body>
<div class="top">
<p>请选择是否将已经爬取到的数据存入到数据库之中？若点击"否"将清空这次爬取的所有数据。<p>
<button class="btn" onclick="insertData()">是</button>
<button class="btn" onclick="clearData()">否</button>
</div>
<?php 
	include '../classes/SqlHelper.php';
	$sqlhelper = new SqlHelper();
	echo "<table border='1' bordercolor='gray'>";
	$sqlhelper->queryAll();
	echo "</table>";
 ?>
</body>
</html>