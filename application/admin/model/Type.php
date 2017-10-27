<?php
namespace app\admin\model;
use think\Model;
use traits\model\SoftDelete;

class Type extends Model
{
	use SoftDelete;
	public static function getType()
	{
		$type = Type::all();
		return $type;
	}

	public static function typeAdd($data)
	{
		return $self->save();
	}
	//获取排序后的类型
	public static function getSortType()
	{
		$type = self::field("*, concat(type_path,'-',type_pid) as  paths")->order('paths')->select();
		return $type;
	}
	//一个类型对应多本书
	public function book()
	{
		return $this->hasMany('Book','good_type');
	}
}