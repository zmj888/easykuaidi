<?php

namespace Cjl\Easykuaidi;

interface EasykuaidiAdapterinterface
{
    /**
     * 获取时效价格
     * @param string $dispCity 收件城市名称，如 无锡市
     * @param string $dispProv 收件省份名称，如 江苏
     * @param string $sendCity 寄件城市名称，如 杭州市
     * @param string $sendProv 寄件省份名称，如 浙江
     *
     * @return string json格式的
     */
    public function getHourPrice(string $dispCity,string $dispProv,string $sendCity,string $sendProv);

    /**
     * 获取电子面单
     * 
     * @param OrderInfo $orderInfo 订单信息
     * 
     * @return string json格式的
     */
    public function getElecOrder(OrderInfo $orderInfo);

    /**
     * 订阅订单轨迹
     * @param array $danhaos 商家要追踪的的订单号数组
     * @param string $ssl 如果回调地址为HTTPS ，入参 ssl=1 且必填
     * @return string json格式的
     */
    public function subBillLog(array $danhaos,string $ssl='');
}