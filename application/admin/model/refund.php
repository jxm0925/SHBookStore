<?php
namespace app\admin\model;
use think\Model;
use think\Db;
use traits\model\SoftDelete;

class Refund extends Model
{
	use SoftDelete;
	protected $deletTime = 'delete_time';
	public static function getRefundInfo()
	{
		//获取退款信息
		$order = Db::name('Order')->alias('o')->join('shop_good g','o.good_id = g.good_id')->where('o.refund_id','<>',0)->field('o.* ,g.good_name')->join('refund r','r.refund_id = o.refund_id')->where('r.delete_time',null)->field('r.refund_id,r.refund_status,r.refund_details,r.create_time as refund_time')->paginate(10);
		return $order;

		// Db::name('Refund')->alias('r')->join('')
	}

} 