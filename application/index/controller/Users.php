<?php
namespace app\index\controller;

use \think\Controller;
use app\index\model\User;
use app\index\model\Order;
use \think\Session;
use app\index\model\Collect;
use app\index\model\Address;
use app\index\model\Good;
use app\index\model\Refund;
class Users extends Controller
{
	public function cart()
	{
		return $this->fetch();
	}
	public function address()
	{
		$data = Address::addressInfo();
		$count = count($data);
		$this->assign(['data'=>$data,'count'=>$count]);
		return $this->fetch();
	}
	public function collection()
	{
		$collect = Collect::getCollect();
		$this->assign('collect',$collect);
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
		$data 		= User::getInfo();
		$headpic	= $data[0]['headpic'];
		$money 		= $data[0]['money'];
		$paystatus  = 0;
		$status 	= 0;
		$isstatus 	= 0;
		$apprstatus = 0;
		foreach ($data as $key => $value) {
				//代付款
				if ($value['order_paystatus'] == 0) {
					$paystatus++;
					//代发货
				}else if($value['order_status'] == 0){
					$status++;
					//待收货
				}else if($value['order_status'] == 1){
					$isstatus++;
					//待评价
				}else if($value['order_apprstatus' == 0]){
					$apprstatus++;
				}
			}
		$this->assign([
			'headpic'	=>$headpic,
			'money' 	=>$money,
			'paystatus' =>$paystatus,
			'status'	=>$status,
			'isstatus'	=>$isstatus,
			'apprstatus'=>$apprstatus,
		]);		
		return $this->fetch();
	}
	//获取积分
	public function points()
	{	
		$id = Session::get('userid');
		$user = new User();
		$data = User::where('user_id',"$id")->select();
		$score = $data[0]['score'];
		$this->assign('score',$score); 
		return $this->fetch();
	}
	public function settings()
	{
		$id = Session::get('userid');
		$data = User::where('user_id',"$id")->select();
		$this->assign('data',$data[0]);
		return $this->fetch();
	}
	public function order()
	{
		$result = Order::orderInfo();
		$data = $this->commonMethod($result);
		$this->assign('data',$data);
		return $this->fetch();
	}
	//待付款
	public function waitPay()
	{
		$order = new Order();
		$result = Order::waitPay();
		$data = $this->commonMethod($result);
		$this->assign('data',$data);
		return $this->fetch();
	}
	//带发货
	public function waitSend()
	{
		$result = Order::waitSend();
		$data = $this->commonMethod($result);
		$this->assign('data',$data);
		return $this->fetch();
	}
	//待收货
	public function beenSend()
	{
		$result = Order::beenSend();
		$data = $this->commonMethod($result);
		$this->assign('data',$data);
		return $this->fetch();
	}
	//待评价
	public function waitComment()
	{
		$result = Order::waitComment();
		$data = $this->commonMethod($result);
		$this->assign('data',$data);
		return $this->fetch();
	}
	//支付页面
	public function confirm()
	{
		$goodinfo = [['good_id'=>2,'good_count'=>2] , ['good_id'=>3,'good_count'=>3	]];
		//判断库存
		foreach ($goodinfo as $key => $value) {
			$count = Good::where('good_id',$value['good_id'])->column('good_count');
			if ($count[0] < $value['good_count']) {
				echo '库存不足';
			}
		}
		//遍历打印
		$goods = [];
		$totalPrice = 0;
		// dump(Good::where('good_id',2)->select());
		foreach ($goodinfo as $key => $value) {
			$dbinfo = Good::where('good_id',$value['good_id'])->select();
			$info = array($dbinfo,$value['good_count']);
			array_push($goods,$info);
			$totalPrice += $dbinfo[0]['good_price']*$value['good_count'];
		}
		// dump($goods[0][0][0]['good_price']);
		// dump($count[0]);

		$address = Address::addressInfo();
		$this->assign(
				['address'		=>$address,
					'goods'		=>$goods,
					'totalPrice'=>$totalPrice,
				]
			);
		return $this->fetch();
	}

	public function pay()
	{
		$order_num = $this->request->param();
		$totalmoney = Order::totalMoney($order_num['order_num']);
		$this->assign('totalmoney',$totalmoney);
		return $this->fetch();
	}
	//退货
	public function refund()
	{
		$data = $this->request->param();
		$order_num = $data['order_num'];
		$refund_details = $data['detail'];
		$refund_postcode = $data['postcode'];
		//先插入退款表
		$refund = new Refund(['order_num'=>$order_num,'refund_details'=>$refund_details,'refund_postcode'=>$refund_postcode]);
		$refund->save();
		//获得退货表的ID
		$refund_id = $refund->getLastInsID();
		//插入订单表中
		$order = new Order();
		$re = $order->save(['refund_id'=>$refund_id],['order_num'=>$order_num]);
		if ($re) {
				$this->success('操作成功',url('index/Users/order'));
			}else{
				$this->error('操作失败',url('index/Users/order'));
			}	
	}
	//公共方法
	public static function commonMethod($result)
	{
		foreach ($result as $v) {
    		$data[$v['order_num']][] = array(
    		'create_time'	=>$v['create_time'],
            'good_id'		=>$v['good_id'],
            'good_name'		=>$v['good_name'],
            'good_pic'		=>$v['good_pic'],
            'good_price'	=>$v['good_price'],
            'good_showprice'=>$v['good_showprice'],
            'order_num'		=>$v['order_num'],
            'order_count'	=>$v['order_count'],
            'order_price'	=>$v['order_price'],
            'totalmoney'	=>$v['order_totalmoney'],
            'order_status'	=>$v['order_status'],
            'order_paystatus'=>$v['order_paystatus'],
            'order_send'	=>$v['order_send'],
            'order_receive' =>$v['order_receive'],
            'order_apprstatus'=>$v['order_apprstatus'],
           );
		}
		return $data;
	}
}