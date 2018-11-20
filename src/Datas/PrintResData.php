<?php

/*
 * This file is part of the cjl/easykuaidi.
 *
 * (c) cjl<running727@163.com>
 *
 * This source file is subject to the MIT license that is bundled
 * with this source code in the file LICENSE.
 */

namespace Cjl\Easykuaidi\Datas;

class PrintResData extends ResponseData
{
    /**
     * 	打印用的二维码
     * string $qrcode.
     */
    public $qrcode;

    /**
     * 运单号
     * string $billCode.
     */
    public $billCode;

    /**
     * 订单号
     * string $orderId.
     */
    public $orderId;

    /**
     * 电子面单模版的html代码
     * string $template_html.
     */
    public $template_html;

    /**
     * 电子面单模版的链接地址
     * string $template_url.
     */
    public $template_url;
}
