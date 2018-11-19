<?php

namespace app\index\model;

use think\Db;
use think\Model;
use think\Session;
class Orders extends Model
{

    protected $pk = 'orders_id';

    protected $users_id = '';

    public function __construct()
    {
        parent::__construct();
        $users_info = Session::get('users.login');
        $this->users_id = $users_info->users_id;
    }

    /**
     * 订单提交
     * @return array
     */
    public function docreate()
    {
        //获取收货地址
        $address = Db::table('addresss')->where(['users_id'=>$this->users_id,'addresss_select'=>1])->find();
        //获取购物车列表
        $shopcart = Db::table('shopcarts')->where(['users_id'=>$this->users_id])->select();
        $count = 0;
        foreach ($shopcart as $key=>$value){
            $goods = Db::table('goods')->find($value['goods_id']);
            $shopcart[$key]['goodsInfo'] = $goods;
            $count += $goods['goods_price'] * $value['shopCarts_num'].'<br/>';

        }
        $orders_detail['address'] = $address;
        $orders_detail['shopcart'] = $shopcart;
        //初始化订单信息
        $data = array(
            'users_id'=>$this->users_id,
            'orders_number'=>date('YmdHis').rand(100000,999999),
            'orders_price'=>$count,
            'orders_detail'=>json_encode($orders_detail),
            'orders_addtime'=>date('Y-m-d H:i:s'),
        );
        return $data;
    }
}
