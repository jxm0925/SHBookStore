<?php
namespace app\admin\model;
use think\Model;
use think\Db;
use traits\model\SoftDelete;

class Good extends Model
{
	public static function addGood()
	{

	}
	public static function getInfo()
	{
		return Db::name('good')->join('shop_type','good_type=type_id')->paginate(5);
	}
	public static function type()
	{
		$this->belongsTo('Type','good_type');
	}
}