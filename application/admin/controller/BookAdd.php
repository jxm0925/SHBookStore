<?php
namespace app\admin\controller;

use app\admin\controller\Index;
class BookAdd extends Index
{
	public function bookAdd()
	{
		return $this->fetch('books/book_add');
	}
}