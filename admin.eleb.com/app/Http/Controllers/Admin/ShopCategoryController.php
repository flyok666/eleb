<?php

namespace App\Http\Controllers\Admin;

use App\Models\ShopCategory;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Storage;

class ShopCategoryController extends Controller
{
    //商家分类列表
    public function index()
    {
        $shop_categories = ShopCategory::paginate(10);

        return view('admin.shop_category.index',compact('shop_categories'));
    }

    //添加商家分类
    public function create()
    {
        return view('admin.shop_category.create');
    }

    public function store(Request $request)
    {
        $this->validate($request,[
            'name'=>'required',
            'img'=>'required'
        ]);

        ShopCategory::create([
            'name'=>$request->name,
            'img'=>$request->img,
            'status'=>1
        ]);
    }


    //接受文件上传
    public function upload(Request $request)
    {
        $img = $request->file('file');
        $path = Storage::url($img->store('public/categories'));
        return ['path'=>$path];
    }
}
