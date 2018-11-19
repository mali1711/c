<?php
// +----------------------------------------------------------------------
// | ThinkPHP [ WE CAN DO IT JUST THINK ]
// +----------------------------------------------------------------------
// | Copyright (c) 2006~2018 http://thinkphp.cn All rights reserved.
// +----------------------------------------------------------------------
// | Licensed ( http://www.apache.org/licenses/LICENSE-2.0 )
// +----------------------------------------------------------------------
// | Author: liu21st <liu21st@gmail.com>
// +----------------------------------------------------------------------
use \think\Route;

//return [
//    '__pattern__' => [
//        'name' => '\w+',
//    ],
//    '[hello]'     => [
//        ':id'   => ['index/hello', ['method' => 'get'], ['id' => '\d+']],
//        ':name' => ['index/hello', ['method' => 'post']],
//    ],
//
//];


//----------------------------------------------管理员端-----------------------------------
Route::get('aindex','admin/index');       //首页
Route::controller('aindex','admin/index');//首页
Route::controller('alogin','admin/Login');//登录
Route::controller('aadmin','admin/Admin');//管理员模块
Route::controller('acategory','admin/category'); //分类
Route::controller('agood','admin/Good');//商品模块
Route::controller('ashopper','admin/Shopper');  //商品模块

//----------------------------------------------用户端-----------------------------------
Route::controller('good','index/Good');//商品模块
Route::controller('category','index/Category'); //商品模块
Route::controller('shopcart','index/Shopcart'); //购物车
Route::controller('login','index/Login');       //登录
Route::controller('address','index/Address');//收货地址
Route::controller('order','index/Order');//订单

//---------------------------------------------骑手（配送员端）-----------------------------------------