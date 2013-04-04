<?php
 /**
 *      [Artical!] (C)2013-2099 Kice Inc.
 *      This is NOT a freeware, use is subject to license terms
 *
 *      Id: index.php 2013-3-17
 */
 include_once("global.php");

 	$query=$db->query("SELECT * FROM `art_admin`");
   	$row=$db->fetch_array($query);

	$smarty->assign("website_title",$row['values']);
	$smarty->display("index.html");

?>