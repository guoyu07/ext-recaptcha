<?php
/**
 * This file is part of Notadd.
 *
 * @author AllenGu <674397601@qq.com>
 * @copyright (c) 2017, iBenchu.org
 * @datetime 2017-05-22 16:27
 */
namespace Notadd\BCaptcha\Listeners;

use Notadd\Foundation\Event\Abstracts\EventSubscriber;
use Notadd\Foundation\Http\Events\CsrfTokenRegister as CsrfTokenRegisterEvent;

/**
 * Class CsrfTokenRegister.
 */
class CsrfTokenRegister extends EventSubscriber
{
    /**
     * @return string
     */
    protected function getEvent()
    {
        return CsrfTokenRegisterEvent::class;
    }

    /**
     * @param \Notadd\Foundation\Http\Events\CsrfTokenRegister $event
     */
    public function handle(CsrfTokenRegisterEvent $event)
    {
        $event->registerExcept('api/captcha*');
        $event->registerExcept('api/sms*');
    }
}
