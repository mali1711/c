<?php
/**
 * Created by PhpStorm.
 * User: 马黎
 * Date: 2018/11/5
 * Time: 8:01
 * Explain：购物车
 */
namespace app\index\controller;

use app\index\model\Shopcarts;
use think\Controller;
use think\Db;
use think\Request;
use think\Session;

class Shopcart extends Controller{

    /**
     * @var 正在操作的用户的id
     */
    protected $users_id;

    /**
     * 获取商品数量
     */
    public function getlist()
    {
        $users_info = Session::get('users.login');
        $list = Db::table('shopcarts')->where('users_id',$users_info->users_id)->select();
        foreach ($list as $key=>$val){
            $list[$key]['goodsinfo'] = Db::table('goods')->find($val['goods_id']);
        }
        return json_encode($list);
    }

    /**
     * 添加商品
     */
    public function getplus()
    {
//        $users_info = Session::get('users.login');
        $data = array(
            'users_id'=> 1,
            'goods_id'=> input('get.goods_id'),
            'shopCarts_addtime'=> date('Y-m-d H:i:s'),
        );
        if($da = $this->issetCart($data)){
            return json_encode($da);
        }else{
            $shopcarts = new Shopcarts();
            $res = $shopcarts->data($data)->save();
            if($res){
                $this->success('购物车添加成功');
            }else{
                $this->success('购物车添加失败');
            }
        }

    }

    /**
     * 判断某人的购物车是否有存在某个商品
     * @param null $data
     * @return array|bool|null
     */
    protected function issetCart($data = null)
    {
        $where = array(
            'users_id'=> $data['users_id'],
            'goods_id'=> $data['goods_id'],
        );
        $shopcarts = new Shopcarts();
        $res = $shopcarts->get($where);
        if($res){
            $r = $shopcarts->where($where)->setInc('shopCarts_num');
            if($r){
                $data = array(
                    'status' => true,
                    'msg' => '商品数量+1',
                );
            }else{
                $data = array(
                    'status' => false,
                    'msg' => '商品添加出现意外错误',
                );
            }
        }else{
            return false;
        }
        return $data;
    }
    
    /**
     * 减少购物车数量
     * GET id 购物车id
     */
    public function getreduce()
    {
        $id = input('get.id');
        $shopcart = new Shopcarts();
        $res = $shopcart->find($id);
        if($res==null){
            $data = array(
                'status' => false,
                'msg' => '商品不存在',
            ); 
            
            return json_encode($data);
        }
        if($res->shopCarts_num==1){
            $r = $shopcart->destroy($id);
            if($r){
                $data = array(
                    'status' => true,
                    'msg' => '商品删除成功',
                );
            }else{
                $data = array(
                    'status' => false,
                    'msg' => '商品删除出现意外错误',
                );
            }
        }else{
            $r = $shopcart->where('shopCarts_id',$id)->setDec('shopCarts_num');
            if($r){
                $data = array(
                    'status' => true,
                    'msg' => '商品数量-1',
                );
            }else{
                $data = array(
                    'status' => false,
                    'msg' => '商品删除出现意外错误',
                );
            }
        }
        return json_encode($data);
    }

    /**
     * 清空购物车
     */
    public function getempty()
    {
        $id = Session::get('users.login')->users_id;
        $shopcarts = new Shopcarts();
        $res = $shopcarts->where('users_id',$id)->delete();
        if($res>0){
            $data = array(
                'status' => true,
                'msg' => '购物车已经清空',
            );
        }else{
            $data = array(
                'status' => false,
                'msg' => '意外错误,可能是用户没有登录',
            );
        }
        return json_encode($data);
    }

    /**
     * 获取商品数量
     * @return int|string
     * @throws \think\Exception
     */
    public function getallGoodsNum()
    {
        $id = Session::get('users.login')->users_id;
        $shopcarts = new Shopcarts();
        $count = $shopcarts->where('users_id',1)->count();
        return $count;
    }

    /**
     * 单个商品的数量
     */
    public function getgoodNum()
    {
        $id = input('get.id');
        $cart =  new Shopcarts();
        $res = $cart->get($id);
        if($res){
            return $res->shopCarts_num;
        }else{
            return 0;
        }
    }
    
}
