<?php

namespace app\admin\controller;

use app\admin\model\Categorys;
use think\Controller;

class Category extends Controller
{
    //
    public function postAdd()
    {
        $_POST['categorys_addtime'] = date('Y-m-d H:i:s');
        $categorys = new Categorys(input('post.'));
        $res = $categorys->allowField(true)->save();
    }

    /**
     * 修改分类
     */
    public function postupdate()
    {
        $_POST['categorys_addtime'] = date('Y-m-d H:i:s');
        $categorys = new Categorys();
        $res = $categorys->allowField(true)->save(input('post.'),['categorys_id' => input('post.id')]);
        if($res){
            $this->success('修改成功');
        }else{
            $this->error('修改分类失败');
        }
    }
    
    /**
     * 分类删除
     */
    public function getdel()
    {
        $id = input('get.id');
        $res = Categorys::destroy($id);
        if($res){
            $this->success('删除成功');
        }else{
            $this->error('操作失败');
        }
    }

    public function getshow()
    {
        $list = Categorys::all();
        $this->assign('list',$list);
        return $this->fetch('acategory/show');
    }
}
