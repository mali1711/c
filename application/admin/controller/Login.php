<?php

namespace app\admin\controller;

use app\admin\model\Admins;
use think\Controller;
use think\Session;

class Login extends Controller
{
    /**
     * 登录验证
     */
    public function getlogin()
    {
        $where['admins_pass'] = md5(md5(123456));
        $where['admins_iphone'] = 18396861513;
        $admin = new Admins();
        $r = $admin->where($where)->find();
        if($r){
            Session::set('login',$r);
            $this->success('登录成功','/ALndex/index');
        }else{
            $this->error('账号或者密码错误');
        }
    }
}
