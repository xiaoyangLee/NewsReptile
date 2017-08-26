<!DOCTYPE html>
<html>
<head>
	<script type="text/javascript" src="js/jquery-3.2.1.min.js"></script>
	<?php 
		include '../classes/SqlHelper.php';
		$db = new SqlHelper();
		// $isnull = $db->dataIsNull();
		// if (!$isnull) {
		// 	echo "<h3>临时表中没有数据。</h3>";
		// 	echo "<script>";
		// 	echo "$(document).ready(function(){";
		// 	echo "$('.top').hide();";
		// 	echo "});";
		// 	echo "</script>";
		// }
	 ?>
	<meta charset="utf-8">
	<title>Proceed Submit</title>
	<style type="text/css">
		.top{
			margin-top: 10px;
			text-align: center;
			/*display: inline;*/
		}
		.btn{
			margin-left: 20px;
			width: 50px;
		}
		.cat{
			margin-top: 10px;
			text-align: center;
			display: none;
		}
		.data{
			position: absolute;
			margin-top: 30px;
			margin-left: 10px;
		}

	</style>

	<script type="text/javascript">
	
		$(document).ready(function(){
  			$("#btnY").click(function(){
  				$(".top").hide();
    			$(".cat").fadeIn();
  			});

  			$("#cfmCat").click(function() {
  				//window.location.href = "proceed.php?m=insert";
  				var sel = document.getElementById("select")
  				//获取被选择的栏目id
  				var val = sel.options[sel.selectedIndex].value;
  				window.location.href = "proceed.php?m=insert&catid="+val;
  			});

  			$("#cancel").click(function() {
  				alert("我是取消存入数据库的操作！");
  				$(".cat").hide();
    			$(".top").fadeIn();
  			});
		});

		//清空数据函数
		function clearData() {
			var i = window.confirm("确定要清理数据吗？");
			if (i==true) {
				window.location.href = "proceed.php?m=clear";
			}
		}
	</script>
</head>
<body>
 <div class="cat">
 请选择要存入到的栏目：<select id="select">
<?php 

	$db->queryCat();
 ?>
</select>
<button class="btn" id="cfmCat">确定</button>
<button class="btn" id="cancel">取消</button>
 </div>
<div class="top">
<p>请选择是否将已经爬取到的数据存入到数据库之中？若点击"否"将清空这次爬取的所有数据。<p>
<button class="btn" id="btnY">是</button>
<button class="btn" onclick="clearData()">否</button>
</div>
<div class="data">
<?php 
	echo "<table border='1' bordercolor='gray'>";
	$db->queryAll();
	echo "</table>";
 ?>
 </div>
</body>
</html>