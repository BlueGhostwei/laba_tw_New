<?php

namespace App\Http\Controllers\Admin;


use App\Http\Controllers\Controller;
use App\Models\Order;
use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Illuminate\Validation\Rules\In;
use Latrell\Alipay;
use Request;
use Log;
use Input;


class PayController extends Controller
{

    /**
     * @return mixed
     * 手机支付
     */
    public function mobile_pay(){
        // 创建支付单。
        $alipay = app('alipay.mobile');
        $order_id=date('YmdHis') . mt_rand(1000,9999);
        $order_price=0.01;
        $goods_name="情人节狗粮";
        $goods_description="";//产品描述暂无
        $alipay->setOutTradeNo($order_id);//订单号
        $alipay->setTotalFee($order_price);//价格
        $alipay->setSubject($goods_name);//商品名称
        $alipay->setBody($goods_description);//描述

        // 返回签名后的支付参数给支付宝移动端的SDK。
        return $alipay->getPayPara();
    }
    /**
     * @return mixed
     * 网页支付
     */
    public function index(){
        $alipay = app('alipay.web');
        $order_id = Controller::makePaySn(Auth::id());
        $order_price=Input::get('money');
        $goods_name="充值账户";
        $goods_description="";//产品描述暂无
        $alipay->setOutTradeNo($order_id);
        $alipay->setTotalFee($order_price);
        $alipay->setSubject($goods_name);
        $alipay->setBody($goods_description);
        if ($order_price<10){
            return json_encode(['msg'=>'每次充值不能低于10元！','sta'=>'1']);
        }else{
            $order = new Order();
            $order->type =1;
            $order->user_id=Auth::id();
            $order->price = $order_price;
            $order->title = '账户充值';
            $order->number = $order_id;
            $order->save();
            return json_encode(['msg'=>'','sta'=>'0','data'=>$alipay->getPayLink()]);
        }
    }


    /**
     * @return string
     *
     * 支付宝网页异步提示
     *
     */
    public function webnotify(){
        // 验证请求。
        if (! app('alipay.web')->verify()) {
            Log::notice('Alipay notify post data verification fail.', [
                'data' => Request::instance()->getContent()
            ]);
            return 'fail';
        }

        /**
         *
         * 判断通知类型。
         */

        switch (Input::get('trade_status')) {
            case 'TRADE_SUCCESS':
                $order = Order::where('number', '=', Input::get('out_trade_no'))->first();
                $order->state =1;
                $user = User::find($order->user_id);
                $user->wealth = $user->wealth + $order->price;
                $user->save();
                $order->save();
            case 'TRADE_FINISHED':
                // TODO: 支付成功，取得订单号进行其它相关操作。
                Log::debug('Alipay notify post data verification success.', [
                    'out_trade_no' => Input::get('out_trade_no'),
                    'trade_no' => Input::get('trade_no')
                ]);
                $order = Order::where('number', '=', Input::get('out_trade_no'))->first();
                $order->state =1;
                $user = User::find($order->user_id);
                $user->wealth = $user->wealth + $order->price;
                $user->save();
                $order->save();
        }
        return 'success';
    }

    /**
     * @return mixed
     *
     */
    public function webreturn(){
     // 验证请求。
        if (!app('alipay.web')->verify()) {
            Log::notice('Alipay return query data verification fail.', [
                'data' => Request::getQueryString()
            ]);
            return view('Admin.pay.payFail');
        }

        // 判断通知类型。
        switch (Input::get('trade_status')) {
            case 'TRADE_SUCCESS':
            case 'TRADE_FINISHED':
                // TODO: 支付成功，取得订单号进行其它相关操作。
                Log::debug('Alipay notify get data verification success.', [
                    'out_trade_no' => Input::get('out_trade_no'),
                    'trade_no' => Input::get('trade_no')
                ]);

                break;
        }

        return view('Admin.pay.paySuccess');

    }
    /**
     * 手机端
     * 支付宝异步通知
     */
    public function alipayNotify()
    {
        // 验证请求。
        if (! app('alipay.mobile')->verify()) {
            Log::notice('Alipay notify post data verification fail.', [
                'data' => Request::instance()->getContent()
            ]);
            return 'fail';
        }

        // 判断通知类型。
        switch (Input::get('trade_status')) {
            case 'TRADE_SUCCESS':
            case 'TRADE_FINISHED':
                // TODO: 支付成功，取得订单号进行其它相关操作。
                Log::debug('Alipay notify get data verification success.', [
                    'out_trade_no' => Input::get('out_trade_no'),
                    'trade_no' => Input::get('trade_no')
                ]);
                break;
        }

        return 'success';
    }
}
