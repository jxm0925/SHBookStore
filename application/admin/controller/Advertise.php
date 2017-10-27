<?php
namespace app\admin\controller;

use app\admin\controller\Index;
use app\admin\model\Adv;
class Advertise extends Index
{
	protected $adv;
	public function _initialize()
	{
		$this->adv = new Adv();
	}
	public function advList()
	{
		$data = $this->adv->paginate();
		$this->assign('data',$data);
		return $this->fetch('Books/advertise');
	}
	public function advAdd()
	{
		$file = $this->request->file('picture');
		$data = $this->request->param();
		if ($file) {
			$pic = $this->upload($file);
			$re = $this->adv->data([
				'adv_width'=>$data['width'],
				'adv_height'=>$data['height'],
				'adv_sort' 	=>$data['sort'],
				'adv_link'	=>$data['link'],
				'adv_status'=>$data['status'],
				'adv_path'	=>$pic,
				])->save();
			if ($re) {
				echo 1;
			}else{
				echo 0;
			}
		}else{
			echo -1;
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
	public function advDel()
	{
		$id = $this->request->param('id');
		$this->adv->destroy(['adv_id'=> $id]);
		// dump(PictureModel::getLastSql());die;
		$this->redirect('Advertise/advList');
	}
}