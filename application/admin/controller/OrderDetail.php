<?php
namespace app\admin\controller;

use app\admin\controller\Index;
use \think\Session;
use think\Paginator;
use think\DB;
use app\admin\model\Comment;
class OrderDetail extends Index
{
	public function orderDetail()
	{
		
		return $this->fetch('Trade/order_detaile');
	}
}