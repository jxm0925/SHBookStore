<?php
namespace app\index\controller;

use app\index\controller\Index;

class Books extends Index
{
	public function newBook()
	{
		$this->assign('fstarr',$this->fstarr);
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