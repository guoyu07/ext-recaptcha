<?php
/**
 * This file is part of Notadd.
 *
 * @copyright (c) 2017, notadd.com
 * @datetime      17-6-23 下午3:31
 */
namespace Notadd\BCaptcha\Handlers;

use Notadd\BCaptcha\Models\Sms;
use Notadd\Foundation\Routing\Abstracts\Handler;
use Illuminate\Support\Facades\Request;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Input;
use Overtrue\EasySms\EasySms;


class SendHandler extends Handler
{


    public function Execute()
    {
        $config=require_once (__DIR__ . '/../../config/config.php');
        $easySms = new EasySms($config);

        $this->validate($this->request, [
            'tel' => 'required|regex:/^1[34578][0-9]{9}$/',
        ], [
            'tel.required' => '请输入手机号',
        ]);

        $ran=random_int(100000,999999);
        $tel=$this->request->tel;

        $data=$easySms->send($tel, [
            'template' => 'SMS_78895462',
            'data' => [
                'code' => $ran
            ],
        ]);

        if(!is_array($data)){
            return $this->withCode(400)->withError('发送验证码失败!');
        }

        $exist=Sms::where('tel',$tel)->first();

        $captcha=$exist?$exist:new Sms();
        $captcha->tel=$tel;
        $captcha->code=$ran;
        if($captcha->save()){
            return $this->withCode(200)->withData(true)->withMessage('发送成功');
        }else{
            return $this->withCode(201)->withError('发送成功');
        }

    }
}
