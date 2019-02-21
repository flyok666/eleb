<?php

namespace App\Http\Controllers\Shop;

use Illuminate\Database\QueryException;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class ShopController extends Controller
{
    //商家注册
    public function store(Request $request)
    {
        //使用事务，前提 保证数据表存储引擎是InnoDB
        //提交表单
        //保存商家信息
        //DB::transaction(function () use ($request) {
        DB::beginTransaction();
        try{
            $shop = new Shop();
            $shop->xxx = $request->xxx;
            //...
            $shop->save();
            //保存账号信息
            $user = new User();
            //$shop->xxx = $request->xxx;
            //...
            $user->shop_id = $shop->id;
            $user->save();
            DB::commit();
        }catch (QueryException $e){
            DB::rollBack();
        }


       //});
    }
}
