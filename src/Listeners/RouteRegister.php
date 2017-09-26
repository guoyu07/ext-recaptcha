<?php
/**
 * The file is part of Notadd
 *
 * @author: Hollydan<2642956839@qq.com>
 * @copyright (c) 2017, notadd.com
 * @datetime: 17-9-15 下午2:08
 */

namespace Notadd\Siteverify\Listeners;

use Notadd\Foundation\Routing\Abstracts\RouteRegister as AbstractRouteRegister;
use Notadd\Siteverify\Controllers\VerifyController;

/**
 * Class RouteRegister.
 */
class RouteRegister extends AbstractRouteRegister
{
    /**
     * Handle Route Register.
     */
    public function handle()
    {
            $this->router->group(['middleware' => ['cross', 'web'], 'prefix' => 'api/siteverify'], function () {

                $this->router->group(['prefix' => 'verify'],function() {
                    $this->router->post('set', VerifyController::class.'@set');
                });
            });
    }
}
