<?php
namespace app\admin\model;
use think\Model;
use think\Db;
use traits\model\SoftDelete;

class Order extends Model
{
	public static function orderInfo()
	{
		return Db::name('Order')->alias('o')->join('shop_good g','o.good_id = g.good_id')->field('o.* ,g.good_name,g.good_id,g.good_price,g.good_showprice,g.good_pic')->paginate(10);
	}
	public static function searchOrder($words)
	{
		return Db::name('Order')->alias('o')->join('shop_good g','o.good_id = g.good_id')->field('o.* ,g.good_name,g.good_id,g.good_price,g.good_showprice,g.good_pic')->paginate(10);
	}
}