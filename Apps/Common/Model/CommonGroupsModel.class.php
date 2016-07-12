<?php 
namespace Common\Model;

/**
 * 管理员小组管理
 */
class CommonGroupsModel extends BaseModel
{
	public function dels($id)
	{
		$map['is_sys']=0;
		if(is_numeric($id)){
			$map['id']=$id;
		}else if(is_array($id)){
			$map['id']=array('in',$id);
		}
		$i=$this->where($map)->delete();
		if($i>0){
			return RS('删除成功！');
		}else{
			return RE('系统用户组不能删除！');
		}
	}
	public function ActionTree($group_id)
	{

		$lis=M('CommonActions')->alias('m')->join('common_group_action cga on cga.action_id=m.id and cga.group_id='.$group_id,'left')->field('m.*,cga.group_id')->select();
		return D('Tree')->toTree($lis);
	}
	public function saveAuth($group_id,$aids)
	{
		$model=M('common_group_action');
		$map['group_id']=$group_id;
		$model->where($map)->delete();
		$adr=array();
		$ad['group_id']=$group_id;
		foreach ($aids as $key => $value) {
			$ad['action_id']=$value;
			$adr[]=$ad;
		}
		$model->addAll($adr);
		return RS();
	}
}