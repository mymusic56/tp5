<?php
namespace app\index\controller;
use app\index\model\User;
use think\View;
use think\Controller;
use think\Loader;

class Test extends Controller{
	
	/**
	 * 前置操作
	 * @var array
	 */
	protected $beforeActionList = [
			'helloFirst',
			'helloSecond' => ['except'=>'hello'],
			'helloThree'
	];
	
	public function test(){
		var_dump("Test test");
	}
	
	public function renderView(){
		$users = User::all(function($query){
			$query->where(['gender'=>1])->limit(3)->order('id','desc');
		});
		
		foreach($users as $key=>$user){
			echo $user->name.'--';
		}
		

// 		$this->assign('users', $users);
// 		$this->assign('name', 'Adminstrator');
// 		return $this->fetch();

		$view = new View();
		$view->name = 'thinkphp';
		$view->users = $users;
		return $view->fetch();
	}
	
	public function modelSave(){
		$user = new User();
		$user->data(array(
				'name' => 'zhangsan',
				'email' => 'zhangsan@123.com'
		));
		$res = $user->save();
		var_dump($res);
		
	}
	
	public function modelGet(){
		//实例化
		$userObj = new User();
		$res = $userObj->get(28);
		var_dump($res->name);
		
		/*
		 * 静态调用
		 */
		// 使用数组查询
		$user = User::get(['name' => 'thinkphp']);
		var_dump($user->name);
		
		// 使用闭包查询
		$user = User::get(function($query){
			$query->where('name', 'thinkphp');
		});
		var_dump('使用闭包：'.$user->name);
		
		// 使用 Loader 类实例化（单例）
		$user = Loader::model('User');
		$res = $user->get(2);
		var_dump('Loader: id:'.$res->id);
		
		//模型助手
		$userObj = model('User');
		$res = $userObj->get(27);
		var_dump('模型助手获取：'.$res->name);
	}
	
	public function modelGetAll(){
// 		$users = User::all('27,28');
		$users = User::all([27,28]);
		foreach ($users as $key => $u){
			var_dump($u->name);
		}
	}
	
	public function helloFirst(){
		var_dump('first');
	}
	public function helloSecond(){
		var_dump('second');
	}
	public function helloThree(){
		var_dump('three');
	}
	public function hello(){
		var_dump('Hello');
	}
	
}