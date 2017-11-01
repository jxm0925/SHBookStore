<?php
namespace app\admin\controller;

use app\admin\controller\Index;
use \think\Session;
use think\Paginator;
use think\DB;

class Admin extends Index
{
	public function adminList()
	{
		return $this->fetch('admin_list');
	}
	public function limit()
	{
		return $this->fetch();
	}
	public function role()
	{
		return $this->fetch();
	}
	public function roleEdit()
	{
		return $this->fetch('role_edit');
	}
}