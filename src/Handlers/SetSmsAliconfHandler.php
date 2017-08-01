<?php

namespace Notadd\BCaptcha\Handlers;

use Illuminate\Container\Container;
use Notadd\Foundation\Setting\Contracts\SettingsRepository;
use Notadd\Foundation\Passport\Abstracts\SetHandler as AbstractSetHandler;

/**
 * Class SetUpyunconfHandler.
 */
class SetSmsAliconfHandler extends AbstractSetHandler
{
    /**
     * @var \Notadd\Foundation\Setting\Contracts\SettingsRepository
     */
    protected $settings;

    /**
     * SetHandler constructor.
     *
     * @param \Illuminate\Container\Container                         $container
     * @param \Notadd\Foundation\Setting\Contracts\SettingsRepository $settings
     */
    public function __construct(Container $container, SettingsRepository $settings)
    {
        parent::__construct($container);
        $this->settings = $settings;
    }

    /**
     * Data for handler.
     *
     * @return array
     */
    public function data()
    {
        $data = $this->settings->all()->toArray();

        return array_only($data, [
            'aliyun.ak_id',
            'aliyun.ak_secret',
            'aliyun.sign_name',
            'aliyun.template',
        ]);
    }

    public function messages()
    {

        return [
            '修改设置成功!',
        ];
    }

    /**
     * Errors for handler.
     *
     * @return array
     */
    public function errors()
    {
        return [
            '修改设置失败！',
        ];
    }

    /**
     * Execute Handler.
     *
     * @return bool
     */
    public function execute()
    {
        $this->validate($this->request, [
            'access_key_id'     => 'required|alpha_dash',
            'access_key_secret' => 'required|alpha_dash',
            'sign_name'         => 'required',
            'template'          => 'required',
        ], [
            'access_key_id.required'        => 'access_key_id不能为空',
            'access_key_id.alpha_dash'      => 'access_key_id由字母数字下划线组成',
            'access_key_secret.required'    => 'access_key_secret不能为空',
            'access_key_secret.ralpha_dash' => 'access_key_secret由数字字母下滑线组成',
            'sign_name.required'            => 'bucketName不能为空',
            'template.required'             => '域名不能为空',
        ]);
        $this->settings->set('aliyun.ak_id', $this->request->input('access_key_id'));
        $this->settings->set('aliyun.ak_secret', $this->request->input('access_key_secret'));
        $this->settings->set('aliyun.sign_name', $this->request->input('sign_name'));
        $this->settings->set('aliyun.template', $this->request->input('template'));

        return true;
    }

}

