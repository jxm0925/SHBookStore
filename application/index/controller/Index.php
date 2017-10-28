<?php
namespace app\index\controller;

use \think\Controller;
use \think\Session;
use \think\Request;
use \think\Validate;
use framework\Ucpaas;
use app\index\model\User;
use app\index\model\Type;
use app\index\model\Notice;
use app\index\model\Picture;
use app\index\model\Good;

class Index extends Controller
{
	protected $user;
	protected $uc;
	protected $type;
	protected $notice;
	protected $fstarr;
	protected $picture;
	protected $good;
	//变量初始化
	public function _initialize()
	{
		$this->user = new User();
		$this->type = new Type();
		$this->notice = new Notice();
		$this->picture= new Picture();
		$this->good   = new Good();
		$this->fstarr = $this->listMenu();
	}

	public function index()
	{
		$banner = $this->picture->listBanner();
		$notice = $this->notice->listNotice();
		$new	= $this->good->listNews();
		$hot	= $this->good->listHot();
		$this->assign(['fstarr'=>$this->fstarr,
			'notice'=>$notice,
			'banner'=>$banner,
			'new'	=>$new,
			'hot'	=>$hot,
		]);
		return $this->fetch();
	}
	public function listMenu()
	{
		$fst = $this->type->listfstType();
		$fstarr = array();
		$snd = array();
		$sndarr = array();
		$trd = array();
		$trdarr = array();
		//dump($fst);
		foreach ($fst as $key => $value) {
			$fstarr[$key] = $value->toArray();
			$fstarr[$key]['child'] = array();
			$snd = $this->type->listsndType($value->type_id);
			//array_push($fst[$key]['child'],$snd->type_name);
			foreach($snd as $k=>$v){
				$sndarr[$k] = $v->toArray();
				array_push($fstarr[$key]['child'], $sndarr[$k]);
				$fstarr[$key]['child'][$k]['child2'] = array();
				$trd = $this->type->listtrdType($v->type_id);
				foreach ($trd as $k2=>$v2) {
					$sndarr[$k2] = $v2->toArray();
					array_push($fstarr[$key]['child'][$k]['child2'],$sndarr[$k2]);
				}

			}
		}
		return $fstarr;
	}
	//注册相关操作
	public function regist()
	{
		return $this->fetch();
	}
	//发送手机信息
	public function sendMsg($phone_number)
	{
		//return '验证码发送成功';
		//初始化必填
        //echo $this->request->post('phone_number');
       	//exit;
        $options['accountsid']='552bd67a41f4a3ad91c6b8d15ab38af1'; //填写自己的
        $options['token']='55742228902603fc150d31c3a9790a2e'; //填写自己的
        //初始化 $options必填
        $this->uc = new Ucpaas($options);
                
                //随机生成6位验证码
      	$nums = '1234zxc0987qweryt4uu12io5plaksjd343hf3g3mnzb5123xvc';
		$yzm = substr(str_shuffle($nums),0,4);
        //短信验证码（模板短信）,默认以65个汉字（同65个英文）为一条（可容纳字数受您应用名称占用字符影响），超过长度短信平台将会自动分割为多条发送。分割后的多条短信将按照具体占用条数计费。
        $appId = "9b38fa5e56d34ed49a5558c956e1978b";  //填写自己的
        $to = $phone_number;
        $templateId = "152771";
        $param="拾忆书城,'$yzm',3";
        $arr=$this->uc->templateSMS($appId,$to,$templateId,$param);
        if (substr($arr,21,6) == 000000) {
            //如果成功就，这里只是测试样式，可根据自己的需求进行调节
            Session::set('yzm',"$yzm");
            Session::set('phone',"$to");
            return "短信验证码已发送成功，请注意查收短信";
        }else{
            //如果不成功
            return "短信验证码发送失败，请联系客服";
            
        } 
	}
	//ajax检查用户是否已注册
	public function isReg()
	{
		$data = $this->request->param('name');
		
		$result = $this->user->selectUser($data,false);
		//return json_encode($result,JSON_UNESCAPED_UNICODE);
		if($result)
		{
			return [
				'code' => 0,
				'msg'  => '用户名已存在'
			];
		}
		else
		{
			return [
				'code' => 1,
			];
		}
	}
	//ajax判断手机是否已被注册
	public function isExistPhone()
	{
		$phone = $this->request->param('phone_number');
		$result = $this->user->selectPhone($phone);
		if($result)
		{
			return [
				'code' => 0,
				'msg'  => '手机号已被注册',
			];
		}
		else
		{
			return $this->sendMsg($phone);
		}
	}
	//注册信息插入数据库
	public function insertReg()
	{
		//dump($this->request->param());
		$data = $this->request->param();
		$result = $this->user->insertUser($data);
		//dump($result);
	}
	//登陆相关操作
	public function login()
	{
		return $this->fetch();
	}
	//检查登录信息
	public function checkLogin()
	{
		$data = $this->request->param();
		//dump($username);
		$result = $this->user->selectUser($data);

		//保存session的值
		/*dump($result->username);*/
		if($result->isban)
		{
			$this->error('您的账号已被禁用',url('login'));
		}
		else
		{
			Session::set('username',"$result->username");
			$this->success('登陆成功', 'index');
		}
	}
	//检查验证码
	public function checkyzm()
	{
		$yzmphone = $this->request->param('yzmphone');
		$yzm = $this->request->param('yzm');
		//如果验证码post传的验证码是yzmphone,进行手机验证
		if(!empty($yzmphone))
		{
			//return Session::get('yzm');
			if($yzmphone==Session::get('yzm'))
			{
				return [
					'code' => 1,
					'info' => '验证成功',
					];
			}
			else
			{
				return [
					'code' => 0,
					'info' => '验证失败',
					];
			}
		}
		else if(empty($yzmphone) && !empty($yzm))
		{
			$validate = new Validate([
			'captcha|验证码'=>'require|captcha'
			]);
			$data = [
				'captcha'=>$yzm,
			];
			if (!$validate->check($data)) {
				return [
					'code' => 0,
					'info' => $validate->getError(),
					];
			} else {
				return [
					'code' => 1,
					'info' => '验证成功',
				];
			}
		}
	}
	//用户退出,清除session(重定向)
	public function logout()
	{
		Session::clear();
		$this->redirect('index');
	}
	//检查用户是否登陆
	public function userCheck()
	{
		if(empty(Session::get('username')))
		{
			return [
				'code' => 0,
				'info' => [
					'islogin' => 1,
				]
			];
		}
		else if(!empty(Session::get('username')))
		{
			return [
				'code' => 0,
				'info' => [
				'is_login'=>1,
				'userid' => 1,
				'name'	 => Session::get('username'),
				'mobilephone' => 1231,
				'header' => 123
			],
		];
		}	
	}
}
