<?php
/**
 * The file is part of Notadd
 *
 * @author: Hollydan<2642956839@qq.com>
 * @copyright (c) 2017, notadd.com
 * @datetime: 17-9-15 下午2:08
 */

namespace Notadd\Siteverify\Handlers;

use Notadd\Foundation\Routing\Abstracts\Handler;

/**
 * Class AllCategoryHandler.
 */
class VerifyHandler extends Handler
{
    /**
     * Execute Handler.
     *
     * @throws \Exception
     */
    protected function execute()
    {
        $this->validate($this->request, [
            'g-recaptcha-response' => 'required|reCaptcha'
        ], [
            'g-recaptcha-response.required' => '请输入验证码',
        ]);
        return $this->withCode(200)->withMessage('验证成功！');
    }
}
