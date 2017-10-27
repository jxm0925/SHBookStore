<?php
namespace app\admin\controller;

use app\admin\controller\Index;
use app\admin\model\refund;
use think\Paginator;

class Trade extends Index
{
	//退款信息列表
	public function refund()
	{

		return $this->fetch();
	}
	//退款状态变更
	public function changeRefundStatus()
	{

	}
	//删除退款单
	public function deleteRefund()
	{

	}
	//退款详情页
	public function refund_detaile()
	{
		return $this->fetch();
	}
}