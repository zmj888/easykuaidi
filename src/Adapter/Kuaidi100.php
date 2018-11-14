<?php

namespace Cjl\Easykuaidi\Adapter;

use Cjl\Easykuaidi\Exceptions\NotSupportedException;
use Cjl\Easykuaidi\OrderInfo;

class Kuaidi100 extends AbstractEasykuaidiAdapter
{
    /**
     * 快递100分配给贵司的的授权key，见授权key邮件说明
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

    public function getHourPrice($dispCity,$dispProv,$sendCity,$sendProv)
    {
        throw new NotSupportedException('kuaidi100不支持此接口');
    }

    /**
     * 将订单信息通过本接口提交给快递100，快递100将之提交给快递公司并返回快递公司生成的电子面单号码和打印模版，
     * 再获得该电子面单号码和打印模版后，即可将之通过打印机打印出来，打印完成后即可贴到包裹上，快递员可以直接揽件。
     */
    public function getElecOrder(OrderInfo $orderInfo)
    {
        $url = "http://api.kuaidi100.com/eorderapi.do?method=getElecOrder";
        
        $sign = null;
        $recMan = array("name"=>"张三","mobile"=>"13751866787","tel"=>"","zipCode"=>"","province"=>"广东省","city"=>"深圳市","district"=>"南山区","addr"=>"科技南十二路2号金蝶软件园B10","company"=>"");
        $sendMan = array("name"=>"李四","mobile"=>"13751866787","tel"=>"","zipCode"=>"","province"=>"广东省","city"=>"深圳市","district"=>"南山区","addr"=>"高新南一道2号","company"=>"");
        
        $param = array("recMan"=>$recMan,"sendMan"=>$sendMan,"kuaidicom"=>"shunfeng",
        "partnerId"=>"XXXXXXXXX","partnerKey"=>"","net"=>"","kuaidinum"=>"","orderId"=>"A2147",
        "payType"=>"SHIPPER","expType"=>"标准快递","weight"=>"1","volumn"=>"0","count"=>1,"remark"=>"备注",
        "valinsPay"=>"0","collection"=>"0","needChild"=>"0","needBack"=>"0","cargo"=>"书","needTemplate"=>"1");

        $query = array(
            'key' => $this->key,
            'sign' => $sign,
            't' => time(),
            'param' =>  $param
        );

        $response = $this->getHttpClient()->post($url,['query' => $query])->getBody()->getContents();

        return \json_decode($response, true);
    }

    public function subBillLog(array $danhaos,string $ssl='')
    {
        throw new Exception('此接口尚未实现');
    }
}