<?php
session_start();
include_once ("../common/mysql.class.php"); //mysql类
include_once ("../config/config.php"); //配置参数
include_once ("common/page.class.php"); //后台专用分页类
include_once ("common/action.class.php"); //数据库操作类

$db = new action($mydbhost, $mydbuser, $mydbpw, $mydbname, "pconn", $mydbcharset); //数据库操作类.

$id = $_SESSION[id];
$shell = $_SESSION[shell];
?>