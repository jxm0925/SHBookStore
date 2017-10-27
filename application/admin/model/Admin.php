<?php
namespace app\admin\model;
use think\Model;
use traits\model\SoftDelete;

class Admin extends Model
{
	//use SoftDelete;
	//自动完成
	// protected $auto = ['birthday'=>'1508219308'];
	protected $insert = ['status'=>'1'];
	protected $update = ['birthday'=>'1508219308'];
	//protected $autoWriteTimestamp = true
	//获取qi

	//多对多
	public function role()
	{
		return $this->belongsToMany();
	}
	//一对多关联
	public function arc()
	{
		return $this->hasMany();
	}
	//一对一关联
	public function profile()
	{
		return $this->hasOne('profile' , 'user_id')->bind('adds');
	}
	public function getStatusAttr($value) {
		$status = [-1=>'删除',0=>'禁用',1=>'正常',2=>'待审核'];
		return $status[$value];
	}
	//修改器
	public function setNicknameAttr($value)
	{
		return strtolower($value);
	}
}
