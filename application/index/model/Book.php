<?php
namespace app\index\model;

use think\Model;
class Book extends Model
{
	//自动进行状态转换；(需要有参数,返回值为statue[$value])
	public function getTypeAttr($value)
	{
		$statue = ['0'=>'有声读物','1'=>'哲理书籍'];
		return $statue[$value];
	}
	public function user()
	{
		return $this->belongsTo('User','uid');
	}
}