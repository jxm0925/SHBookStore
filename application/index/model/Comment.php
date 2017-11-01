<?php
namespace app\index\model;

use think\Model;
use traits\model\SoftDelete;
class Comment extends Model
{
	use SoftDelete;
	public function commentList($gid)
	{
		return $this->alias('c')
		->where("c.delete_time is null and good_id=$gid")
		->join('shop_user u','c.user_id=u.user_id')
		->field('c.*,u.user_id,u.username,u.headpic');
	}
	public function insertCom($user,$data)
	{
		//return $data;
		$list = [
			'user_id'=>$user,
			'good_id'=>$data['good_id'],
			'content'=>$data['content']
		];
		return $this->save($list);
	}
}