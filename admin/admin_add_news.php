<?php
	include_once ('admin_global.php');

	$r=$db->User_shell_check($id, $shell);

	if(!empty($_POST['submit'])){
		unset($_POST['submit']);
			$db->query("INSERT INTO `art_newsbase` (`id`, `cid`, `title`, `author`, `date_time`) " .
										"VALUES (NULL, '". $_POST['news_class'] ."', '". $_POST['news_title'] ."', '" .$_POST['news_author']. "', '". mktime() ."');");
			$news_id = $db->insert_id();
			$db->query("INSERT INTO `art_newstext` (`nid`, `keyword`, `text`, `remark`) " .
										"VALUES ('". $news_id ."', '". $_POST['news_keyword'] ."', '". $_POST['news_text']. "', '');");
		$db->Show_admin_msg("admin_news_list.php","新闻添加成功");
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
<TH>后台 >> 新闻  >>  增加新闻</TH></TR></TBODY></TABLE><BR>

<table border=0 cellspacing=1 align=center class=form>
	<tr>
		<th colspan="2">增加新闻</th>
	</tr>
	<form action="admin_add_news.php" method="POST">
	<tr>
		<td align="right">新闻标题:</td>
		<td><input type="text" name="news_title" value="" size="60" maxlength="40"/>  </td>
	</tr>
	<tr>
		<td align="right">新闻分类:</td>
		<td>
		<select name = "news_class">
			<?php
				$query=$db->findall("art_newsclass where fid=0");
				while( $row=$db->fetch_array($query) ){
					echo "<option value=\"". $row['id'] ."\">". $row['name']."</option>";

					$query_son = mysql_query("SELECT * FROM `art_newsclass`  where `fid`=".$row['id'] );
					while( $row_son=mysql_fetch_array($query_son) )
						echo "<option value=\"". $row_son['id'] ."\">&nbsp;&nbsp;&nbsp;". $row_son['name']."</option>";
				}
			?>
		</select></td>
	</tr>
	<tr>
		<td align="right">新闻作者:</td>
		<td><input type="text" name="news_author" value="" size="30" maxlength="40"/>  </td>
	</tr>
	<tr>
		<td align="right">关键字:</td>
		<td><input type="text" name="news_keyword" value="" size="80" maxlength="40"/>  </td>
	</tr>
	<tr>
		<td align="right">新闻内容:</td>
		<td><textarea class="ckeditor" cols="150" id="news_text" name="news_text" rows="40"></textarea></td>
	</tr>
	<tr>
		<td colspan="2" align="center" height='30'>
			<input type="submit" name="submit" value=" 增加新闻 "/>
		</td>
	</tr>
	</form>
</table>
<script src="../common/ckeditor/ckeditor.js"></script>
</BODY>
</HTML>