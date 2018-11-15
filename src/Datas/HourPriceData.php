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

class HourPriceData extends ResponseData
{
    /**
     * 续重费用.
     */
    public $addMoney;

    /**
     * 首重费用.
     */
    public $firstMoney;

    /**
     * 时效.
     */
    public $hour;
}
