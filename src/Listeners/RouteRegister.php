<?php
/**
 * This file is part of Notadd.
 *
 * @author        linxing <linxing@ibenchu.com>
 * @copyright (c) 2017, notadd.com
 * @datetime      17-6-23 上午10:25
 */
namespace Notadd\BCaptcha\Listeners;

use Notadd\BCaptcha\Controllers\HomeController;
use Mews\Captcha\CaptchaController;
use Notadd\Foundation\Routing\Abstracts\RouteRegister as AbstractRouteRegister;


/**
 * Class RouteRegister.
 */
class RouteRegister extends AbstractRouteRegister
{
    /**
     * Handle Route Registrar.
     */
    public function handle()
    {
        $this->router->group(['middleware' => ['cross', 'web'], 'prefix' => 'api/captcha'], function () {
            $this->router->post('getCha', HomeController::class . '@getCha')->name('getCha');
            $this->router->post('postCha', HomeController::class . '@PostCha')->name('postCha');
            $this->router->any('wrong',HomeController::class . '@wrong')->name('captcha');
            $this->router->any('test',HomeController::class . '@test')->name('test');
        });
        $this->router->get('captcha/{config?}', CaptchaController::class . '@getCaptcha')->middleware('web');
    }

}
