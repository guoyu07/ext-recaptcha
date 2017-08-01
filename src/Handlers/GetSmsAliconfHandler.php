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
            'bucketName' => $this->settings->get('upyun.bucketName'),
            'operatorName' => $this->settings->get('upyun.operatorName'),
            'operatorPassword' => $this->settings->get('upyun.operatorPassword'),
            'domain' =>$this->settings->get('upyun.domain'),
        ];
    }

    public function execute()
    {
        $this->data();
    }
}
