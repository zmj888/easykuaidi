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

use Cjl\Easykuaidi\Datas\DeviceInfo;
use Cjl\Easykuaidi\Datas\ResponseData;
use Cjl\Easykuaidi\Exceptions\Exception;
use Cjl\Easykuaidi\Exceptions\NotSupportedException;
use Cjl\Easykuaidi\Datas\OrderInfo;

class Kuaidi100 extends AbstractEasykuaidiAdapter
{
    /**
     * 快递100分配给贵司的的授权key，见授权key邮件说明.
     */
    protected $key;

    /**
     * 电子面单客户账户或月结账号，需向快递公司在贵司当地的网点申请；
     * 若已和快递100超市业务合作，则可不填。顺丰、EMS的可输入月结账号；
     * 若所选快递公司为宅急送（即kuaidicom字段为zhaijisong），则此项可不填。
     */
    protected $partnerId;

    /**
     * 电子面单密码，需向快递公司在贵司当地的网点申请；
     * 若已和快递100超市业务合作，则可不填。顺丰、EMS的如果partnerId填月结账号，则此字段不填；
     * 若所选快递公司为宅急送（即kuaidicom字段为zhaijisong），则此项可不填。
     */
    protected $partnerKey;

    /**
     * 收件网点名称,由快递公司当地网点分配，
     * 若已和快递100超市业务合作，则可不填。顺丰、EMS的如果partnerId填月结账号，则此字段不填；
     * 若所选快递公司为宅急送（即kuaidicom字段为zhaijisong），则此项可不填。
     */
    protected $net;

    public function __construct(string $key)
    {
        $this->key = $key;
    }

    public function getHourPrice(string $dispCity, string $dispProv, string $sendCity, string $sendProv, string $dispCountry = '', string $sendCountry = ''): ResponseData
    {
        throw new NotSupportedException('kuaidi100不支持此接口');
    }

    /**
     * 将订单信息通过本接口提交给快递100，快递100将之提交给快递公司并返回快递公司生成的电子面单号码和打印模版，
     * 再获得该电子面单号码和打印模版后，即可将之通过打印机打印出来，打印完成后即可贴到包裹上，快递员可以直接揽件。
     */
    public function getElecOrder(OrderInfo $orderInfo): ResponseData
    {
        throw new Exception('此接口尚未实现');
//        $url = 'http://api.kuaidi100.com/eorderapi.do?method=getElecOrder';
//
//        $sign = null;
//        $recMan = array('name' => '张三', 'mobile' => '13751866787', 'tel' => '', 'zipCode' => '', 'province' => '广东省', 'city' => '深圳市', 'district' => '南山区', 'addr' => '科技南十二路2号金蝶软件园B10', 'company' => '');
//        $sendMan = array('name' => '李四', 'mobile' => '13751866787', 'tel' => '', 'zipCode' => '', 'province' => '广东省', 'city' => '深圳市', 'district' => '南山区', 'addr' => '高新南一道2号', 'company' => '');
//
//        $param = array('recMan' => $recMan, 'sendMan' => $sendMan, 'kuaidicom' => 'shunfeng',
//        'partnerId' => 'XXXXXXXXX', 'partnerKey' => '', 'net' => '', 'kuaidinum' => '', 'orderId' => 'A2147',
//        'payType' => 'SHIPPER', 'expType' => '标准快递', 'weight' => '1', 'volumn' => '0', 'count' => 1, 'remark' => '备注',
//        'valinsPay' => '0', 'collection' => '0', 'needChild' => '0', 'needBack' => '0', 'cargo' => '书', 'needTemplate' => '1', );
//
//        $query = array(
//            'key' => $this->key,
//            'sign' => $sign,
//            't' => time(),
//            'param' => $param,
//        );
//
//        $response = $this->getHttpClient()->post($url, ['query' => $query])->getBody()->getContents();
//
//        return \json_decode($response, true);
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

    public function doPrint(OrderInfo $orderInfo,DeviceInfo $deviceInfo): ResponseData
    {
        throw new Exception('此接口尚未实现');
    }

    public function bagAddrMarkGetmark(OrderInfo $orderInfo): ResponseData
    {
        throw new Exception('此接口尚未实现');
    }
}
