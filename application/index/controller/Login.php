<?php

namespace app\index\controller;

use app\index\model\Users;
use think\Controller;
use think\Request;
use think\Session;
class Login extends Controller{

    public function postdologin()
    {

//        $where['users_pass'] = md5(md5(input('post.users_pass')));
//        $where['users_iphone'] = input('post.users_iphone');

        $where['users_pass'] = md5(md5('123456'));
        $where['users_iphone'] = '18396861513';
        dump($where);
        $users = new Users();
        $list = $users->where($where)->find();
        if($list){
            Session::set('users.login',$list);
            $this->success('登录成功');
        }else{
            $this->error('手机号或者密码错误');
        }
    }
}
