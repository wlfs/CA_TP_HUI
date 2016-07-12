<?php
namespace Admin\Controller;
class CommonGroupsController extends AdminController {
	public function index()
	{

		parent::checkAuth('CommonGroups.Index');
		$this->lis=D('CommonGroups')->select();
		$this->display();
	}
	public function add()
	{
		parent::checkAuth('CommonGroups.Index');
		if(IS_POST){
			$model=D('CommonGroups');
			$model->create();
			$r=$model->addResult();
			$this->ajaxReturn($r);
		}
		$this->display();
	}
	public function modify($id)
	{
		parent::checkAuth('CommonGroups.Index');
		$model=D('CommonGroups');
		if(IS_POST){
			$model->create();
			$r=$model->updateResult();
			$this->ajaxReturn($r);
		}
		$this->info=$model->find($id);
		$this->display();
	}
	public function del()
	{
		parent::checkAuth('CommonGroups.Index');
		if(IS_POST){
			$r=D('CommonGroups')->delResult(I('id'));
			$this->ajaxReturn($r);
		}
	}
	
	public function dels($value='')
	{
		parent::checkAuth('CommonGroups.Index');
		if(IS_POST){
			$r=D('CommonGroups')->delsResult(I('ids'));
			$this->ajaxReturn($r);
		}
	}
	public function auth($id)
	{
		parent::checkAuth('CommonGroups.Index');
		$model=D('CommonGroups');
		if(IS_POST){
			$r=$model->saveAuth($id,I('ids'));
			$this->ajaxReturn($r);
		}
		$this->tree=$model->ActionTree($id);
		$this->info=$model->find($id);
		$this->display();
	}
}