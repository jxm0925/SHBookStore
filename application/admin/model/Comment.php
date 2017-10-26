<?php
namespace app\admin\model;
use think\Model;
use traits\model\SoftDelete;

class Comment extends Model
{
	use SoftDelete;
	protected $autoWriteTimestamp = true;
	//protected static $deleteTime = 'delete_time';
	//评论列表
	public function commentList()
	{
		return $this->alias('c')
		->where('c.delete_time is null')
		->join('shop_user u','c.user_id=u.user_id')
		->join('shop_good g','c.good_id=g.good_id')
		->field('c.*,u.username,g.good_name,g.good_id');
	}
	//删除评论
	public function dltComment($id)
	{
		$comment = $this->get($id);
		return $comment->delete();
	}
	public function recoveryComment($id)
	{
		$sql = "update shop_comment set delete_time = NULL where comment_id=$id";
		return $this->execute($sql);
	}
}