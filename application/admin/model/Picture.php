<?php
namespace app\admin\model;
use think\Model;
use think\Db;
use traits\model\SoftDelete;

class Picture extends Model
{
	use SoftDelete;
	protected $deletTime = 'delete_time';
	public static function getPicInfo()
	{

		return Db::name('Picture')->alias('p')->join('shop_type t','pic_forum=type_id')->where('p.delete_time','NULL')->field('p.*,t.type_name');
	}
} 