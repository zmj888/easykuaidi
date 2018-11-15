<?php

/*
 * This file is part of the cjl/easykuaidi.
 *
 * (c) cjl<running727@163.com>
 *
 * This source file is subject to the MIT license that is bundled
 * with this source code in the file LICENSE.
 */

namespace Cjl\Easykuaidi;

use Cjl\Easykuaidi\Adapter\ZTOAdapter;
use Cjl\Easykuaidi\Adapter\Kuaidi100;
use Cjl\Easykuaidi\Datas\OrderInfo;
use Cjl\Easykuaidi\Datas\ResponseData;

class Easykuaidi implements EasykuaidiAdapterInterface
{
    /**
     * @var AbstractEasykuaidiAdapter
     */
    protected $adapter;

    protected $config;

    /**
     * Constructor.
     *
     * @param AbstractEasykuaidiAdapter $adapter
     * @param Config|array              $config
     */
    public function __construct($config)
    {
        $this->config = $config;
        if ('zto' == $config['default']) {
            $this->adapter = new ZTOAdapter($config['zto']['company_id'],$config['zto']['key'],
            $config['testmode'], $config['zto']['partner_id'], $config['zto']['create_by'], url('/easykuaidi/ztosubscribe'));
        } elseif ('kuaidi100' == $config['default']) {
            $this->adapter = new Kuaidi100($config['kuaidi100']['key']);
        }
    }

    /**
     * Get the Adapter.
     *
     * @return AbstractEasykuaidiAdapter adapter
     */
    public function getAdapter()
    {
        return $this->adapter;
    }

    /**
     * 获取时效价格
     *
     * @param string $dispCity 收件城市名称，如 无锡市
     * @param string $dispProv 收件省份名称，如 江苏
     * @param string $sendCity 寄件城市名称，如 杭州市
     * @param string $sendProv 寄件省份名称，如 浙江
     *
     * @return string json格式的
     */
    public function getHourPrice(string $dispCity, string $dispProv, string $sendCity, string $sendProv):ResponseData
    {
        return $this->adapter->getHourPrice($dispCity, $dispProv, $sendCity, $sendProv);
    }

    /**
     * 获取电子面单.
     *
     * @param OrderInfo $orderInfo 订单信息
     *
     * @return string json格式的
     */
    public function getElecOrder(OrderInfo $orderInfo):ResponseData
    {
        return $this->adapter->getElecOrder($orderInfo);
    }

    /**
     * 订阅订单轨迹.
     *
     * @param array  $danhaos 商家要追踪的的订单号数组
     * @param string $ssl     如果回调地址为HTTPS ，入参 ssl=1 且必填
     *
     * @return string json格式的
     */
    public function subBillLog(array $danhaos, string $ssl = ''):ResponseData
    {
        return $this->adapter->subBillLog($danhaos, $ssl);
    }
	
    /**
     * 获取快件轨迹信息.
     *
     * @param array  $danhaos 商家要查询的的订单号数组
     *
     * @return string json格式的
     */
    public function traceInterfaceNewTraces(array $danhaos):ResponseData
    {
        return $this->adapter->traceInterfaceNewTraces($danhaos);
    }
}
