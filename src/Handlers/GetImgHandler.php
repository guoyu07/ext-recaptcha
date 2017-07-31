<?php
/**
 * This file is part of Notadd.
 *
 * @copyright (c) 2017, notadd.com
 * @datetime      17-6-23 下午3:31
 */
namespace Notadd\BCaptcha\Handlers;

use Notadd\Foundation\Routing\Abstracts\Handler;
use Illuminate\Support\Facades\Request;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Input;



class GetImgHandler extends Handler
{


    public function Execute()
    {
        $data=captcha_src();
        return $this->withCode(200)->withData($data)->withError('返回成功');
    }
}
