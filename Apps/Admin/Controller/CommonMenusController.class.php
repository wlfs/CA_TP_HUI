<?php
namespace Admin\Controller;
class CommonMenusController extends AdminController {
	public function index()
	{
		parent::checkAuth('CommonMenus.Index');
		$this->lis=D('CommonMenus')->listTreeFormat();
		$this->display();
	}
	public function add()
	{
		parent::checkAuth('CommonMenus.Index');
		$model=D('CommonMenus');
		if(IS_POST){
			$model->create();
			$r=$model->addResult();
			$this->ajaxReturn($r);
		}
		$this->lis=$model->listByPid();
		$this->icons=$model->defaultIcon();
		$this->display();
	}
	public function modify($id)
	{
		parent::checkAuth('CommonMenus.Index');
		$model=D('CommonMenus');
		if(IS_POST){
			$model->create();
			$r=$model->updateResult();
			$this->ajaxReturn($r);
		}
		$this->info=$model->find($id);
		$this->lis=$model->listByPid();
		$this->icons=$model->defaultIcon();
		$this->display();
	}
	public function del()
	{
		parent::checkAuth('CommonMenus.Index');
		if(IS_POST){
			$r=D('CommonMenus')->delResult(I('id'));
			$this->ajaxReturn($r);
		}
	}
	
	public function dels($value='')
	{
		parent::checkAuth('CommonMenus.Index');
		if(IS_POST){
			$r=D('CommonMenus')->delsResult(I('ids'));
			$this->ajaxReturn($r);
		}
	}
}