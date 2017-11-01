<?php
namespace app\index\controller;

use \think\Controller;
use \think\Session;
use app\index\model\User;
use app\index\model\Address;

class UserInfo extends Controller
{
	public function userInfo()
	{
		$user = new User();
		$file = $this->request->file('image');
		$data = $this->request->param();
		if ($file) {
			$pic = $this->upload($file);
			//性别数据在默认情况下穿不过来
			if (isset($data['user-sex'])) {	
				$re = $user->save([
					'nickname'	=>$data['nickname'],
					'work'		=>$data['profession'],
					'signature' =>$data['signature'],
					'six'		=>$data['user-sex'],
					'headpic'	=>$pic,
				],['user_id'=>Session::get('userid')]);
				if ($re) {
					$this->success('操作成功','Users/settings');
				}else{
					$this->error('操作失败','Users/settings');
				}
				
			}else{
				$re = $user->save([
					'nickname'	=>$data['nickname'],
					'work'		=>$data['profession'],
					'signature' =>$data['signature'],
					'headpic'	=>$pic,
				],['user_id'=>Session::get('userid')]);	
				if ($re) {
					$this->success('操作成功','Users/settings');
				}else{
					$this->error('操作失败','Users/settings');
				}
			}	
		}
	}
	public function upload($file){
		$info = $file->move(ROOT_PATH . 'public' . DS . 'uploads');
		if($info){
			return str_replace('\\', '/', $info->getSaveName());
		}else{
		// 上传失败获取错误信息
			return $file->getError();
		}
	}
}