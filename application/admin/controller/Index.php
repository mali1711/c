<?php

namespace app\admin\controller;

use think\Controller;
use think\Session;
use \think\View;
class Index extends Controller
{
    public function getindex()
    {

        return  $this->fetch('index/index');
    }
}
