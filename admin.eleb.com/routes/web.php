<?php

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/', function () {
    return view('welcome');
});

Route::domain('admin.eleb.test')->group(function () {
    Route::namespace('Admin')->group(function () {
        Route::resource('shop_categories','ShopCategoryController');

        //文件上传
        Route::post('/upload','ShopCategoryController@upload')->name('upload');
    });

});

//接口
//商家列表
Route::get('/api/business_list','Api\ApiController@busniessList');
//注册接口
Route::post('/api/register',function(){
    return 'ok';
});

//发送短信接口
Route::get('/api/sms','Api\ApiController@sms');

//统计demo
Route::get('/tongji',function(){


    $datas = [
        '2019-03-04'=>55,
        '2019-03-03'=>144,
        '2019-03-02'=>255,
        '2019-03-01'=>535,
        '2019-02-28'=>855,
        '2019-02-27'=>205,
        '2019-02-26'=>5,
    ];
    return view('www.tongji',compact('datas'));
});

Route::get('orderPay',function(){
    return 'pay';
});

Route::get('/mail',function(){
	$title = '全新体验，手机也能玩转网易邮箱2.0';
	$content = '<p>	
重要的邮件如何才能让<span style="color: red">对方立刻查看</span>！
随身邮，可以让您享受随时短信提醒和发送邮件可以短信通知收件人的服务，重要的邮件一个都不能少！</p>';
	try{
        \Illuminate\Support\Facades\Mail::send('email.default',compact('title','content'),
            function($message){
                $to = 'xunzhaomeijia2@163.com';
                $message->from(env('MAIL_USERNAME'))->to($to)->subject('阿里云数据库10月刊:Redis2发布');
            });
    }catch (Exception $e){
	    return '邮件发送失败';
    }


    
});

//添加用户路由
Route::group(['middleware' => ['permission:user.add']], function () {
    Route::get('user/add', 'XXXController@add')->name();
    Route::post('user/save', 'XXXController@add')->name();
});
//查看用户路由
Route::group(['middleware' => ['permission:user.index']], function () {
    Route::get('user/index','XXXController@add');
});

//根据角色
//Route::group(['middleware' => ['role:用户管理员']], function () {
    Route::resource('admins', 'AdminController');
//});