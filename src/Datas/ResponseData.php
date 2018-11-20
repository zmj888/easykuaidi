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

class ResponseData
{
    /**
     * bool 状态，成功为true，失败为false.
     */
    public $status;

    /**
     * 信息.
     */
    public $message;

    /**
     * 快递接口返回的原始数据.
     */
    public $rawData;
	
    /**
     * 返回的错误码.
     */
    public $code;
}
