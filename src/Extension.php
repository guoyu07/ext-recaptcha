<?php
/**
 * This file is part of Notadd.
 *
 * @author TwilRoad <269044570@qq.com>
 * @copyright (c) 2017, iBenchu.org
 * @datetime 2017-02-23 19:36
 */
namespace Notadd\BCaptcha;

use Illuminate\Events\Dispatcher;
use Notadd\BCaptcha\Listeners\CsrfTokenRegister;
use Notadd\BCaptcha\Listeners\RouteRegister;
use Notadd\Foundation\Extension\Abstracts\Extension as AbstractExtension;
use Mews\Captcha\Captcha;
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
        $this->app->make(Dispatcher::class)->subscribe(CsrfTokenRegister::class);
        $this->app->make(Dispatcher::class)->subscribe(RouteRegister::class);
        $this->loadTranslationsFrom(realpath(__DIR__ . '/../resources/translations'), 'cloud');
        $this->loadMigrationsFrom(realpath(__DIR__ . '/../databases/migrations'));


        // Publish configuration files
        $this->publishes([
            __DIR__.'/../vendor/mews/captcha/config/captcha.php' => config_path('captcha.php')
        ], 'config');

        // Validator extensions
        $this->app['validator']->extend('captcha', function($attribute, $value, $parameters)
        {
            return captcha_check($value);
        });



    }

    /**
     * Description of extension
     *
     * @return string
     */
    public static function description()
    {
        return '验证码插件的配置和管理。';
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
     * Name of extension.
     *
     * @return string
     */
    public static function name()
    {
        return '验证码';
    }

    /**
     * Get script of extension.
     *
     * @return string
     * @throws \Illuminate\Contracts\Container\BindingResolutionException
     */
    public static function script()
    {
        return asset('assets/extensions/notadd/cloud/js/extension.min.js');
    }

    /**
     * Get stylesheet of extension.
     *
     * @return array
     * @throws \Illuminate\Contracts\Container\BindingResolutionException
     */
    public static function stylesheet()
    {
        return [
            asset('assets/extensions/notadd/cloud/css/extension.min.css'),
        ];
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

    /**
     * Version of extension.
     *
     * @return string
     */
    public static function version()
    {
        return '0.1.0';
    }

    public function register()
    {
        // Merge configs
        $this->mergeConfigFrom(
            __DIR__.'/../vendor/mews/captcha/config/captcha.php', 'captcha'
        );
        $this->app->singleton('captcha', function($app)
        {
            return new Captcha(
                $app['Illuminate\Filesystem\Filesystem'],
                $app['Illuminate\Config\Repository'],
                $app['Intervention\Image\ImageManager'],
                $app['Illuminate\Session\Store'],
                $app['Illuminate\Hashing\BcryptHasher'],
                $app['Illuminate\Support\Str']
            );
        });
    }
}
