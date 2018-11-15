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

class TraceData extends ResponseData
{
    /**
     * 运单号
     * array GuijiData.
     */
    public $billCode;

    /**
     * 轨迹数据
     * array GuijiData.
     */
    public $traceDatas;
}
