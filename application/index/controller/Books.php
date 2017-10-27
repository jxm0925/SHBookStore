<?php
namespace app\index\controller;

use \think\Controller;

class Books extends Controller
{
	public function newBook()
	{
		return $this->fetch();
	}
	public function ranking()
	{
		return $this->fetch();
	}
	public function detail()
	{
		return $this->fetch();
	}
	public function search()
	{
		return $this->fetch();
	}
}