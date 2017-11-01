<?php
namespace app\index\controller;

use \think\Session;
use \think\Controller;
use app\index\controller\Index;

class Users extends Index
{
	public function cart()
	{
		//dump(Session::get('shopcar'));
		$shopcar = array();
		$shopdetail = array();
		if(!empty(Session::get('shopcar')))
		{
			$shopcar = Session::get('shopcar');
		}
		foreach ($shopcar as $key=>$value) {
			//dump($value[0]);
			$shopdetail = $this->good->findBook($value[0]);
			array_push($shopcar[$key], $shopdetail->toArray());
		}
		//dump($shopcar);
		$this->assign('shopcar',$shopcar);
		return $this->fetch();
	}
	public function address()
	{
		return $this->fetch();
	}
	public function collection()
	{
		return $this->fetch();
	}
	public function coupon()
	{
		return $this->fetch();
	}
	public function couponUsed()
	{
		return $this->fetch();
	}
	public function main()
	{
		return $this->fetch();
	}
	public function points()
	{
		return $this->fetch();
	}
	public function settings()
	{
		return $this->fetch();
	}
	public function order()
	{
		return $this->fetch();
	}
}