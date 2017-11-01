<?php
namespace app\index\model;

use think\Model;
use think\Db;
use think\Session;
class User extends Model
{
	protected $autoWriteTimestamp = true;
	//验证用户登录及检查用户是否被注册
	public function selectUser($data,$pwd=true)
	{
		//需要pwd的时候
		if($pwd)
		{
			$username = $data['username'];
			$password = md5($data['password']);
			$user = User::get([
				'username' => "$username",
				'password' => "$password",
			]);
			$user->update_time = time();
			$user->save();
			return $user;
		}
		//不需要pwd的时候
		else
		{
			$user = User::get([
				'username' => "$data",
			]);
			return $user;
		}
	}

	public function selectPhone($phone)
	{
		$result = User::where('phone',"$phone")->find();
		return $result;
	}
	public function insertUser($info)
	{
		$this->data([
			'username' => $info['username'],
			'password' => md5($info['password']),
			'phone'	   => $info['phone_number']
		]);
		$result = $this->save();
		return $result;
	}

	public static function getInfo()
	{
		//总的订单
		return Db::name('user')->alias('u')->join('shop_order','shop_order.user_id = shop_user.user_id')->where('username',Session::get('username'))->select();
	}
}