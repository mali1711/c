<?php

namespace app\admin\controller;

use app\admin\model\Shoppers;
use think\Controller;
use think\Db;
use think\Request;

class Shopper extends Controller{


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
        $shoppers->data($data);
        $res = $shoppers->save();
        return $res;
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
