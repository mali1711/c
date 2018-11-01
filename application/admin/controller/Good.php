<?php

namespace app\admin\controller;

use app\admin\model\Goods;
use app\admin\model\Categorys;
use think\Config;
use think\Controller;

class Good extends Controller
{
    public function getadd()
    {
        $list = Categorys::all();
        $this->assign('list',$list);
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
        $data['goods_addtime'] = date("Y-m-d H:i:s");
        $data['goods_pic'] = upload('goods_pic','/goods');
        $data['goods_detail_pic'] = upload('goods_detail_pic','/goods');
        $goods->data($data);
        $res = $goods->save();
        if($res){
          $this->success('商品添加成功');
        }else{
          $this->error('商品添加失败');
        }
    }

    /**
     * 商品列表
     */
    public function getshow()
    {
        $list = Goods::paginate(50);
        $this->assign('list',$list);
        return $this->fetch('good/show');
    }

    /**
     * 上传图片
     */
    public function postupload(){
        upload('image','/goods');
    }
}
