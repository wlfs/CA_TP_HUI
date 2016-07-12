<?php
namespace Admin\Controller;
class CommonActionsController extends AdminController {
	public function index()
	{
		parent::checkAuth('CommonActions.Index');
		$this->lis=D('CommonActions')->listTreeFormat();
		$this->display();
	}
	public function add()
	{
		parent::checkAuth('CommonActions.Index');
		$model=D('CommonActions');
		if(IS_POST){
			$model->create();
			$r=$model->addResult();
			$this->ajaxReturn($r);
		}
		$this->lis=$model->listGroupTreeFormat();
		$this->display();
	}
	public function modify($id)
	{
		parent::checkAuth('CommonActions.Index');
		$model=D('CommonActions');
		if(IS_POST){
			$model->create();
			$r=$model->updateResult();
			$this->ajaxReturn($r);
		}
		$this->info=$model->find($id);
		$this->lis=$model->listGroupTreeFormat();
		$this->display();
	}
	public function del()
	{
		parent::checkAuth('CommonActions.Index');
		if(IS_POST){
			$r=D('CommonActions')->delResult(I('id'));
			$this->ajaxReturn($r);
		}
	}
	public function dels($value='')
	{
		parent::checkAuth('CommonActions.Index');
		if(IS_POST){
			$r=D('CommonActions')->delsResult(I('ids'));
			$this->ajaxReturn($r);
		}
	}
}