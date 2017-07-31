<?php
/**
 * This file is part of Notadd.
 *
 * @author        linxing <linxing@ibenchu.com>
 * @copyright (c) 2017, notadd.com
 * @datetime      17-6-23 下午12:14
 */
namespace Notadd\Captcha;

/**
 * Class helper.
 */
class Helper
{
    public static function getSizeCount($size)
    {

        $units = array(' B', ' KB', ' MB', ' GB', ' TB');
        for ($i = 0; $size >= 1024 && $i < 4; $i++) $size/= 1024;
        return  round($size, 2).$units[$i];
    }

}