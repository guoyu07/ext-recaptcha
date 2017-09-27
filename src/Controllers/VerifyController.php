<?php
/**
 * The file is part of Notadd
 *
 * @author: Hollydan<2642956839@qq.com>
 * @copyright (c) 2017, notadd.com
 * @datetime: 17-9-15 下午2:08
 */

namespace Notadd\Siteverify\Controllers;

use Notadd\Foundation\Routing\Abstracts\Controller;
use Notadd\Siteverify\Handlers\ShowHandler;
use Notadd\Siteverify\Handlers\VerifyHandler;

/**
 * Class CategoryController.
 */
class VerifyController extends Controller
{

    /**
     * @param VerifyHandler $handler
     * @return \Notadd\Foundation\Passport\Responses\ApiResponse|\Psr\Http\Message\ResponseInterface|\Zend\Diactoros\Response
     * @internal param \Notadd\Slide\Handlers\AllCategoryHandler $allCategoryHandler
     */
    public function set(VerifyHandler $handler)
    {
        return $handler->toResponse()->generateHttpResponse();
    }
}
