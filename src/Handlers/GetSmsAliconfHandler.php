<?php
namespace Notadd\BCaptcha\Handlers;

use Illuminate\Container\Container;
use Notadd\Foundation\Passport\Abstracts\DataHandler;
use Notadd\Foundation\Setting\Contracts\SettingsRepository;

/**
 * Class GetUpyunconfHandler.
 */
class GetSmsAliconfHandler extends DataHandler
{
    /**
     * @var \Notadd\Foundation\Setting\Contracts\SettingsRepository
     */
    protected $settings;

    /**
     * GetUpyunconfHandler constructor.
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
     * @return array
     */
    public function data()
    {
        return [
            'access_key_id' => $this->settings->get('aliyun.ak_id'),
            'access_key_secret' => $this->settings->get('aliyun.ak_secret'),
            'sign_name' => $this->settings->get('aliyun.sign_name'),
            'template' =>$this->settings->get('aliyun.template'),
        ];
    }

    public function execute()
    {
        $this->data();
    }
}
