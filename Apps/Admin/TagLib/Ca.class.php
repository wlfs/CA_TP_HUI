<?php 
namespace Admin\TagLib;
use Think\Template\TagLib;
class Ca extends TagLib{
	protected $tags   =  array(
		'auth'=>array('attr'=>'value')
		);
	public function _auth($tag,$content){
        $val=$tag['value'];
        $html="<?php if(checkAuth('$val')){?>";
        $html.=$this->tpl->parse($content);
        $html.='<?php } ?>';
        return $html;
    }
}