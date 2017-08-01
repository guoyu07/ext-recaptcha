<?php
/**
 * This file is part of Notadd.
 *
 * @copyright (c) 2017, notadd.com
 * @datetime      17-6-23 下午3:31
 */
namespace Notadd\BCaptcha\Handlers;

use Illuminate\Container\Container;
use Notadd\BCaptcha\Models\Sms;
use Notadd\Foundation\Routing\Abstracts\Handler;
use Overtrue\EasySms\EasySms;
use Notadd\Foundation\Setting\Contracts\SettingsRepository;
class SendHandler extends Handler
{
    protected $easySms;

    public function __construct(Container $container,SettingsRepository $settings)
    {
        parent::__construct($container);
        $this->setting=$settings;
        $config = require_once(__DIR__ . '/../../config/config.php');
        $this->easySms = new EasySms($config);
    }

    public function Execute()
    {
        $this->validate($this->request, [
            'tel' => 'required|regex:/^1[34578][0-9]{9}$/',
        ], [
            'tel.required' => '请输入手机号',
        ]);

        $ran = random_int(100000, 999999);
        $tel = $this->request->tel;

        $data = $this->easySms->send($tel, [
            'template' => 'SMS_78895462',
            'data'     => [
                'code' => $ran,
            ],
        ]);

        if (!is_array($data)) {
            return $this->withCode(400)->withError('发送验证码失败!');
        }

        $exist = Sms::where('tel', $tel)->first();


        $captcha = $exist ? $exist : new Sms();
        $captcha->tel = $tel;
        $captcha->code = $ran;
        if ($captcha->save()) {
            return $this->withCode(200)->withData(true)->withMessage('发送成功');
        } else {
            return $this->withCode(201)->withError('发送成功');
        }
    }
}
