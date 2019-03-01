<?php

namespace App\Http\Controllers\Api;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Qcloud\Sms\SmsSingleSender;
use Validator;

class ApiController extends Controller
{
    //获得商家列表接口
    public function busniessList()
    {
        //从数据表获取商家数据，然后构造成对应的json格式
        $shops = [
            [
                "id"=>"s10001",
                "shop_name"=> "上沙麦当劳",
                "shop_img"=> "/images/shop-logo.png",
                "shop_rating"=> 4.7,
                "brand"=> true,
                "on_time"=> true,
                "fengniao"=> true,
                "bao"=> true,
                "piao"=> true,
                "zhun"=> true,
                "start_send"=> 20,
                "send_cost"=> 5,
                "distance"=> 637,
                "estimate_time"=> 30,
                "notice"=> "新店开张，优惠大酬宾！",
                "discount"=> "新用户有巨额优惠！" 
            ],
            [
                "id"=> "s10002",
                "shop_name"=> "正宗川味卤鸡蛋，味道好得很！",
                "shop_img"=> "/images/shop-logo.png",
                "shop_rating"=> 3.5,
                "brand"=> false,
                "on_time"=> true,
                "fengniao"=> false,
                "bao"=> true,
                "piao"=> false,
                "zhun"=> true,
                "start_send"=> 20,
                "send_cost"=> 0,
                "distance"=> 347,
                "estimate_time"=> 20,
                "notice"=> "新店开张，优惠大酬宾！",
                "discount"=> "新用户有巨额优惠！"
            ]
        ];
        return $shops;
    }

    
    //发送短信
    public function sms(Request $request)
    {
        /*$this->validate($request,[
            'tel'=>'required'
        ]);*/

        $validator = Validator::make($request->all(), [
            'title' => 'required|unique:posts|max:255',
            'tel' => 'required|numeric|digits_between:11,11',
        ]);

        //dd($validator->errors());
        if ($validator->fails()) {
            return [
                "status"=> "false",
                "message"=> implode(' ',$validator->errors()->all()),//$validator->errors()->first('tel')
            ];
        }
        //dd(11111);
        //exit;
        //1分钟内同一个手机号只能发送一条短信
        //redis获取key的剩余生命周期（秒） ttl


        // 短信应用SDK AppID
        $appid = 1400189719; // 1400开头

// 短信应用SDK AppKey
        $appkey = "7571e72a66c0d376d93346d2ce7fb416";

// 需要发送短信的手机号码
        $phoneNumber = '183816753120';

// 短信模板ID，需要在短信应用中申请
        $templateId = 285069;  // NOTE: 这里的模板ID`7839`只是一个示例，真实的模板ID需要在短信控制台中申请

        $smsSign = "陈贸生活记录"; // NOTE: 这里的签名只是示例，请使用真实的已申请的签名，签名参数使用的是`签名内容`，而不是`签名ID`

        try {
            $ssender = new SmsSingleSender($appid, $appkey);
            $params = [mt_rand(1000,9999),5];
            $result = $ssender->sendWithParam("86", $phoneNumber, $templateId,
                $params, $smsSign, "", "");  // 签名参数未提供或者为空时，会使用默认签名发送短信
            //$rsp = json_decode($result);
            //echo $rsp;
            var_dump($result);
        } catch(\Exception $e) {
            var_dump($e);
        }
    }
}
