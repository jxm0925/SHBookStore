<?php
namespace app\index\model;

use think\Model;
use think\Db;
use think\Session;
use think\User;
use traits\model\SoftDelete;

class Address extends Model
{
	use SoftDelete;
	public static function addressInfo()
	{
		return Db::name('address')->alias('a')->join('shop_user u','a.user_id = u.user_id')->where('a.delete_time','null')->select();
	}
	public static function addDele($data)
	{
		return Address::destroy($data);
	} 

	public static function setDefault()
	{
		return Db::table('shop_address')->where('status',1)->setField('status',0);
	}
}