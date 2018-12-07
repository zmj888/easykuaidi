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

/**
 * 	大头笔集包地信息.
 */
class PrintMarkerResData extends ResponseData
{
    /**
     * 	大头笔
     * string $mark.
     */
    public $mark;

    /**
     * 集包地
     * string $bagAddr.
     */
    public $bagAddr;
}
