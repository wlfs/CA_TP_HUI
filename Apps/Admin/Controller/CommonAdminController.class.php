<?php
namespace Admin\Controller;
class CommonAdminController extends AdminController {
	public function index()
	{
		parent::checkAuth('CommonAdmin.Index');
		$s=D('CommonAdmin');
		// $s->setPageRowsCount(2);
		$p=$s->pageLis(I('kw'));
		$this->pageInfo=$p;
		$this->display();
	}
	public function disable()
	{
		parent::checkAuth('CommonAdmin.Index');
		if(IS_POST){
			$r=D('CommonAdmin')->disable(I('id'));
			$this->ajaxReturn($r);
		}
	}
	public function recovery()
	{
		parent::checkAuth('CommonAdmin.Index');
		if(IS_POST){
			$r=D('CommonAdmin')->recovery(I('id'));
			$this->ajaxReturn($r);
		}
	}
	public function del()
	{
		parent::checkAuth('CommonAdmin.Index');
		if(IS_POST){
			$r=D('CommonAdmin')->del(I('id'));
			$this->ajaxReturn($r);
		}
	}
	public function add()
	{
		parent::checkAuth('CommonAdmin.Index');
		if(IS_POST){
			$model=D('CommonAdmin');
			$model->create();
			
			$model->group_ids=I('group_ids');
			$r=$model->addResult();
			$this->ajaxReturn($r);
		}
		$this->groups=D('CommonGroups')->select();
		$this->display();
	}
	public function modify($id)
	{
		parent::checkAuth('CommonAdmin.Index');
		$model=D('CommonAdmin');
		if(IS_POST){
			$model->create();
			$model->group_ids=I('group_ids');
			$r=$model->updateResult();
			$this->ajaxReturn($r);
		}
		$this->info=$model->find($id);
		$this->groups
		=M('CommonGroups')->alias('g')->join('common_admin_group ag on ag.group_id=g.id and ag.admin_id='.$id,'left')->field('g.id,g.name,case when ag.group_id is null then 0 else 1 end checked')->select();
		// var_dump($this->groups);
		$this->display();
	}
	public function setPassword($id)
	{
		parent::checkAuth('CommonAdmin.Index');
		$model=D('CommonAdmin');
		if(IS_POST){
			$r=$model->resetPwd($id,I('password'));
			$this->ajaxReturn($r);
		}
		$this->info=$model->find($id);
		$this->display();
	}
}