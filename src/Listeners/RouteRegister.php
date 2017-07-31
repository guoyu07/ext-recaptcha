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
use Illuminate\Support\Facades\Request;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Input;


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
        $this->router->group(['middleware' => ['cross', 'web'], 'prefix' => 'captcha'], function () {
//            $this->router->post('test', HomeController::class . '@test')->name('test');
            $this->router->any('test', function()
            {
                if (Request::getMethod() == 'POST')
                {
                    $rules = ['captcha' => 'required|captcha'];
                    $validator = Validator::make(Input::all(), $rules);
                    if ($validator->fails())
                    {
                        echo '<p style="color: #ff0000;">Incorrect!</p>';
                    }
                    else
                    {
                        echo '<p style="color: #00ff30;">Matched :)</p>';
                    }
                } elseif(Request::getMethod() == 'GET'){
                    $form = '<form method="post" action="http://upload.zhanghe.ibenchu.pw/captcha/test">';
                    $form .= '<input type="hidden" name="_token" value="' . csrf_token() . '">';
                    $form .= '<p>' . captcha_img() . '</p>';
                    $form .= '<p><input type="text" name="captcha"></p>';
                    $form .= '<p><button type="submit" name="check">Check</button></p>';
                    $form .= '</form>';
                    return $form;
                }
                
            });
        });

        $this->router->get('captcha/{config?}', CaptchaController::class.'@getCaptcha')->middleware('web');
    }
}
