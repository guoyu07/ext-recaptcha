<?php
/**
 * Created by PhpStorm.
 * User: bc021
 * Date: 17-6-17
 * Time: 下午2:02
 */
namespace Notadd\BCaptcha\Controllers;

use Notadd\BCaptcha\Handlers\GetImgHandler;
use Notadd\Foundation\Routing\Abstracts\Controller;

use Illuminate\Support\Facades\Request;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Input;



/**
 * Class ManagerController.
 */
class HomeController extends Controller
{
    public function wrong()
    {
        return json_encode(['code' => 402, 'msg' => '验证码输入错误']);
    }

    public function getCha()
    {
        $form = '<form method="post" '.' action="'.route('captcha').'">';
        $form .= '<input type="hidden" name="_token" value="' . csrf_token() . '">';
        $form .= '<p>' . captcha_img() . '</p>';
        $form .= '<p><input type="text" name="captcha"></p>';
        $form .= '<p><button type="submit" name="check">Check</button></p>';
        $form .= '</form>';
        return $form;
    }

    public function captcha()
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
    }

    public function getImg(GetImgHandler $handler)
    {
        return $handler->toResponse()->generateHttpResponse();
    }


}