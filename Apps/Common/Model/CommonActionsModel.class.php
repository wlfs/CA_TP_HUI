<?php 
namespace Common\Model;

/**
 * 功能管理
 */
class CommonActionsModel extends BaseModel
{
	public function listTreeFormat()
	{
		$lis=$this->select();
		return D('Tree')->toFormatTree($lis,'name');
	}
	public function listGroupTreeFormat()
	{
		$map['is_group']=1;
		$lis=$this->where($map)->select();
		return D('Tree')->toFormatTree($lis,'name');
	}
}