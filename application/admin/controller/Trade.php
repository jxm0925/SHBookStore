<?php
namespace app\admin\controller;

use app\admin\controller\Index;
use app\admin\model\refund;

class Trade extends Index
{
	public function refund()
	{
		return $this->fetch();
	}
	public function refund_detaile()
	{
		return $this->fetch();
	}
}