<?php

namespace app\admin\controller;

use app\admin\model\Shoppers;
use think\Controller;
use think\Db;
use think\Request;

class Shopper extends Controller{

    public function getshow()
    {
        $list = Shoppers::all();
        $this->assign('list',$list);
        return $this->fetch('shopper/show');
    }

    public function getadd()
    {
       return $this->fetch('shopper/add');
    }
    /**
     * 添加骑手
     * @return false|int
     */
    public function postadd()
    {
        $shoppers = new Shoppers();
        $data = input('post.');
        $data['shoppers_pass'] = md5(md5(input('post.shoppers_pass')));
        $data['shoppers_addtime'] = date('Y-m-d H:i:s');
        $data['shoppers_pic'] = upload('shoppers_pic','/shoppers');
        $shoppers->data($data);
        $res = $shoppers->save();
        if($res){
            $this->success('配送骑手添加成功');
        }else{
            $this->success('配送骑手添加失败');
        }
    }

    /**
     * 删除骑手
     * @return int
     */
    public function getdel()
    {
        $shoppers = new Shoppers();
        $res = $shoppers->destroy(input('get.id'));
        return $res;
    }
    
    
    /**
     * 修改骑手信息
     */
    public function postupdate()
    {
        $res = Db::table('Shoppers')->update(input('post.'));
        return $res;
    }
}
