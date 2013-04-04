<?php
class action extends mysql {

	/**
	 * 用户权限判断($uid, $shell, $m_id)
	 */

	public function Get_user_shell($id, $shell) {
		$query = $this->select('art_admin', '*', '`id` = \'' . $id . '\'');
		$us = is_array($row = $this->fetch_array($query));
		$shell = $us ? $shell == md5($row[username] . $row[password] . "KICE_PASS") : FALSE;
		return $shell ? $row : NULL;
	} //end shell

	public function User_shell_check($id, $shell, $m_id = 1, $isback=TRUE) {
		if ($row=$this->Get_user_shell($id, $shell)) {
			if ($row[m_id] = $m_id) {
				return $row;
			}
			else {
				echo "你无权限操作！";
				exit ();
			} //end m_id
		}
		else {
			if($isback){
				$this->Show_admin_msg('index.php','请先登陆');
			}

		}
	} //end shell
	//========================================


	/**
	 * 用户登陆超时时间(秒)
	 */
	public function Get_user_ontime($long = '3600') {
		$new_time = mktime();
		$onlinetime = $_SESSION[ontime];
		echo $new_time - $onlinetime;
		if ($new_time - $onlinetime > $long) {
			echo "登录超时";
			session_destroy();
			exit ();
		} else {
			$_SESSION[ontime] = mktime();
		}
	}

	/**
	 * 用户登陆
	 */
	public function Get_user_login($username, $password) {
		$username = str_replace(" ", "", $username);

		$query = $this->select('art_admin', '*', '`username` = \'' . $username . '\'');

		$us = is_array($row = $this->fetch_array($query));
		;
		$ps = $us ? md5($password."_ART") == $row[password] : FALSE;
		if ($ps) {
			//用户ID
			$_SESSION[id] = $row[id];
			//用户登录令牌
			$_SESSION[shell] = md5($row[username] . $row[password] . "KICE_PASS");
			$_SESSION[ontime] = mktime();
			$this->Show_admin_msg('main.php','登陆成功！');
		} else {
			$this->Show_admin_msg('index.php','密码或用户错误！');
			session_destroy();
		}
	}
	 /**
	  * 用户退出登陆
	  */
	public function Get_user_out() {
		session_destroy();
		$this->Show_admin_msg('index.php','退出成功！');
	}

   /**
    * 后台通用信息提示
    */
	public function Show_admin_msg($url, $show = '操作已成功！') {
		$msg = '<!DOCTYPE html><link rel="stylesheet" href="css/common.css" type="text/css" /><meta charset="utf-8"><meta http-equiv="refresh" content="2; URL=' . $url . '" /><title>管理区域</title></head><body><div id="man_zone"><table width="30%" border="1" align="center"  cellpadding="3" cellspacing="0" class="table" style="margin-top:100px;"><tr><th align="center" style="background:#cef">信息提示</th></tr><tr><td><p>' . $show . '<br>2秒后返回指定页面！<br>如果浏览器无法跳转，<a href="' . $url . '">请点击此处</a>。</p></td></tr></table></div></body></html>';
		echo $msg;
		exit ();
	}

	//========================
} //end class
?>