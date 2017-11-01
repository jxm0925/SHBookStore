<?php
namespace app\index\model;

use think\Model;
use traits\model\SoftDelete;
class Collect extends Model
{
	use SoftDelete;
	protected $autoWriteTimestamp = true;
	public function findCollect($uid,$goodid)
	{
		$result=$this->where("user_id=$uid and good_id=$goodid")->select();
		return $result;
	}
	public function delCollect($uid,$goodid)
	{
		$result=$this->where("user_id=$uid and good_id=$goodid")->delete();
		return $result;
	}
}