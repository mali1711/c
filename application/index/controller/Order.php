<?php
/**
 * Created by PhpStorm.
 * User: 马黎
 * Date: 2018/11/5
 * Time: 8:58
 */
namespace app\index\controller;

use app\index\model\Orders;
use app\index\model\Shopcarts;
use think\Controller;
use think\Request;
use think\Session;

class Order extends Controller{

    protected $users_id = '';//用户id

    public function _initialize()
    {
        $users_info = Session::get('users.login');
        $this->users_id = $users_info->users_id;
    }

    /**
     * 订单添加
     */
    public function postcreate()
    {
        $order = new Orders();
        $data = array_merge($data = $order->docreate(),input('post.'));
        $res = $order->data($data)->save();
        if($res){
            $shopcart = new Shopcart();
            $shopcart->getempty();//清空购物车
            $this->success('添加成功');
        }else{
            $this->error('添加失败');
        }
    }
    
    /**
     * 支付
     */
    public function getPay()
    {
        \alipay\Pagepay::pay($params);
    }

}
