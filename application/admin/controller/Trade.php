<?php
namespace app\admin\controller;

use app\admin\controller\Index;
use app\admin\model\Refund;
use think\Paginator;
use app\admin\model\Order;
use app\index\controller\Users;
use app\admin\model\Express;
use app\admin\model\User;

class Trade extends Index
{
	//退款信息列表
	public function refund()
	{	
		$refund = new Refund();
		$result = Refund::getRefundInfo();
		if (!$result->isEmpty()) {
			foreach ($result as $value) {
				$data[$value['order_num']][] = array(
					'good_name'		=>$value['good_name'],
					'create_time'	=>$value['create_time'],
					'totalmoney'	=>$value['order_totalmoney'],
					'refund_status' =>$value['refund_status'],
					'refund_details'=>$value['refund_details'],
					'refund_time'	=>$value['refund_time'],
					'refund_id'		=>$value['refund_id'],
					'user_id'		=>$value['user_id'],

					);
			}
			$count = count($data);
			$this->assign('count',$count);
			$this->assign('data',$data);
		}
		return $this->fetch();		
	}
	//退款状态变更
	public function changeRefundStatus()
	{
		$data = $this->request->param();
		$order_num = $data['order_num'];
		$refund = new Refund();
		$re = $refund->save(['refund_status'=>1],['order_num'=>$order_num]);
		if ($re) {
			$code=1;
		}else{
			$code=0;
		}
		return json_encode($code);
	}
	//删除退款单
	public function deleteRefund()
	{
		$data = $this->request->param();
		$order_num = $data['order_num'];
		$re = Refund::destroy(['order_num'=>$order_num]);
		if ($re) {
			$code=1;
		}else{
			$code=0;
		}
		return json_encode($code);
	}
	//退款详情页
	public function refund_detaile()
	{
		$data = $this->request->param();
		// dump($data);
		$user_id = $data['userid'];
		$refund_id = $data['refund_id'];
		$order_num = $data['order_num'];
		$userInfo = User::where('user_id',$user_id)->select();
		$refundInfo = Refund::where('refund_id',$refund_id)->select();
		$orderInfo = Order::where('order_num',$order_num)->select();
		$this->assign([
				'userInfo'=>$userInfo,
				'refundInfo'=>$refundInfo,
				'orderInfo'=>$orderInfo
			]);
		// dump($userInfo[0]['username']);	
		return $this->fetch();
	}
	public function tradePage()
	{
		return $this->fetch('Trade/trade');
	}
	public function order()
	{
		$result = Order::orderInfo();
		$data = Users::commonMethod($result);
		$page = $result->render();
		//快递公司
		$express = Express::select();
		// foreach ($express as $key => $value) {
		// 	echo $value['express_id'];
		// }
		// dump($express);die;
		$this->assign('express',$express);
		$this->assign('page', $page);
		$this->assign('data',$data);
		// dump($data);die;
		return $this->fetch('Trade/order');
	}
	//删除元素
	public function orderDel()
	{
		$data = $this->request->param();
		$order_num = $data['order_num'];
		$re = Order::destroy(['order_num'=>$order_num]);	
		if ($re) {
			$code=1;
		}else{
			$code=0;
		}
		return json_encode($code);
	}
	//搜索订单
	public function orderSearch()
	{
		$words = $this->request->param();
		$result = Order::searchOrder($words);
		$data = Users::commonMethod($result);
		$page = $result->render();
		//快递公司
		$express = Express::select();

		$this->assign('express',$express);
		$this->assign('page', $page);
		$this->assign('data',$data);
		// dump($data);die;
		return $this->fetch('Trade/order');

	}
	public function send()
	{
		$data = $this->request->param();
		//整理数据
		$company = $data['company'];
		$express_num = $data['express_num'];
		$order_num = $data['order_num'];

		$order = new Order();//更新数据
		$re = $order->save([
			'order_express'=>$company,
			'express_num'	=>$express_num,
			'order_send'	=>1,
		],['order_num'=>$order_num]);
		if ($re) {
			$this->success('发货成功',url('admin/Trade/order'));
		}else{
			$this->error('发货失败',url('admin/Trade/order'));
		}
	}

}