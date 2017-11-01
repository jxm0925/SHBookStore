<?php
namespace app\admin\controller;

use app\admin\controller\Index;
use \think\Session;
use think\Paginator;
use think\DB;
use app\admin\model\Comment;
class Article extends Index
{
	public function article_list()
	{
		$result = $this->notice->listAll();
		$list = $result->paginate(2);
		//dump($list);
		/*foreach ($this->notice->where('delete_time is null')->select() as $key => $value) {
			$info = $this->notice->get($value->notice_id);
			$info->admin;
			$list[] = $info;
			//$list[$value->data['admin_name']] = $info->admin->admin_name;
		}
		if(!empty($list))
		{
			$this->assign('list',$list);
		}*/
		$this->assign('list', $list);
		return $this->fetch();
	}
	//查询通知内容
	public function selectNotice()
	{
		$id = $this->request->param('noticeid');
		$result = $this->notice->NtsContent($id);
		return $result;
	}
	//修改通知信息
	public function editNotice()
	{
		$data = $this->request->param();
		$result = $this->notice->edtNotice($data);
		//dump($result);
		$this->redirect('article_list');
	}
	//删除本条通知
	public function delNotice()
	{
		$id = $this->request->param('noticeid');
		$result = $this->notice->dltNotice($id);
		return $result;
	}
	public function article_add()
	{
		return $this->fetch();
	}
	public function addNotice()
	{
		//$admin_id = session('admin_id');
		$data = $this->request->param();
		$data['admin_id'] = session('admin_id');
		//dump($data);
		$result = $this->notice->adNotice($data);
		//dump($result);
		if($result)
		{
			$this->success('发布通知成功',url('article_list'));
		}
		else
		{
			$this->error('发布通知失败',url('article_add'));
		}
	}
	//用户评论管理
	public function comment()
	{
		$result = $this->comment->commentList();
		$list = $result->paginate(2);
		$this->assign('list', $list);
		return $this->fetch();
	}
	//删除评论
	public function delComment()
	{
		$id = $this->request->param('cid');
		$result = $this->comment->dltComment($id);
		return $result;
	}
	//评论回收站
	public function comment_recy()
	{
		$list = Comment::onlyTrashed()
		->alias('c')
		->join('shop_user u','c.user_id=u.user_id')
		->join('shop_good g','c.good_id=g.good_id')
		->field('c.*,u.username,g.good_name')->paginate(2);
		/*$result = $this->comment->recycle();
		$list = $result->paginate(5);*/
		//dump($result);
		$this->assign('list', $list);
		return $this->fetch();
	}
	//恢复评论
	public function recovery()
	{
		$id = $this->request->post('CID');
		return $this->comment->recoveryComment($id);
	}
}