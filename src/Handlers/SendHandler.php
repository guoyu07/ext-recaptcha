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
use Notadd\BCaptcha\Helper;

class SendHandler extends Handler
{
    protected $easySms;
    protected $settings;

    public function __construct(Container $container,SettingsRepository $settings,Helper $helper)
    {
        parent::__construct($container);
        $this->settings=$settings;
        $this->easySms = new EasySms($helper->getSmsConfig());
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
            'template' => $this->settings->get('aliyun.template'),
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
