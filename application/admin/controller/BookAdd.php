<?php
namespace app\admin\controller;

use app\admin\controller\Index;
use app\admin\controller\TypeAdd;
use app\admin\model\Type;
use app\admin\model\Good;
class BookAdd extends Index
{
	protected $goods;
	public function _initialize()
	{
		$this->goods = new Good();
	}
	public function bookAdd()
	{
		$type = Type::getSortType();
		$this->assign('type',$type);
		return $this->fetch('books/book_add');
	}
	public function bookInsert()
	{
		$file = $this->request->file('picture');
		$data = $this->request->param();
		if ($file) {
			$pic = $this->upload($file);
			//dump($this->request->file('picture'));
			$pic = str_replace('\\', '/', $pic);
			//dump($pic);die;
			// dump($data);
			$re=$this->goods->data([
				'good_name'     =>$data['bookname'],
				'good_author'   =>$data['author'],
				'good_product'  =>$data['producter'],
				'good_time'     =>strtotime($data['product_time']),
				'good_type'     =>$data['type'],
				'good_pic'      =>$pic,
				'good_count'    =>$data['count'],
				'good_price'    =>$data['sell_price'],
				'good_realprice'=>$data['price'],
				'good_showprice'=>$data['show_price'],
				'good_details'	=>$data['details'],
				'start_time'	=>strtotime($data['start_time']),
				'end_time'		=>strtotime($data['end_time'])
				])->save();
			if ($re) {
				$this->success('添加成功', url('admin/Books/bookList'));
			}else{
				$this->error('添加失败', url('admin/BookAdd/bookAdd'));
			}
		}else{
			$this->success('添加失败', url('admin/BookAdd/bookAdd'));
		}
	}
	//更新
	public function bookUpload()
	{
		$data = $this->request->param();

		dump($data);
		$re = $this->goods->save([
				'good_name'=>$data['name'],
				'good_author'=>$data['author'],
				'good_time'=>strtotime($data['btime']),
			],['good_id'=>$data['id']]);
		echo $this->goods->getLastSql();
		if ($re) {
			$value = $this->goods->get($data['id']);
			dump($value);
			dump(json_encode($value));
			//echo json_encode($value);
		}
	}

	public function upload($file){
		$info = $file->move(ROOT_PATH . 'public' . DS . 'uploads');
		if($info){
			return $info->getSaveName();
		}else{
		// 上传失败获取错误信息
			return $file->getError();
		}
	}
}