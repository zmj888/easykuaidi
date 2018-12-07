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
 * 打印机等设备信息.
 */
class DeviceInfo
{
    /**
     * 打印机名称 id之类的，中通的打印必须传
     */
    public $deviceId;

    /**
     * 打印机二维码id，中通的打印必须传
     */
    public $qrcodeId;
}
