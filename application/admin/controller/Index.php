<?php
namespace app\admin\controller;

use app\admin\controller\Auth;
use app\admin\model\Notice;
use app\admin\model\User;
use \think\Session;
use think\Paginator;

class Index extends Auth
{
	protected $is_login = ['*'];
	protected $user;
	//初始化
	public function _initialize()
	{
		$this->user = new User();
	}
	public function index()
	{
		$list = Notice::all();
		$this->assign('list',$list);
		return $this->fetch();
	}
	//用户管理
	public function member_list()
	{
		$list = $this->user->listUser()->paginate(5);
		$this->assign('list',$list);
		return $this->fetch();
	}
	public function site_config()
	{
		return $this->fetch();
	}
}
