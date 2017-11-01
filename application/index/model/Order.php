<?php
namespace app\index\model;

use think\Model;
use traits\model\SoftDelete;
class Order extends Model
{
	use SoftDelete;
	public function checkRight($uid,$gid)
	{
		return $this->where("user_id=$uid and good_id=$gid")->select();
	}
}