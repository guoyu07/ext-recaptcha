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
            $this->router->post('getimg', HomeController::class . '@getImg')->name('getimg');
            $this->router->post('catpcha', HomeController::class . '@captcha')->name('captcha');
            $this->router->post('getcha', HomeController::class . '@getCha')->name('getcha');
            $this->router->any('wrong',HomeController::class . '@wrong')->name('fasle');
            $this->router->any('send',HomeController::class . '@send')->name('send');
            $this->router->any('abc',HomeController::class . '@abc')->name('abc')->middleware('captcha');
        });
        $this->router->get('captcha/{config?}', CaptchaController::class . '@getCaptcha')->middleware('web');
    }

}
