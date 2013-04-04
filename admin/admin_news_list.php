<?php
include_once ('admin_global.php');

	$r=$db->User_shell_check($id, $shell);

	 $query=$db->findall("art_newsclass");
	    while ($row=$db->fetch_array($query)) {
	    	$news_class_arr[$row[id]]=$row[name];
		}

	if(isset($_GET[del])){
		mysql_query("DELETE FROM `art_newsbase` WHERE `id` = '$_GET[del]' LIMIT 1;");
		mysql_query("DELETE FROM `art_newstext` WHERE `nid` = '$_GET[del]' LIMIT 1;");
		$db->Show_admin_msg("admin_news_list.php","删除成功");
	}
?>
<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.0 Transitional//EN">
<HTML><HEAD><TITLE>后台管理</TITLE>
<META http-equiv=Content-Type content="text/html; charset=uft-8">
<LINK href="images/private.css" type=text/css rel=stylesheet>
<META content="MSHTML 6.00.6000.16890" name=GENERATOR></HEAD>
<BODY>
<TABLE class=navi cellSpacing=1 align=center border=0>
  <TBODY>
  <TR>
    <TH>后台 >> 新闻管理</TH></TR></TBODY></TABLE><BR>

	<table border=0 cellspacing=1 align=center class=form>
	<tr>
		<th width='100'>新闻分类</th><th>新闻标题</th><th width='100'>作者</th><th width='100'>日期</th><th width='100'>操作</th>
	</tr>
	<tr>
		<?php
		    $result = mysql_query("select id from art_newsbase");
		    $total = mysql_num_rows($result);
		    pageft($total, 20);
		    if ($firstcount < 0)
		    	 $firstcount = 0;
		   $query = $db->findall("art_newsbase limit  $firstcount, $displaypg");
		   while ($row = $db->fetch_array($query)) {
	   	?>
			<td><?php echo $news_class_arr[$row[cid]]?></td>
			<td><?php echo $row[title]?></td>
			<td><?php echo $row[author]?></td>
			<td><?php echo date("Y-m-d H:i",$row[date_time])?></td>
			<td><a href='?del=<?php echo $row[id]?>'>删除</a> /
			<a href='admin_edit_news.php?id=<?php echo $row[id]?>'>修改</a></td>
			</tr>
		<?php } ?>
	<tr>
		<th colspan="5"><?php echo $pagenav;?></th>
	</tr>
	</table>
<br>
	</BODY></HTML>