<?php
namespace Admin\Controller;
use Think\Controller;
class IndexController extends AdminController {
    public function index(){
        $this->display();
    }
    public function config()
    {
    	$cModel=D('Config');
    	if(IS_POST){
    		$map['key']='subscribe_integral';
    		$ud['value']=I('subscribe_integral');
    		$cModel->where($map)->save($ud);
    		$map['key']='subscribe_red_packets';
    		$ud['value']=I('subscribe_red_packets');
    		$cModel->where($map)->save($ud);
    		$this->ajaxReturn(RS(''));
    	}
		$this->subscribe_red_packets=$cModel->getConfig('subscribe_red_packets',false);
		$this->subscribe_integral=$cModel->getConfig('subscribe_integral',false);	
    	$this->display();
    	# code...
    }
    public function resetPwd()
    {
    	if(IS_POST){
    		$s=D('Admin');
    		$r=$s->resetPwd2(UID,I('old'),I('pass'));
    		$this->ajaxReturn($r);
    	}
    	$this->display();
    }
    /**
     * 账号
     * @param  string $value [description]
     * @return [type]        [description]
     */
    public function personalInfo($value='')
    {
        $this->info=session('AdminInfo');
        $this->display();
    }
    /**
     * 设置皮肤(颜色)
     */
    public function setSkin()
    {
        $d['id']=UID;
        $d['skin']=I('skin');
        M('CommonAdmin')->save($d);
        $this->ajaxReturn(RS());
    }
}