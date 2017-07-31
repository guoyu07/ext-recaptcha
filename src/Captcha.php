<?php
/**
 * This file is part of Notadd.
 *
 * @author        linxing <linxing@ibenchu.com>
 * @copyright (c) 2017, notadd.com
 * @datetime      17-6-23 下午12:14
 */
namespace Notadd\Captcha;

use Illuminate\Http\Request;
use Notadd\Foundation\Setting\Contracts\SettingsRepository;

/**
 * Class FileManager.
 */
class Captcha
{
    /**
     * FileManager constructor.
     *
     * @param \Illuminate\Http\Request                                $request
     * @param \Notadd\Foundation\Setting\Contracts\SettingsRepository $settings
     */
    public function __construct(Request $request, SettingsRepository $settings)
    {
        $this->req = $request;
        $this->settings = $settings;
    }


}
