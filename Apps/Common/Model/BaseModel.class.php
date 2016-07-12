<?php 
namespace Common\Model;
/**
*基础ModelClass
*每个Model都需要继承的Model 
*/
use Think\Model;
class BaseModel extends Model
{
	protected $pageRowsCount=20;
	function __construct()
	{
		parent::__construct();
	}
	public function setPageRowsCount($val) {
		$this->pageRowsCount = $val;
	}
	/**
	 *获取分页数据
	 */
	public function _getPageData($query, $where, $order) {
		$_t=clone $query;
		$count=$query->where($where)->count();
		$query=$_t;
		$Page = new \Think\Page($count, $this->pageRowsCount);
		$r = $query->where($where)->order($order)
		->limit($Page->firstRow . ',' . $Page->listRows)
		->select();
		$Page->setConfig('theme','%HEADER% %FIRST% %UP_PAGE% %LINK_PAGE% %DOWN_PAGE% %END%');
		$Page->data = array();
		if ($r) {
			$Page->data = $r;
		}
		return $Page;
	}
	public function addResult()
	{
		$id=$this->add();
		if ($id>0) {
			return RD($id);
		}else{
			return RE('失败');
		}
	}
	public function updateResult()
	{
		$c=$this->save();
		if ($c>0) {
			return RD($c);
		}else{
			return RE('失败');
		}
	}
	public function delResult($id)
	{
		$c=$this->delete($id);
		if ($c>0) {
			return RD($c);
		}else{
			return RE('失败');
		}
	}
	public function delsResult($ids)
	{
		$map['id']=array('in',$ids);
		$c=$this->where($map)->delete();
		if ($c>0) {
			return RD($c);
		}else{
			return RE('失败');
		}
	}
	
}
?>