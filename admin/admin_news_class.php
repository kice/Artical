<?php
	include_once ('admin_global.php');

	$r=$db->User_shell_check($id, $shell);

	if(isset($_POST['add_class'])){
		$db->query("INSERT INTO `art_newsclass` (`id`, `fid`, `name`, `keyword`, `remark`) " .
									"VALUES ('NULL', '". $_POST['fid'] ."', '". $_POST['add_class'] ."', '', '')");
		$db->Show_admin_msg("admin_news_class.php","分类添加成功");
	}

	if(isset($_GET['del'])){
		$db->query("DELETE FROM `art_newsclass` WHERE `art_newsclass`.`fid` = ".$_GET['del']);
		$db->query("DELETE FROM `art_newsclass` WHERE `art_newsclass`.`id` = ".$_GET['del']);
/*		$db->query("DELETE FROM `art_newsbase` WHERE `cid` = '$_GET[del]' LIMIT 1;");
		$db->query("DELETE FROM `art_newstext` WHERE `id` = '$_GET[del]' LIMIT 1;");*/
		$db->Show_admin_msg("admin_news_class.php","删除成功");
	}

	if(isset($_POST['class_update'])){
		$db->query("UPDATE  `art_newsclass` SET  `name` =  '".  $_POST['name'] ."' WHERE  `art_newsclass`.`id` =".$_POST['id']);
		$db->Show_admin_msg("admin_news_class.php","更新成功");
	}

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
<TH>后台 >> 新闻分类</TH></TR></TBODY></TABLE><BR>

<table border=0 cellspacing=1 align=center class=form>
	<tr>
		<th colspan="2">新闻分类</th>
	</tr>

	<form action="admin_news_class.php" method="POST">

	<tr>
		<td colspan="2" align="center" height='30'>
			<select name = "fid">
			<option value="0">顶级分类</option>
			<?php
				$query=$db->findall("art_newsclass where fid=0");
				while( $row=$db->fetch_array($query) ){
					$news_class_arr[$row['id']] = $row['name'];
					echo "<option value=\"". $row['id'] ."\">". $row['name']."</option>";
				}
			?>
		</select>
		<input type="text" name="add_class" value="" />
		<input type="submit" name="submit" value=" 添加分类 "/>
		</td>
	</tr>
	</form>
</table>

<table border=0 cellspacing=1 align=center class=form>
	<tr>
		<th colspan="2">系统分类</th>
	</tr>

	<?php
	foreach($news_class_arr as $id=>$val){
	?>
		<tr>
			<td>
				<form action="" method="POST">
						<input type="hidden" name="id" value="<?php echo $id?>" />
		  				<input type="text" name="name" value="<?php echo $val?>"/>
						<input type="submit" name="class_update" value="更新"/>
						<input type="button" onclick="location.href='?del=<?php echo $id?>'"  value=" 删除 "/>
				</form>
				<?php
					$query_fid=$db->findall("art_newsclass where fid=".$id);
					while( $row_fid=$db->fetch_array($query_fid) ){
				?>
				<form action="" method="POST">
						&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
						<input type="hidden" name="id" value"<?php echo $row_fid['id']?>" />
		  				<input type="text" name="name" value="<?php echo $row_fid['name']?>"/>
						<input type="submit" name="class_update" value="更新"/>
						<input type="button" onclick="location.href='?del=<?php echo $row_fid['id'] ?>'"  value=" 删除 "/>
				</form>
				<?php } ?>
			</td>
		</tr>
	<?php } ?>
</table>
</BODY>
</HTML>