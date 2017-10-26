<?php
namespace app\admin\controller;

use app\admin\controller\Auth;
class Books extends Index
{
	public function bookList()
	{
		return $this->fetch('book_list');
	}

	public function bookAdd()
	{
		return $this->fetch('book_add');
	}

	public function bookType()
	{
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
