<?php
namespace app\index\model;

use think\Model;
class Good extends Model
{
	public function listNews()
	{
		$time=time();
		return $this->order('create_time','desc')->where("start_time",'<=',$time)->limit(2)->select();
	}
	public function listHot()
	{
		return $this->order('good_sold','desc')->select();
	}
	public function listAll()
	{
		return $this->select();
	}
	public function findBook($id)
	{
		return $this->get($id);
	}
/*	public function bookChannel()
	{
		return $this->alias('g')
		->join('shop_type t','g.good_type=t.type_id')
		->field('g.*,t.type_path');
	}*/
	public function findType($id)
	{
		return $this->field('good_type')->find($id);
	}
	//更新浏览量
	public function updateLooked($id)
	{
		$looked = $this->findBook($id);
		$look 	= $looked->good_looked+1;
		//return $looked->good_looked;
		$this->where('good_id',$id)
		->update(['good_looked'=>$look]);

	}
	//找到大家都爱看
	public function findLooked($type)
	{
		//return $type;
		return $this->where('good_type',$type)->order('good_looked','desc')->limit(6)->select();
	}
	//找到新品推荐
	public function findNew($type)
	{
		return $this->where('good_type',$type)->order('create_time','desc')->limit(5)->select();
	}
	public function bookSearch($sid,$condition)
	{
		return $this->where("good_type=$sid")->where("")->order("$condition");
	}
	public function lookFind($keywords)
	{
		return $this->where('good_name','like',"%$keywords%");
	}
}