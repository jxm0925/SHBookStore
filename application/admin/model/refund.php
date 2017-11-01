<?php
namespace app\admin\model;
use think\Model;
use think\Db;
use traits\model\SoftDelete;

class Refund extends Model
{
	use SoftDelete;
	protected $deletTime = 'delete_time';
} 