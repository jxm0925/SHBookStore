<?php
namespace app\admin\model;
use think\Model;
use traits\model\SoftDelete;

class Notice extends Model
{
	use SoftDelete;
	protected $autoWriteTimestamp = true;
	protected static $deleteTime = 'delete_time';
	//列出所有通知
	public function listAll()
	{
		return $this->alias('a')
		->join('shop_admin b','a.admin_id=b.admin_id')
		->field('a.*,b.admin_id,b.admin_name');
	}
	//查看通知
	public function NtsContent($id)
	{
		return $this->field('notice')->find($id);
	}
	//修改通知
	public function edtNotice($data)
	{;
		$result = $this->save([
			'notice_name' => $data['notice_title'],
			'notice'	  => $data['content']
		],['notice_id'=>$data['nid']]);
		return $result;
	}
	//删除通知
	public function dltNotice($id)
	{
		$notice = $this->get($id);
		return $notice->delete();
	}
	//新增通知
	public function adNotice($data)
	{
		$this->data([
			'admin_id' => $data['admin_id'],
			'notice_name'=> $data['notice_name'],
			'notice'	=> $data['notice']
		]);
		return $this->save();
	}
}