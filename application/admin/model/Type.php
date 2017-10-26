<?php
namespace app\admin\model;
use think\Model;
use traits\model\SoftDelete;

class Type extends Model
{
	public static function getType()
	{
		$type = Type::all();
		return $type;
	}

	public static function typeAdd($data)
	{
		return $self->save();
	}
}