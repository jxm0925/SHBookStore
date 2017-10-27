<?php
namespace app\index\model;
use think\Model;

class Arc extends Model
{
	public function user()
	{
		return $this->belongsTo('User', 'u_id');
	}
}