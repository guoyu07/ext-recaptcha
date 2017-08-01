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
        $data=$this->settings->all()->toArray();
        return array_only($data,[
            'upyun.bucketName',
            'upyun.operatorName',
            'upyun.operatorPassword',
            'upyun.domain',
        ]);
    }

    public function messages()
    {

        return [
            '修改设置成功!'
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
        $this->validate($this->request,[
            'bucketName'=>'required|alpha_dash',
            'operatorName'=>'required|alpha_dash',
            'operatorPassword'=>'required|alpha_dash',
            'domain'=>'required|active_url'
        ],[
            'operatorName.required'=>'operatorName不能为空',
            'operatorName.alpha_dash'=>'operatorName由字母数字下划线组成',
            'operatorPassword.required'=>'operatorPassword不能为空',
            'operatorPassword.ralpha_dash'=>'operatorPassword由数字字母下滑线组成',
            'bucketName.required'=>'bucketName不能为空',
            'bucketName.alpha_dash'=>'bucketName由数字字母下滑线组成',
            'domain.required'=>'域名不能为空',
            'domain.active_url'=>'域名必须为有效的域名'
        ]);
        $this->settings->set('upyun.bucketName', $this->request->input('bucketName'));
        $this->settings->set('upyun.operatorName', $this->request->input('operatorName'));
        $this->settings->set('upyun.operatorPassword', $this->request->input('operatorPassword'));
        $this->settings->set('upyun.domain', $this->request->input('domain'));
        return true;
    }


}

