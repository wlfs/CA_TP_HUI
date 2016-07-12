<?php
namespace Admin\Controller;
use Think\Controller;
//
class AdminController extends Controller {
	function __construct()
	{
		parent::__construct();
		$this->__checkAuth();
		
	}
	//安卓运行检查
	private function __checkAuth()
	{
		$info=session('AdminInfo');
		if($info){
			define('UID',$info['id']);
		}else{
			session('login_return_url',$_SERVER['REQUEST_URI']);
			$this->redirect('Common/login');
		}
	}
	
	public function checkAuth($key)
	{
		if(checkAuth($key)){

		}else{
			if(IS_AJAX){
				$this->ajaxReturn(RE('-2','暂无权限！'));
			}else{
				$this->display('Common/not_have_permission');
			}
			exit;
		}
	} 
}