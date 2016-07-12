<?php 
namespace Common\Model;

/**
 * 登录记录
 */
class CommonLoginRecordModel extends BaseModel
{
	public function addResult()
	{
		$this->created=time();
		return parent::addResult();
	}
	public function pageLis($keyword)
	{
		
		$map=array();
		if(!empty($keyword)){
			$map['a.name']=array('like',"%$keyword%");
		}
		$this->alias('m')->join('common_admin a on a.id=m.admin_id')
		->field('m.*,a.name');
		$p=parent::_getPageData($this,$map,'m.id desc');
		return $p;
	}
}