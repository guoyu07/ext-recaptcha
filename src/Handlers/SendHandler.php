<?php
/**
 * This file is part of Notadd.
 *
 * @copyright (c) 2017, notadd.com
 * @datetime      17-6-23 下午3:31
 */
namespace Notadd\BCaptcha\Handlers;

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


        $ran=random_int(100000,999999);
        $tel=$this->request->tel;

        $data=$easySms->send($tel, [
            'template' => 'SMS_78895458',
            'data' => [
                'code' => $ran
            ],
        ]);
        return $this->withCode(200)->withData($data)->withError('返回成功');
    }
}
