<?php
namespace app\admin\controller;

use app\admin\controller\Index;
use app\admin\model\Type;

class TypeAdd extends Index
{
	protected $type;
	public function _initialize()
	{
		$this->type = new Type();
	}
	public function typeShow()
	{
		//调用MySQL函数concat链接字符进行排序，然后在模板中输出即可
		$type = $this->type->field("*, concat(type_path,'-',type_pid) as  paths")->order('paths')->select();
		$this->assign('type',$type);
		return $this->fetch('Books/product-category-add');
	}
	//获取分类返回给ajax
	public function getTypeAjax()
	{
		$data = $this->type->field('type_id as id,type_pid as pid,type_name as name')->select();
		echo json_encode($data);
	}
	public function typeAdd()
	{
		
		if (empty($_POST['type_name']) || empty($_POST['type_explain'])) {
			echo "<script>alert('表单要填完整');parent.location.href='/admin/Books/addType'</script>";
		}else{
				//判断是否为大板块
			if (empty($_POST['type_pid'])) {
				$path['type_path'] = 0;
			}else{
				$path = $this->type->field('type_path')->find($this->request->param('type_pid'));
			}

			$value = $this->request->param();
			//增加
			$re = $this->type->data([
					'type_name'		=> $value['type_name'],
					'type_pid' 		=> $value['type_pid'],
					'type_path'		=> $path['type_path'],
					'type_level'	=> substr_count($path['type_path'], '-'),
					'type_explain'	=> $value['type_explain'],
				])->save();
			//获取ID进行更新
			$type_id  = $this->type->type_id;
			$path['type_path']  = $path['type_path'] . '-'.$type_id;
			$this->type ->type_path  = $path['type_path']; 
			$this->type ->type_level  = substr_count($path['type_path'], '-');
			$result  = $this->type->save();
			if ($result) {
				echo "<script>alert('添加成功');parent.location.href='/admin/Books/addType'</script>";
				
			}else{
				echo "<script>alert('添加失败');parent.location.href='/admin/Books/addType'</script>";
				
			}		
		}
	}
		//删除分类
	public function typeDelete()
	{
		$type_id = $this->request->param('id');
		$data = Type::destroy($type_id);
		if ($data) {
			echo 1;
		}
		//echo $type_id;
		// $result = Type::typeDelete($type_id);
	}

}