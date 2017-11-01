<?php
namespace app\index\model;

use think\Model;
use traits\model\SoftDelete;
class Picture extends Model
{
	use SoftDelete;
	public function listBanner()
	{
		return $this->order('pic_sort', 'asc')->select();
	}
}