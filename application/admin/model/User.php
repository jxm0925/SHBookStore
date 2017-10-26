<?php
namespace app\admin\model;
use think\Model;
use traits\model\SoftDelete;

class User extends Model
{
	use SoftDelete;
	protected $deleteTime = 'delete_time';
	protected $autoWriteTimestamp = true;

	public function listUser()
	{
		return $this;
	}
	public function delUser($id)
	{
		return $this->destroy($id);
	}
	public function getSexAttr($value) {
		$sex = [0=>'女',1=>'男',2=>'保密'];
		return $sex[$value];
	}
	public function getIsBanAttr($value) {
		$sex = [0=>'禁用',1=>'解除'];
		return $sex[$value];
	}
}