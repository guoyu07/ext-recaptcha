<?php
/**
 * Created by PhpStorm.
 * User: bc021
 * Date: 17-6-17
 * Time: 下午2:02
 */
namespace Notadd\BCaptcha\Controllers;

use Notadd\Foundation\Routing\Abstracts\Controller;

use Notadd\BCaptcha\Handlers\TestHandler;



/**
 * Class ManagerController.
 */
class HomeController extends Controller
{

    public function test(TestHandler $handler)
    {
        return $handler->toResponse()->generateHttpResponse();
    }


}