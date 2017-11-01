<?php
namespace app\admin\controller;

use app\admin\controller\Index;
use app\admin\model\Picture as PictureModel;
use app\admin\model\Type;
class Picture extends Index
{
	protected $pic;
	public function _initials()
	{
		$this->pic = new PictureModel();
	}
	public function picList()
	{
		$data =PictureModel::getPicInfo()->paginate(3);
		$this->assign('data',$data);
		return $this->fetch('Books/picture');
	}
	public function picAdd()
	{
		$type = Type::all(['type_level'=>1]);
		$this->assign('type',$type);
		return $this->fetch('Books/picture_add');
	}
	//新增图片
	public function picInsert()
	{
		$file = $this->request->file('pic_path');
		$data = $this->request->param();
		if ($file ||empty($data['pic_name'])) {
			$picture = $this->upload($file);
			$pic = new PictureModel;
			$re = $pic->data([
				'pic_name' =>$data['pic_name'],
				'pic_path' =>$picture,
				'pic_forum'=>$data['pic_forum'],
				'pic_sort' =>$data['pic_sort'],
				])->save();
			// $re = $pic->save();
			// dump($pic->getLastSql());die;
			if ($re) {
				$this->success('添加成功', url('admin/Picture/picList'));
			}else{
				$this->error('添加失败', url('admin/Picture/picAdd'));
			}
		}else{
			$this->error('添加失败', url('admin/Picture/picAdd'));
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

	public function picDel()
	{
		$id = $this->request->param('id');
		PictureModel::destroy(['pic_id'=> $id]);
		// dump(PictureModel::getLastSql());die;
		$this->redirect('Picture/picList');
	}
	public function delMore()
	{
		$data = $this->request->param();
		if (!empty($data['checkbox'])) {
			foreach ($data['checkbox'] as $key => $value) {
				PictureModel::destroy(['pic_id'=>$value]);
			}
			$this->redirect('Picture/picList');
		}
	}
	public function picStatus()
	{
		$id = $this->request->param('id');
		$status = intval(!$this->request->param('status'));
		PictureModel::where('pic_id',$id)->update(['pic_status'=>$status]);
		$this->redirect('Picture/picList');
	}
}