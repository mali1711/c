<?php

namespace app\admin\controller;

use app\admin\model\Goods;
use think\Config;
use think\Controller;

class Good extends Controller
{
    public function getadd()
    {
       return $this->fetch('good/add');
    }
    
    /**
     * 商品添加
     * @return false|int
     */
    public function postadd()
    {
        $goods = new Goods();
        $data = input('post.');
        $data['goods_pic'] = upload('goods_pic','/goods');
        $data['goods_detail_pic'] = upload('goods_detail_pic','/goods');
        $goods->data($data);
        $res = $goods->save();
        return $res;
    }

    /**
     * 商品列表
     */
    public function getshow()
    {

    }

    /**
     * 上传图片
     */
    public function postupload(){
        upload('image','/goods');
    }
}
