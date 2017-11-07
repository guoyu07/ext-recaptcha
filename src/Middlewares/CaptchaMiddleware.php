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

class CaptchaMiddleware  extends  VerifyCsrfToken
{
    /**
     * @param \Illuminate\Http\Request $request
     * @param \Closure                 $next
     *
     * @return \Illuminate\Http\JsonResponse|mixed
     */
    public function handle($request, Closure $next)
    {
            $rules = ['captcha' => 'required|captcha'];
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