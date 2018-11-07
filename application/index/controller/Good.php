<?php
/**
 * Created by PhpStorm.
 * User: 马黎
 * Date: 2018/11/5
 * Time: 9:01
 * Explain：商品模块
 */
namespace app\index\controller;

use app\admin\model\Goods;
use think\Controller;
use think\Request;

class Good extends Controller{
    
    /**
     * 获取商品列表列表,
     */
    public function getlist($status=1)
    {
        $good = new Goods();
        $list = $good->where('goods_status','=',$status)->select();
        return json_encode($list);
    }

    /**
     * @param $num 获取推荐分类的商品列表
     * 获取推荐商品
     */
    public function getrecommend($num)
    {
        
    }

    /**
     * 获取轮播图推荐的商品
     */
    public function getCarousel()
    {
        
    }
}
