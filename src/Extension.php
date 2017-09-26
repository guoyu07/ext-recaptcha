<?php
/**
 * The file is part of Notadd
 *
 * @author: Hollydan<2642956839@qq.com>
 * @copyright (c) 2017, notadd.com
 * @datetime: 17-9-15 下午1:54
 */
namespace Notadd\Siteverify;

use Notadd\Foundation\Extension\Abstracts\Extension as AbstractExtension;

/**
 * Class Extension.
 */
class Extension extends AbstractExtension
{
    /**
     * Boot provider.
     */
    public function boot()
    {
        $this->loadTranslationsFrom(realpath(__DIR__ . '/../resources/translations'), 'siteverify');
        $this->loadViewsFrom(realpath(__DIR__ . '/../resources/views'), 'siteverify');

        \Validator::extend('reCaptcha', function ($attribute, $value, $parameters, $validator) {

            $url = "https://www.google.com/recaptcha/api/siteverify";
            $data = [
                'secret' => '6Le6xDAUAAAAAP_nFiuaHX-inDY3uaGqKWdUa_Gx',
                'response' => $value,
            ];
            $content = $this->curlPost($url,$data);
            $content = json_decode($content);
            return $content->success;
        });
        \Validator::replacer('reCaptcha', function ($message, $attribute, $rule, $parameters) {
            return ' 验证码错误';
        });
    }

    /**
     * @param $url
     * @param $post_data
     * @return mixed
     */
    public function curlPost($url,$post_data)
    {
        $ch = curl_init();
        curl_setopt($ch, CURLOPT_URL, $url);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
        curl_setopt($ch, CURLOPT_POST, 1);
        curl_setopt($ch, CURLOPT_POSTFIELDS, $post_data);
        return $output = curl_exec($ch);
    }

    /**
     * Installer for extension.
     *
     * @return \Closure
     */
    public static function install()
    {
        return function () {
            return true;
        };
    }

    /**
     * Uninstall for extension.
     *
     * @return \Closure
     */
    public static function uninstall()
    {
        return function () {
            return true;
        };
    }
}