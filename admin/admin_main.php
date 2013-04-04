<?php
	include_once ('admin_global.php');

	$r=$db->User_shell_check($id, $shell);

	if($_GET['action']=='logout')
		$db->Get_user_out();

	if(!empty($_POST['submit'])){
		//如果有提交
		//print_r($_POST);
		unset($_POST['submit']);
		foreach($_POST as $name=>$value){
			$sql =  "UPDATE art_config SET  `values` =  '". $value ."' WHERE  `name` =  '". $name ."' ;";
			$db->query($sql);
		}
		$db->Show_admin_msg("admin_main.php");
	}

	//读取配置信息
	$query = $db->findall("art_config");
	while($row = $db->fetch_array($query))
		$row_config[$row['name']]=$row['values'];

?>
<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.0 Transitional//EN">
<HTML><HEAD><TITLE>后台管理</TITLE>
<META http-equiv=Content-Type content="text/html; charset=utf-8">
<LINK href="images/private.css" type=text/css rel=stylesheet>
<META content="MSHTML 6.00.6000.16890" name=GENERATOR></HEAD>
<BODY>
<TABLE class=navi cellSpacing=1 align=center border=0>
  <TBODY>
  <TR>
<TH>后台 >> 系统配置</TH></TR></TBODY></TABLE><BR>

<table border=0 cellspacing=1 align=center class=form>
	<tr>
		<th colspan="2">系统配置</th>
	</tr>

	<form action="admin_main.php" method="POST">

	<tr>
		<td align="right">网站名称:</td>
		<td><input type="text" name="website_title" value="<?php echo $row_config['website_title']?>" size="40" maxlength="40"/>  </td>
	</tr>

	<tr>
		<td align="right">网站地址:</td>
		<td><input type="text" name="website_url" value="<?php echo $row_config['website_url']?>" size="40" maxlength="40"/>  </td>
	</tr>

	<tr>
		<td align="right">备案号:</td>
		<td><input type="text" name="website_icp" value="<?php echo $row_config['website_icp']?>" size="40" maxlength="40"/>  </td>
	</tr>

	<tr>
		<td align="right">管理员邮箱:</td>
		<td><input type="text" name="website_admin_mail" value="<?php echo $row_config['website_admin_mail']?>" size="40" maxlength="40"/>  </td>
	</tr>

	<tr>
		<td colspan="2" align="center" height='30'>
			<input type="submit" name="submit" value=" 更新 "/>
		</td>
	</tr>
	</form>
</table>
</BODY>
</HTML>