<?php 
//订单查询
function wx_order_query($orderId){
	require_once dirname(__FILE__).'/lib/WxPayApi.php';
	$input = new WxPayOrderQuery();
	$input->SetOut_trade_no($orderId);
	$r=WxPayApi::orderQuery($input);
	if($r['trade_state']==' '){
		return 't';
	}else{
		return 'f';
	}
}
?>