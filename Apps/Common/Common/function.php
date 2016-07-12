<?php 

/**
 * 返回失败信息
 * @param  int $state 失败状态（非1的数字）
 * @param  string $msg   失败消息
 * @return obj        
 */
function RE($msg,$state=-1)
{
	$result=new \stdClass();
	$result->status=$state;
	$result->info=$msg;
	return $result;
}
/**
 * 返回数据
 * @param  [type] $data [description]
 * @return [type]       [description]
 */
function RD($data,$info="成功",$state=1)
{
	$result=new \stdClass();
	$result->status=$state;
	if(is_null($data)){
		$result->data=array();
	}else{
		$result->data=$data;
	}
	$result->info=$info;
	return $result;
}


/**
 * 返回处理成功
 * @param  string $msg [description]
 * @return [type]      [description]
 */
function RS($msg='',$state=1)
{
	$result=new \stdClass();
	$result->status=$state;
	$result->info=$msg;
	return $result;
}

/**
 * select返回的数组进行整数映射转换
 *
 * @param array $map  映射关系二维数组  array(
 *                                          '字段名1'=>array(映射关系数组),
 *                                          '字段名2'=>array(映射关系数组),
 *                                           ......
 *                                       )
 * @author 朱亚杰 <zhuyajie@topthink.net>
 * @return array
 *
 *  array(
 *      array('id'=>1,'title'=>'标题','status'=>'1','status_text'=>'正常')
 *      ....
 *  )
 *
 */
function int_to_string(&$data,$map=array('status'=>array(1=>'正常',-1=>'删除',0=>'禁用',2=>'未审核',3=>'草稿'))) {

	if($data === false || $data === null ){
		return $data;
	}

	$data = (array)$data;
	foreach ($data as $key => $row){
		foreach ($map as $col=>$pair){
			if(isset($row[$col]) && isset($pair[$row[$col]])){
				$data[$key][$col.'_text'] = $pair[$row[$col]];
			}
		}
	}
	return $data;
}
/**
 * 生成随机字符串
 * @param  integer  $length 字符串长度
 * @param  integer  $z      字符串种子
 * @return String           随机字符串
 */
function randomkeys($length,$z=0)
{
	$pattern[0]='1234567890abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ';
	$pattern[1]='23456789ABCDEFGHJKLMNPQRSTUVWXYZ';
	$pattern[2]='0123456789';
	$key='';
	for($i=0;$i<$length;$i++)
	{
		$t=mt_rand(0,strlen($pattern[$z])-1);
		$key .= $pattern[$z]{$t};
	}
	return $key;
}
function getIPAddress($ip)
{
	import('ORG.Net.IpLocation');// 导入IpLocation类
	$Ip = new Org\Net\IpLocation(); // 实例化类 参数表示IP地址库文件
	$area = $Ip->getlocation($ip); // 获取某个IP地址所在的位置
	return   $area['country'] . $area['area'];
}
    ?>