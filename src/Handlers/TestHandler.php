<?php
/**
 * This file is part of Notadd.
 *
 * @copyright (c) 2017, notadd.com
 * @datetime      17-6-23 下午3:31
 */
namespace Notadd\Captcha\Handlers;

use Notadd\Foundation\Routing\Abstracts\Handler;
use Illuminate\Container\Container;
use Notadd\Captcha\Captcha;


class TestHandler extends Handler
{
    /**
     * @var \Notadd\Cloud\Cloud
     */
    protected $captcha;

    /**
     * TestHandler constructor.
     *
     * @param \Illuminate\Container\Container $container
     * @param \Notadd\Captcha\Captcha         $captcha
     */
    public function __construct(Container $container, Captcha $captcha)
    {
        parent::__construct($container);
        $this->captcha = $captcha;
    }

    public function Execute()
    {
       dd(11111);
    }
}
