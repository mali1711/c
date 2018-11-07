<?php

namespace app\index\model;

use think\Db;
use think\Model;

class Shopcarts extends Model
{
    //
    protected $pk = 'shopCarts_id';

    /**
     * 根据商品id删除购物车！
     * @param $id
     * @return int 被加入购物车数的数量
     * @throws \think\Exception
     */
    public function delOfGoods($id)
    {
       return Db::table('shopcarts')->where(['goods_id'=>$id])->delete();
    }
}
