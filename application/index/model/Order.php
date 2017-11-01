<?php
namespace app\index\model;

use think\Model;
use think\Db;
use think\Session;
use think\User;
class Order extends Model
{
	//所有的订单表
	public static function orderInfo()
	{
		return Db::name('Order')->alias('o')->join('shop_good g','o.good_id = g.good_id')-> where('user_id',Session::get('userid'))->field('o.* ,g.good_name,g.good_id,g.good_price,g.good_showprice,g.good_pic')->select();
	}
	//待付款
	public static function waitPay()
	{
		return Db::name('Order')->alias('o')->join('shop_good g','o.good_id = g.good_id')-> where('user_id',Session::get('userid'))->where('o.order_paystatus',0)->field('o.* ,g.good_name,g.good_id,g.good_price,g.good_showprice,g.good_pic')->select();	
	}
	//待发货,已付款，未发货状态
	public static function waitSend()
	{
		return Db::name('Order')->alias('o')->join('shop_good g','o.good_id = g.good_id')-> where('user_id',Session::get('userid'))->where(['o.order_send'=>0,'o.order_paystatus'=>1])->field('o.* ,g.good_name,g.good_id,g.good_price,g.good_showprice,g.good_pic')->select();
	}
	//待收货:已付款，已发货
	public static function beenSend()
	{
		return Db::name('Order')->alias('o')->join('shop_good g','o.good_id = g.good_id')-> where('user_id',Session::get('userid'))->where(['o.order_receive'=>0,'o.order_send'=>1,'o.order_paystatus'=>1])->field('o.* ,g.good_name,g.good_id,g.good_price,g.good_showprice,g.good_pic')->select();
	}
	//待评价：已付款，已发货，已收获
	public static function waitComment()
	{
		return Db::name('Order')->alias('o')->join('shop_good g','o.good_id = g.good_id')-> where('user_id',Session::get('userid'))->where(['o.order_apprstatus'=>0,'o.order_receive'=>1,'o.order_send'=>1,'o.order_paystatus'=>1])->field('o.* ,g.good_name,g.good_id,g.good_price,g.good_showprice,g.good_pic')->select();
	}
	//获取订单的应付的钱数
	public static function totalMoney($order_num)
	{
		return $order = Order::where(['order_num'=>$order_num])->sum('order_price');
	}
}