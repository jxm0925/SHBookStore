<?php
namespace app\index\controller;

use app\index\controller\Index;
use \think\Session;
use \think\Request;
use think\DB;
use app\index\model\Good;
use app\index\model\Collect;

class Books extends Index
{
	public function newBook()
	{
		$this->assign('fstarr',$this->fstarr);
		return $this->fetch();
	}
	public function ranking()
	{
		return $this->fetch();
	}
	//图书详情
	public function detail()
	{
		//dump(Session::get('shopcar'));
		if(!empty($this->request->param('bookid')))
		{
			//获取书籍id
			$bookid = $this->request->param('bookid');
			//更新浏览量
			$this->good->updateLooked($bookid);
			$result = $this->good->findBook($bookid);
			$type   = $this->good->findType($bookid);
			//dump($type->good_type);
			$look   = $this->good->findLooked($type->good_type);
			$new    = $this->good->findNew($type->good_type);
			$lcomment = $this->comment->commentList($bookid);
			$listcomment = $lcomment->paginate(10);
			//dump($listcomment);
			$this->assign([
				'result'	  => $result,
				'look'		  => $look,
				'new'		  => $new,
				'listcomment' => $listcomment,
			]);
		}
		else
		{
			$this->error('该书已下架或未添加','/index');
		}
		$this->assign('fstarr',$this->fstarr);
		return $this->fetch();
	}
	public function comment()
	{
		//return 1;
		$data = $this->request->param();
		$user = Session::get('userid');
		if(empty($user))
		{
			return [
				'code'=>0,
				'msg' =>'请登录后再评论',
			];
		}

		$result = $this->order->checkRight($user,$data['good_id']);
		if($result)
		{
			if(empty($data['content']))
			{
				return [
					'code'=>0,
					'msg' =>'请输入您的评论内容',
				];
			}
			$re = $this->comment->insertCom($user,$data);
			//return $re;
			if($re)
			{
				return[
					'code'=>1,
					'msg' => '评论成功'
				];
			}
			else
			{
				return [
					'code'=>0,
					'msg' =>'评论失败'
				];
			}
		}
		else
		{
			//可以加个屏蔽词
			return [
				'code'=>0,
				'msg' =>'抱歉，您未购买该商品，还不能评论哦',
			];
		}
		return $data['good_id'];
	}
	//返回商品详情
	public function goodsDetail()
	{
		$userid = Session::get('userid');
		$id = $this->request->param('good_id');
		if(!empty($userid))
		{
			$collect= $this->collect->findCollect($userid,$id);
			if($collect)
			{
				$is_collect=1;
			}
			else
			{
				$is_collect=0;
			}
		}
		else
		{
			$is_collect=0;
		}
		$result = $this->good->findBook($id);
		$time = time();
		//判断图书是否预售
		if($result->start_time>$time)
		{
			$if_presold=1;
		}
		else
		{
			$if_presold=0;
		}
		if($result)
		{
			return [
				'code' => 0,
				'info' => [
					'if_presold'   => $if_presold,
					'market_price' => $result->good_price,
					'price'		   => $result->good_realprice,
					'post_free'	   => 50,
					'sale_nums'	   => $result->good_sold,
					'stores'	   => $result->good_count,
					'goods_id'	   => $id,
					'is_collect'   => $is_collect,
					'integral'	   => $result->good_realprice,
					'upper_title'  => 1,
				]
			];
		}
	}
	//收藏与取消收藏
	public function collectBook()
	{
		$userid = Session::get('userid');
		$good_id = $this->request->param('id');
		if(empty(Session::get('userid')))
		{
			return [
				'info'  => '请登录后再收藏',
			];
		}
		else
		{
			if($this->request->param('operate'))
			{
				$isInDb = $this->good->findBook($good_id);
				if(!$isInDb)
				{
					return [
						'info'	 => '该商品不存在或已下架',	
					];
				}
				//return $this->request->param('operate');
				$time = time();
				$data = ['user_id' => $userid, 'good_id' => $good_id, 'create_time' => $time];
				$result = Db::table('shop_collect')->insert($data);
				//return json_encode($result,JSON_UNESCAPED_UNICODE);
				if($result)
				{
					return [
						'status' => 1,
						'info'	 => '收藏成功',	
					];
				}
				else
				{
					return [
						'info'  => '收藏失败',
					];
				}
			}
			//取消收藏
			if($this->request->param('operate')==0)
			{
				$result = $this->collect->delCollect($userid,$good_id);
				if($result)
				{
					return [
						'status' => 1,
						'info'	 => '已取消',	
					];
				}
				else
				{
					return [
						'info'  => '发生未知错误',
					];
				}
			}
		}
	}
	//添加购物车与购买
	public function cartOperate()
	{
		$data = $this->request->param();
		if(!empty($data))
		{
			$goodid = $data['id'];
			$number = $data['number'];
			$url 	= $data['referer'];
			$type	= $data['type'];
			if($type==1)
			{
				return [
					'code' => 0,
					'url'  => "/index/Users/confirm/good_id/$goodid/good_count/$number",
				];
			}
			//添加购物车
			if($type==2)
			{
				if(!Session::has('shopcar'))
				{
					$arr = array(array($goodid,$number));
					Session::set('shopcar',$arr);
					return [
						'code' => 1,
						'info'  => "添加购物车成功",
					];
				}
				else
				{
					/*return [
						'code' => 1,
						'list_number' => 0,
					];*/
					$arr = Session::get('shopcar');
					$flag = false;
					foreach ($arr as $v) {
						if($v[0]==$goodid)
						{
							$flag = true;
						}
					}
					if($flag)
					{
						for($i=0;$i<count($arr);$i++)
						{
							if($arr[$i][0]==$goodid)
							{
								$arr[$i][1]+=$number;
							}
						}
						Session::set('shopcar',$arr);
						return [
							'code' => 1,
							'info'  => "添加购物车成功",
						];
					}
					else
					{
						$asg = array($goodid,$number);
						$arr[] = $asg;
						Session::set('shopcar',$arr);
						return [
							'code' => 1,
							'info'  => "添加购物车成功",
						];
					}
				}
			}
		}
	}
	//删除购物车
	public function removeCar()
	{
		//获取session中的商品id
		$id = Session::get('shopcar');
		//通过ajax获取要删除的id
		$removeid = $this->request->param();
		//return $removeid;
		//return json_encode($removeid,JSON_UNESCAPED_UNICODE);
		foreach ($id as $key => $value){
			if(strpos($removeid['goods_ids'], strval($value[0]))===false)
			{
				echo '删除失败';
			}
			else
			{
				unset($id[$key]);
				Session::set('shopcar',$id);
				return [
					'status' => 1,
				];
			}
			//return json_encode($set,JSON_UNESCAPED_UNICODE);
		}
		//return json_encode($id,JSON_UNESCAPED_UNICODE);;
	}
	//修改购物车的数量
	public function changecount()
	{
		$car = Session::get('shopcar');
		$data = $this->request->param();
		$goodid = $data['goods_id'];
		$num= $data['count'];
		//return $num;
		//return $data;
		foreach ($car as $key => $value) {
			if($value[0]==$goodid)
			{
				$asg = array($goodid,$num);
				unset($car[$key]);
				array_push($car,$asg);
			}
		}
		Session::set('shopcar',$car);
	}
	public function search()
	{
		if(!empty($this->request->param('sid')))
		{
			$condition='';
			$sid = $this->request->param('sid');
			$this->assign('sid',$sid);
			//按照type进行搜索排序
			if(!empty($this->request->param('type')))
			{
				$type= $this->request->param('type');
				if($type==1)
				{
					$condition = ' good_showprice desc';
				}
				if($type==2)
				{
					$condition = ' good_sold desc';
				}
				if($type==3)
				{
					$condition = ' create_time desc';
				}
			}
			$findsrch = $this->good->bookSearch($sid,$condition);
			$page = $findsrch->paginate(3);
			/*dump($result);*/
			$this->assign('page',$page);
		}
		if(!empty($this->request->param('keywords')))
		{
			//dump('关键字搜索');
			$keywords = $this->request->param('keywords');
			$findsrch = $this->good->lookFind($keywords);
			$page = $findsrch->paginate(3);
			$this->assign('page',$page);
		}
		$this->assign('fstarr',$this->fstarr);
		return $this->fetch();
	}
}