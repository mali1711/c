<?php
/**
 * Created by PhpStorm.
 * User: 马黎
 * Date: 2018/11/5
 * Time: 7:01
 * Explain：收货地址
 */
namespace app\index\controller;

use app\index\model\Addresss;
use think\Controller;
use think\Request;
use think\Session;

class Address extends Controller{

    /**
     * 添加收货地址
     */
    public function postcreate()
    {
        $address = new Addresss();
        $data = input('post.');
        $data['addresss_addtime'] = date('Y-m-d H:i:s');
        $data['users_id'] = Session::get('users.login')->users_id;
        $res = $address->data($data)->save();
        if($res){
            $data = array(
                'error'=>0,
                'msg'=>'收货地址添加成功',
            );
        }else{
            $data = array(
                'error'=>0,
                'msg'=>'意外错误',
            );
        }

        return json($data);
    }
    
    /**
     * 获取个人收货地址列表
     */
    public function getlist()
    {
        $address = new Addresss();
        $list = $address->all(['users_id'=>Session::get('users.login')->users_id]);
        return json($list);
    }

    /**
     * 删除收货地址
     */
    public function getdel()
    {
        $id = input('get.id');
        $address = new Addresss();
        $where['addresss_id'] = $id;
        $where['users_id'] = Session::get('users.login')->users_id;
        $res = $address->destroy($where);
        if($res){
            $this->success('删除成功');
        }else{
            $this->error('意外错误');
        }
    }
    
    /**
     * 设置默认收货地址
     */
    public function getsetDefault()
    {
        $id = input('get.id');
        $address = new Addresss();
        $address->save(['addresss_default'=>0],['users_id'=>Session::get('users.login')->users_id]);
        $address = new Addresss();
        $where['addresss_id'] = $id;
        $where['users_id'] = Session::get('users.login')->users_id;
        $res = $address->save(['addresss_default'=>1],$where);
        if($res){
            $data = array(
                'error'=>0,
                'msg'=>'默认地址设置成功',
            );
        }else{
            $data = array(
                'error'=>0,
                'msg'=>'默认地址设置出现意外错误',
            );
        }
        return json($data);
    }

    /**
     * 获取默认收货地址
     */
    public function getdefault()
    {
        $where['users_id'] = Session::get('users.login')->users_id;
        $where['addresss_default'] = 1;
        $address = new Addresss();
        $list = $address->get($where);
        if($list){
            $data = array(
                'error'=>'0',
                'msg'=>'收货地址获取成功',
                'data'=>$list,
            );
        }else{
            $data = array(
                'error'=>'0',
                'msg'=>'收货地址获取失败，请选择收货地址',
            );
        }
        return json($data);
    }

    /**
     * 选择收货地址
     */
    public function getsetselect()
    {
        $address = new Addresss();
        $address->save(['addresss_select'=>0],['users_id'=>Session::get('users.login')->users_id]);
        $res = $address->save(['addresss_select'=>1],['addresss_id'=>input('get.id')]);
        return $res;
    }

    /**
     * 获取购买时选择的收货地址
     */
    public function getselect()
    {
        $address = new Addresss();
        $address->save(['addresss_select'=>0],['users_id'=>Session::get('users.login')->users_id]);
        $where['addresss_select'] = 1;
        $where['users_id'] = Session::get('users.login')->users_id;
        $data = $address->get($where);
        if($data){
            $result = array(
                'error'=>'0',
                'msg'=>'信息获取成功',
                'data'=>$data,
            );
        }else{
            $result = array(
                'error'=>'1',
                'msg'=>'没有选择收货地址，也没有默认地址',
            );
        }


        return json_encode($result);

    }
}
