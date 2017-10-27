<?php
namespace app\admin\controller;

use app\admin\controller\Auth;
use app\admin\model\Notice;
use \think\Session;
use think\Paginator;

class Index extends Auth
{
	protected $is_login = ['*'];
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
	//用户操作
	public function userOperate()
	{
		if(!empty($this->request->param('delId')))
		{
			$id = $this->request->param('delId');
			return $this->user->delUser($id);
		}
/*		if(!empty($this->request->param('banId')))
		{
			$id = $this->request->param('delId');
			return $this->user->banUser($id);
		}*/
	}
	public function site_config()
	{
		return $this->fetch();
	}
}
