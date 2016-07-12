<?php
namespace Admin\Controller;
class CommonLoginRecordController extends AdminController {
	public function index()
	{
		parent::checkAuth('CommonLoginRecord.Index');
		$this->pageInfo=D('CommonLoginRecord')->pageLis();
		$this->display();
	}
	public function del()
	{
		parent::checkAuth('CommonLoginRecord.Index');
		if(IS_POST){
			$r=D('CommonLoginRecord')->delResult(I('id'));
			$this->ajaxReturn($r);
		}
	}
	public function dels()
	{
		parent::checkAuth('CommonLoginRecord.Index');
		if(IS_POST){
			$r=D('CommonLoginRecord')->delsResult(I('ids'));
			$this->ajaxReturn($r);
		}
	}
}