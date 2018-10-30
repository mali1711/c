<?php

namespace app\admin\controller;

use app\admin\model\Admins;
use think\Controller;
use think\Request;

class Admin extends Controller
{
    public function getindex()
    {

    }

    /**
     * 查看所有管理员
     */
    public function getshow()
    {
        $admin = new Admins();
        $list = $admin->all();
        echo json_encode($list);
    }

    /**
     * 添加管理员
     */
    public function postadd()
    {
        $array['admins_iphone'] = input('post.admins_iphone');
        $array['amdins_name'] = input('post.amdins_name');
        $array['admins_pass'] = md5(md5(input('post.admins_pass')));
        $array['admins_addtime'] = date('Y-m-d H:i:s');
        $admin = new Admins();
        $admin->data($array);
        $res = $admin->save();
        if($res){
            $this->success('新用户添加成功');
        }else{
            $this->error('用户添加失败');
        }
    }

    /**
     * 跳转修改页面
     */
    public function gettupdate()
    {
        $res = Admins::get(input('get.admins_id'));

    }

    /**
     * 修改管理员信息
     */
    public function postupdate()
    {
        $id = input('post.admins_id');
        $array['admins_iphone'] = input('post.admins_iphone');
        $array['amdins_name'] = input('post.amdins_name');
        $array['admins_pass'] = md5(md5(input('post.admins_pass')));
        $array['admins_updatetime'] = date('Y-m-d H:i:s');
        $data = $array;
        $admin = new Admins();
        $res = $admin->save($data,['admins_id'=>$id]);
        if($res){
            $this->success('修改成功');
        }else{
            $this->error('修改失败');
        }
    }

}
