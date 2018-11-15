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

class ElecOrderData extends ResponseData
{
    /**
     * 运单号.
     */
    public $billCode;

    /**
     * 订单号.
     */
    public $orderId;

    /**
     * 是否更新.
     */
    public $update;

    /**
     * 	网点编号.
     */
    public $siteCode;

    /**
     * 网点名称.
     */
    public $siteName;
}
