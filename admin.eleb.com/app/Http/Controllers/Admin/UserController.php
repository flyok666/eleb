<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class UserController extends Controller
{
    //修改密码
    public function changPassword(Request $request)
    {
        //表单三个字段 old_password new_password new_password_confirmation
        //验证
        $this->validate($request,[
            'old_password'=>'required',
            'new_password'=>'required|confirmed',//confirmed 要求new_password字段值和new_password_confirmation一致
            'new_password_confirmation'=>'required',
        ]);
        $admin = Auth::user();
        if(!Hash::check($request->old_password,$admin->password)){
            return back()->with('danger','旧密码不正确');
        }
        $admin->update(['password'=>Hash::make($request->new_password)]);
        //Auth::logout();
        //return redirect()->route('login')->with();

    }
}
