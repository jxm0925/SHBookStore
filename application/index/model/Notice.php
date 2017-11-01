<?php
namespace app\index\model;

use think\Model;
use traits\model\SoftDelete;
class Notice extends Model
{
	use SoftDelete;
	public function listNotice()
	{
		return $this->select();
	}
}