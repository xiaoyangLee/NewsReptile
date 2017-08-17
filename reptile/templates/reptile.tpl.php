<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8">
	<title>管理</title>
	<style type="text/css">
		div{
			width: 500px;
			font-size: 20px;
			text-align: center;
			margin-left: 200px;
		}
	</style>
	<script type="text/javascript">
		//提交前对输入框做检查
		function checkSubmit() {
			var key1 = document.forms[0].keyword1.value;
				if (key1=="") {
					document.forms[0].keyword1.focus();
					window.alert("输入框不得为空！");
					return false;
				}
		}
	</script>
</head>
<body>
<?php
defined('IN_ADMIN') or exit('No permission resources.');
include $this->admin_tpl('header','admin');
?>
<div>
<h2>输入关键词可以爬取相应的新闻信息</h2>
<br>
<form action="phpcms/modules/reptile/functions/proceed.php" onsubmit="return checkSubmit()" method="post">
	新闻搜索:&nbsp;&nbsp;<input type="text" name="keyword1" class="input" style="height: 30px;width:300px;font-size: 16px">

	<input type="submit" name="submit" value="搜索一下" style="height: 37px;width: 70px;font-size: 16px">
</form>
<p style="margin-top: 30px;"><a href="phpcms/modules/reptile/functions/proceedSubmit.php">点此查看临时表中的数据</a></p>
</div>
</body>
</html>