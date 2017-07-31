<?php
/**
 * Created by PhpStorm.
 * User: bc021
 * Date: 17-6-17
 * Time: 下午2:02
 */
namespace Notadd\BCaptcha\Controllers;

use Notadd\BCaptcha\Handlers\GetImgHandler;
use Notadd\BCaptcha\Handlers\SendHandler;
use Notadd\Foundation\Routing\Abstracts\Controller;

use Illuminate\Support\Facades\Request;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Input;



/**
 * Class ManagerController.
 */
class HomeController extends Controller
{

    public function send(SendHandler $handler)
    {
        return $handler->toResponse()->generateHttpResponse();
    }

    public function getImg(GetImgHandler $handler)
    {
        return $handler->toResponse()->generateHttpResponse();
    }


}