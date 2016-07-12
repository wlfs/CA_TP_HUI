<?php
namespace Admin\Controller;
use Think\Controller;
class CommonController extends Controller {

	#登录
	public function login()
	{
		if(IS_POST){
			$verify = new \Think\Verify();  
			if($verify->check(I('post.verify'),''))
			{
				$uname=I('uname');
				$pass=I('pass');
				$r=D('CommonAdmin')->login($uname,md5($pass));
				if($r->status==1){
					session('AdminInfo',$r->data);
					$this->_getActions($r->data['id']);
				}
				$return_url=session('login_return_url');
				if(empty($return_url)){
					$return_url=U('index/index');
				}
				$r->data=$return_url;
				$this->ajaxReturn($r);
			}else{
				$this->ajaxReturn(RE('验证码错误！'));
			}
			return;
		}
		$this->display();
	}
	#退出登录
	public function logout()
	{
		session('AdminInfo',false);
		$this->redirect("login");
	}
	#获取权限
	private function _getActions($uid)
	{
		$map['ug.admin_id']=$uid;
		$codes=M('common_admin_group')->alias('ug')->where($map)
		->join('common_group_action ga on ga.group_id=ug.group_id')
		->join('common_actions a on a.id=ga.action_id')
		->distinct('code')
		->getField('code',true);
		session('AdminActions',$codes);
	}
	#验证码
	public function verify()
	{
		$Verify = new \Think\Verify();  
		$Verify->fontSize = 18;  
		$Verify->length   = 4;  
		$Verify->useNoise = true;  
		$Verify->codeSet = '0123456789'; 
		$Verify->imageW = 120;  
		$Verify->imageH = 40;  
		$Verify->entry();
	}
}