<?php 
namespace Common\Model;

/**
 * 菜单管理
 */
class CommonMenusModel extends BaseModel
{
	public function listTreeFormat()
	{
		$lis=$this->order('weight desc')->select();
		return D('Tree')->toFormatTree($lis,'name');
	}
	public function listByPid($pid=0)
	{
		$map['pid']=$pid;
		$lis=$this->order('weight desc')->where($map)->select();
		return $lis;
	}
	public function defaultIcon()
	{
		$data['Hui-iconfont-root']='管理员';
		$data['Hui-iconfont-manage']='管理';
		$data['Hui-iconfont-home']='首页';
		$data['Hui-iconfont-system']='系统';
		return $data;
	}
}