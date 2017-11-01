<?php
namespace app\index\controller;

use \think\Controller;
use \think\Session;
use app\index\model\User;
use app\index\model\Address;

 class UserAddress extends Controller
 {
 	public function addressAdd()
 	{	
 		$address = new Address();
 		$data = $this->request->param();
 		if(empty($data['address_id'])||$data['address_id']==0){
 			//没有address_id为新增
 			if(empty($data['city_id'])){
 				$re = $address->data([
 					'user_id'	=>Session::get('userid'),	
 					'province'  =>$data['province_id'],
 					'county'	=>$data['county_id'],
 					'address'	=>$data['addres'],
 					'postcode'  =>$data['postcode'],
 					'phone'		=>$data['phone'],
 					'name'		=>$data['name'],
 				])->save();		
 			}else{
 				$re = $address->data([
 					'user_id'	=>Session::get('userid'),	
 					'province'  =>$data['province_id'],
 					'city'		=>$data['city_id'],
 					'county'	=>$data['county_id'],
 					'address'	=>$data['addres'],
 					'postcode'  =>$data['postcode'],
 					'phone'		=>$data['phone'],
 					'name'		=>$data['name'],
 				])->save();	
 			}	
 			if ($re) {
 				echo 1;
 			}else{
 				echo 0;
 			}
 		}else{
 			//修改
 			if(empty($data['city_id'])){
 				$re = $address->save([
 					'user_id'	  =>Session::get('userid'),	
 					'province'    =>$data['province_id'],
 					'county'	  =>$data['county_id'],
 					'address'	  =>$data['addres'],
 					'postcode'    =>$data['postcode'],
 					'phone'		  =>$data['phone'],
 					'name'		  =>$data['name'],
 				],['address_id'   =>$data['address_id']]);dump($address->getLastSql());die;		
 			}else{
 				$re = $address->save([
 					'user_id'	  =>Session::get('userid'),	
 					'province'    =>$data['province_id'],
 					'city'		  =>$data['city_id'],
 					'county'	  =>$data['county_id'],
 					'address'	  =>$data['addres'],
 					'postcode'    =>$data['postcode'],
 					'phone' 	  =>$data['phone'],
 					'name'		  =>$data['name'],
 				],['address_id'   =>$data['address_id']]);	
 				// 
 			}	
 			if ($re) {
 				echo 1;
 			}else{
 				echo 0;
 			}
 		}
 	}
 	//更新数据
 	public function addressUpdata()
 	{
 		$address_id = $this->request->param();
 		$data = Address::find($address_id);
 		echo json_encode($data);
 	}

 	//删除数据
 	public function addressDel()
 	{
 		$address_id = $this->request->param();
 		$re = Address::addDele($address_id);
 		if($re){
 			echo 1;
 		}else{
 			echo 0;
 		}
 	}

 	//设置默认地址
 	public function changeDefualt()
 	{
 		$data = $this->request->param();
 		$address_id = $data['add_id'];
 		//先将所有的状态赋值为0
 		$re = Address::setDefault();
 		if ($re) {
 			$result = Address::where('address_id',$address_id)->update(['status'=>1]);
 			if($result){
 				echo 1;
 			}else{
 				echo 0;
 			}
 		}
 	}
 }