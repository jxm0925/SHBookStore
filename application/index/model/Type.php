<?php
namespace app\index\model;

use traits\model\SoftDelete;
use think\Model;
class Type extends Model
{
	use SoftDelete;
	public function listfstType()
	{
		return $this->where('type_pid=0')->select();;
	}
	public function listsndType($pid)
	{
		return $this->where("type_pid=$pid")->select();
	}
	public function listtrdType($pid)
	{
		return $this->where("type_pid=$pid")->select();
	}
}