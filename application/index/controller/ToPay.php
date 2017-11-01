<?php
namespace app\index\controller;

use \think\Controller;
use app\index\model\User;
use app\index\model\Order;
use \think\Session;
use app\index\model\Collect;
use app\index\model\Address;
use app\index\model\Good;

class ToPay extends Controller
{
	public function toPay()
	{
		$order = new Order();
		$data = $this->request->param();
		$address_id = $data['address_id'];
		$id_count   = $data['id_count'];
		$order_num = time().rand(10000000,99999999);
		$order_totalmoney = $data['pay_money'];
		//循环插入生成订单
		foreach ($id_count as $key => $value) {
			$result 	= explode('+', $value);
			$good_id 	= $result[0];
			$count 		= $result[1];
			$order_price = $result[2];
			
			// dump($good_id);
			$re = $order->data([
					'order_num'  =>$order_num,
					'order_price'=>$order_price,
					'order_totalmoney'=>$order_totalmoney,
					'good_id'	 =>$good_id,
					'order_count'=>$count,
					'order_price'=>$order_price,
					'user_id'	 =>Session::get('userid'),
					'address_id' =>$address_id,
					'create_time'=>time(),
				],true)->isUpdate(false)->save();
		}
		if ($re) {
			$code = ['status'=>0000,'jump_url'=>"pay?order_num=".$order_num];
			echo json_encode($code);
		}else{
			$this->error('订单提交失败','index');
		}
	}
}