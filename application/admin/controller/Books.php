<?php
namespace app\admin\controller;

use app\admin\controller\Auth;
use app\admin\model\Type;
use app\admin\model\Good;
class Books extends Index
{
	public function bookList()
	{
		$type = Type::all(['type_level'=>1]);
		$book = Good::getInfo();
		$this->assign('type',$type);
		$this->assign('book',$book);
		return $this->fetch('book_list');
	}

	public function bookAdd()
	{
		return $this->fetch('book_add');
	}

	public function bookType()
	{
		$data = Type::all(['type_level'=>1]);
		$this->assign('data',$data);
		return $this->fetch('book_type');
	}

	public function addType()
	{
		return $this->fetch('add_type');
	}

	public function cateAdd()
	{
		return $this->fetch('product-category-add');
	}
}
