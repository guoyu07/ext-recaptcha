<?php
/**
 * This file is part of Notadd.
 *
 * @author        aen233<zhanghe@ibenchu.com>
 * @copyright (c) 2017, notadd.com
 * @datetime      2017-07-31 20:42
 */
namespace Notadd\BCaptcha\Middlewares;

use Closure;
use Notadd\Foundation\Http\Middlewares\VerifyCsrfToken;
use Illuminate\Support\Facades\Request;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Input;

class SmsMiddleware  extends  VerifyCsrfToken
{

    public function handle($request, Closure $next)
    {
            $rules = [
                'code' => 'required|code',
                'tel'=>'required|regex:/^1[34578][0-9]{9}$/'
            ];
            $validator = Validator::make(Input::all(), $rules);
            if ($validator->fails()) {
                if ($request->expectsJson()) {
                    return response()->json('验证码验证不通过', 402);
                }
                return response()->json('验证码验证不通过', 402);
            } else {
                return $next($request);
            }

    }
}