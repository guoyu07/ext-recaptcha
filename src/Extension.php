<?php
/**
 * This file is part of Notadd.
 *
 * @author TwilRoad <269044570@qq.com>
 * @copyright (c) 2017, iBenchu.org
 * @datetime 2017-02-23 19:36
 */
namespace Notadd\BCaptcha;

use Mews\Captcha\Captcha;
use Notadd\BCaptcha\Middlewares\CaptchaMiddleware;
use Notadd\BCaptcha\Middlewares\SmsMiddleware;
use Notadd\BCaptcha\Models\Sms;
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
        $this->app->make('router')->aliasMiddleware('captcha', CaptchaMiddleware::class);
        $this->loadTranslationsFrom(realpath(__DIR__ . '/../resources/translations'), 'cloud');
//        $this->loadMigrationsFrom(realpath(__DIR__ . '/../databases/migrations'));

        // Publish configuration files
        $this->publishes([
            __DIR__ . '/../vendor/mews/captcha/config/captcha.php' => config_path('captcha.php'),
        ], 'config');

        // Validator extensions
        $this->app['validator']->extend('captcha', function ($attribute, $value, $parameters) {
            return captcha_check($value);
        });
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

    public function register()
    {
        // Merge configs
        $this->mergeConfigFrom(
            __DIR__ . '/../vendor/mews/captcha/config/captcha.php', 'captcha'
        );
        $this->app->singleton('captcha', function ($app) {
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
