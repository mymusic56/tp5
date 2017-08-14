<?php
namespace app\home\model;
use think\Model;

class User extends Model{
	protected $table = 'users';
	
	// 设置返回数据集的对象名
	protected $resultSetType = 'collection';
	
}