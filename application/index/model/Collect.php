<?php
namespace app\index\model;

use think\Model;
use think\Db;
use think\Session;
use think\User;

class Collect extends Model
{
	public static function getCollect()
	{
		return Db::name('collect')->alias('c')->join('shop_user u','c.user_id = u.user_id')->join('shop_good g','g.good_id = c.good_id')->where('c.user_id',Session::get('userid'))->select();
	}
}