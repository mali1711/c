<?php
/**
 * Created by PhpStorm.
 * User: 马黎
 * Date: 2018/11/5
 * Time: 7:01
 * Explain：分类
 */
namespace app\index\controller;

use app\admin\model\Categorys;
use app\admin\model\Goods;
use think\Controller;
use think\Request;

class Category extends Controller{

    /**
     * 分类列表
     */
    public function getlist()
    {
        $category = new Categorys();
        $list = $category->all();
        return json($list);
    }


    public function getgoodlist()
    {
        $categorys_id = input('?get.categorys_id');
        $goods = new Goods();
        $list = $goods->where('categorys_id',$categorys_id)->all();
        return $list;
    }
}