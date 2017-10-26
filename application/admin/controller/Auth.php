<?php
namespace app\admin\controller;

use think\Controller;
use \think\Session;
use app\admin\model\Admin;

class Auth extends Controller
{
	protected $is_login = [''];
	public function _initialize()
	{
		if (!$this->checklogin() && in_array('*', $this->is_login)) {
			$this->error('没有登录请登录', url('admin/auth/login'));
		}
	}
	public function login()
	{
		return $this->fetch();
	}
	public function checklogin()
	{
		return session('?admin_id');
	}
	public function dologin()
	{
		
		$info = Admin::where('admin_name', $this->request->param('name'))->where('admin_pwd',md5($this->request->param('pwd')))->find();
		//dump($info);
		if ($info) {
			session('admin_id',$info->admin_id);
			$this->success('登录成功', url('admin/index/index'));
		} else {
			$this->error('登录失败', url('admin/auth/login'));
		}
	}
	public function logout()
	{
		session('admin_id',null);
		return $this->fetch('login');
	}
}