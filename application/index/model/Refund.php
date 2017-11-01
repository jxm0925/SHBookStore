<?php
namespace app\index\model;

use think\Model;
use think\Db;
use traits\model\SoftDelete;
class Refund extends Model
{
	public function refund()
	{
		public function getRefundInfo()
		{
			$refund = Db::name('Order')->alias('o')->join('shop_good g','o.good_id = g.good_id')->where('o.refund_id',NEQ、,0)->field('o.* ,g.good_name,g.good_id,g.good_price,g.good_showprice,g.good_pic')->paginate(10);
			// Db::name('Refund')->alias('r')->join('')
		}
	}
}