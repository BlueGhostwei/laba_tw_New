<?php

namespace App\Http\Controllers\Admin;


use App\Http\Controllers\Controller;
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
        $order_id=date('YmdHis') . mt_rand(1000,9999);
        $order_price=0.01;
        $goods_name="情人节狗粮";
        $goods_description="";//产品描述暂无
        $alipay->setOutTradeNo($order_id);
        $alipay->setTotalFee($order_price);
        $alipay->setSubject($goods_name);
        $alipay->setBody($goods_description);
        $alipay->setQrPayMode('4'); //该设置为可选，添加该参数设置，支持二维码支付。

        // 跳转到支付页面。
        return redirect()->to($alipay->getPayLink());
    }
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
            case 'TRADE_FINISHED':
                // TODO: 支付成功，取得订单号进行其它相关操作。
                Log::debug('Alipay notify post data verification success.', [
                    'out_trade_no' => Input::get('out_trade_no'),
                    'trade_no' => Input::get('trade_no')
                ]);
                break;
        }

        return 'success';
    }

    /**
     * @return mixed
     *
     */
    public function webreturn(){
     // 验证请求。
        if (! app('alipay.web')->verify()) {
            Log::notice('Alipay return query data verification fail.', [
                'data' => Request::getQueryString()
            ]);
            return view('alipay.fail');
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

        return view('alipay.success');

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
