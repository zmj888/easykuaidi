<?php

/*
 * This file is part of the cjl/easykuaidi.
 *
 * (c) cjl<running727@163.com>
 *
 * This source file is subject to the MIT license that is bundled
 * with this source code in the file LICENSE.
 */

namespace Cjl\Easykuaidi\Adapter;

use Cjl\Easykuaidi\Datas\ResponseData;
use Cjl\Easykuaidi\Exceptions\Exception;
use Cjl\Easykuaidi\Datas\OrderInfo;

/**
 * 顺丰.
 */
class SFAdapter extends AbstractEasykuaidiAdapter
{
    protected $key;

    protected $secret;

    public function __construct(string $key, string $secret)
    {
        $this->key = $key;
        $this->secret = $secret;
    }

    public function getHourPrice(string $dispCity, string $dispProv, string $sendCity, string $sendProv, string $dispCountry = '', string $sendCountry = ''): ResponseData
    {
        throw new Exception('此接口尚未实现');
    }

    /**
     * 再获得该电子面单号码和打印模版后，即可将之通过打印机打印出来，打印完成后即可贴到包裹上，快递员可以直接揽件。
     */
    public function getElecOrder(OrderInfo $orderInfo): ResponseData
    {
        throw new Exception('此接口尚未实现');
    }

    public function subBillLog(array $danhaos, string $ssl = ''): ResponseData
    {
        throw new Exception('此接口尚未实现');
    }

    /**
     * 获取快件轨迹信息.
     *
     * @param array $danhaos 商家要查询的的订单号数组
     *
     * @return string json格式的
     */
    public function traceInterfaceNewTraces(array $danhaos): ResponseData
    {
        throw new Exception('此接口尚未实现');
    }
}
