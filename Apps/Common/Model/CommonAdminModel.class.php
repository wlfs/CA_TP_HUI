<?php 
namespace Common\Model;

/**
 * 管理员
 */
class CommonAdminModel extends BaseModel
{
    public function pageLis($keyword,$status=0)
    {
        $map=array();
        if(!empty($keyword)){
            $map['u.name|u.mobile|u.login_name']=array('like',"%$keyword%");
        }
        if($status>0){
            $map['u.status']=$status;
        }
        $this->alias('u');
        $p=parent::_getPageData($this,$map,'u.id desc');
        int_to_string($p->data,array('status'=>$this->getStatus()));
        return $p;
    }
    public function getStatus()
    {
        $data['1']='正常';
        $data['2']='禁用';
        return $data;
    }
    /**
     * 添加管理员
     */
    public function addResult() {
        $d=$this->data;
        $lnl=strlen($d['login_name']);
        if($lnl>4&&$lnl<=20){

        }else{
            return RE('登录名必须是5到20位的字符串！');
        }
        $this->created=time();
        $map['login_name']=$d['login_name'];
        $c=$this->where($map)->count();
        if($c>0){
            return RE('用户名已存在');
        }
        $d['salt']=randomkeys(4);
        $d['created']=time();
        $d['password']=md5(md5($d['password']).$d['salt']);
        $d['last_login_ip']=get_client_ip();
        $d['last_login_time']=time();
        $d['last_login_address']=getIPAddress($d['last_login_ip']);
        $id=$this->add($d);
        //添加用户组
        if(count($d['group_ids'])>0){
            $adminGroups=array();
            $adminGroup['admin_id']=$id;
            foreach ($d['group_ids'] as $key => $value) {
                $adminGroup['group_id']=$value;
                $adminGroups[]=$adminGroup;
            }
            M('CommonAdminGroup')->addAll($adminGroups);
        }
        return RD($d);
    }
    public function updateResult()
    {
        $d=$this->data;
        if($d['id']>0){
            $c=$this->save();
            $agModel=M('CommonAdminGroup');
            $map['admin_id']=$d['id'];
            $agModel->where($map)->delete();
            if(count($d['group_ids'])>0){
                $adminGroups=array();
                $adminGroup['admin_id']=$d['id'];
                foreach ($d['group_ids'] as $key => $value) {
                    $adminGroup['group_id']=$value;
                    $adminGroups[]=$adminGroup;
                }
                $agModel->addAll($adminGroups);
            }

        }else{
            return RE('修改失败，未传管理员编号！');
        }
        return RS('成功');
    }

    /**
     * 保存权限组
     * @param  int $id   管理员编号
     * @param  array $gids 权限组编号数组
     * @return [type]       
     */
    public function saveGroups($id,$gids)
    {
        $m=M('CommonAdminGroup');
        $map['admin_id']=$id;
        $m->where($map)->delete();
        $ads=array();
        $ad['admin_id']=$id;
        foreach ($variable as $key => $value) {
            $ad['group_id']=$value;
            $ads[]=$ad;
        }
        $m->addAll($ads);
    }
    /**
     * 用户登录
     * @param  [type] $uname [description]
     * @param  [type] $pass  [description]
     * @return [type]        [description]
     */
    public function login($uname, $pass) {
        $map['login_name'] = $uname;
        $ainfo=$this->where($map)->find();
        if ($ainfo) {
            //验证用户密码是否正确
            if($ainfo['password']==md5($pass.$ainfo['salt'])){
                unset($ainfo['password']);
                unset($ainfo['salt']);
                $up['last_login_ip']   = get_client_ip();
                $up['id']              = $ainfo['id'];
                $up['last_login_time'] = time();
                $up['last_login_address']=getIPAddress($up['last_login_ip']);
                $this->save($up);
                //添加登录日志
                $loginRecordModel=D('CommonLoginRecord');
                $loginRecordModel->ip= $up['last_login_ip'];
                $loginRecordModel->ip_address=$up['last_login_address'];
                $loginRecordModel->admin_id= $ainfo['id'];
                $loginRecordModel->addResult();
                return RD($ainfo);
            } else {
                return RE('用户名或密码错误');
            }
        }
        return RE('用户名或密码错误');
    }
    /**
     * 重置密码
     * @param  int $userId 用户编号
     * @return resultObj        
     */
    public function resetPwd($userId, $pwd) {
        $data["id"]       = $userId;
        $data['salt']     = randomkeys(4);
        $data['password'] = md5(md5($pwd) . $data['salt']);
        $this->save($data);
        return RS("重置成功");
    }

    /**
     * 重置密码
     * @param  int $userId 用户编号
     * @return resultObj        
     */
    public function resetPwd2($userId, $oldPass, $pwd) {
        $info = $this->find($userId);
        if ($info['password'] == md5(md5($oldPass) . $info['salt'])) {
            $data["id"]       = $userId;
            $data['salt']     = randomkeys(4);
            $data['password'] = md5(md5($pwd) . $data['salt']);
            $this->save($data);
            return RS("操作成功");
        } else {
            return RE('密码错误！');
        }
    }

    /**
     * 设置状态
     * @param  int $userId 用户编号
     * @param  int $state  用户状态
     * @return [type]         [description]
     */
    public function updateStatus($userId, $state) {
    	$data['id']     = $userId;
    	$data['status'] = $state;
    	$this->save($data);
    	return RS("设置状态成功");
    }

    /**
     * 禁用
     * @param [type] $user_id 用户编号
     */
    public function disable($user_id) {
    	return $this->updateStatus($user_id, 2);
    }

    /**
     * 恢复
     * @param  [type] $user_id [description]
     * @return [type]          [description]
     */
    public function recovery($user_id) {
    	return $this->updateStatus($user_id, 1);
    }

    /**
     * 删除
     * @param  [type] $id [description]
     * @return [type]     [description]
     */
    public function del($id) {
    	if ($id == 1) {
    		return RE('超级管理员不能删除');
    	} else {
    		$map['id'] = $id;
    		$i=$this->where($map)->delete();
    		if ($i > 0) {
    			return RS('删除成功');
    		}else{
    			return RE('删除失败');
    		}
    	}
    }
}
?>