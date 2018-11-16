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

use Cjl\Easykuaidi\Datas\ElecOrderData;
use Cjl\Easykuaidi\Datas\GuijiData;
use Cjl\Easykuaidi\Datas\HourPriceData;
use Cjl\Easykuaidi\Datas\OrderInfo;
use Cjl\Easykuaidi\Datas\ResponseData;
use Cjl\Easykuaidi\Datas\TraceData;
use Cjl\Easykuaidi\Exceptions\HttpException;
use Cjl\Easykuaidi\Exceptions\InvalidArgumentException;


/**
 * 中通
 */
class ZTOAdapter extends AbstractEasykuaidiAdapter
{
    /**
     * 合作商编码 （在个人中心查看）.
     */
    protected $company_id;

    /**
     * 合作商签名key.
     */
    protected $key;

    /**
     * 商家ID，又称电子面单账号、电子面单账户、客户ID(正式环境由中通合作网点提供，测试环境使用test).
     */
    protected $partner;

    /**
     * 订阅人（ 测试环境统一为：test，生产环境在联调通过后分配。）.
     */
    protected $createBy;

    private $host_test = 'http://58.40.16.120:9001/';

    private $host = 'http://japi.zto.cn/';

    /**
     * @param string $company_id 合作商编码
     * @param string $key        合作商签名key
     */
    public function __construct(string $company_id, string $key, bool $testmode = false, string $partner = '', string $createBy = '', string $pushTarget = '')
    {
        $this->company_id = $company_id;
        $this->key = $key;
        $this->pushTarget = $pushTarget;
        $this->partner = $partner;
        $this->createBy = $createBy;
        $this->testmode = $testmode;
        if (!$testmode && (empty($company_id) || empty($key))) {
            throw new InvalidArgumentException('合作商编码或者签名key不能为空');
        }
    }

    /**
     * 获取时效价格
     *
     * @param string $dispCity 收件城市名称，如 无锡市
     * @param string $dispProv 收件省份名称，如 江苏
     * @param string $sendCity 寄件城市名称，如 杭州市
     * @param string $sendProv 寄件省份名称，如 浙江
     *
     * @return string json格式的 如
     *                {
     *                "data": {
     *                "addMoney": "10",
     *                "firstMoney": "16",
     *                "hour": "6.23"
     *                },
     *                "msg": "获取时效和价格成功",
     *                "status": true
     *                }
     */
    public function getHourPrice(string $dispCity, string $dispProv, string $sendCity, string $sendProv, string $dispCountry='', string $sendCountry=''):ResponseData
    {
        if (empty($dispCity) || empty($dispProv) || empty($sendCity) || empty($sendProv)) {
            throw new InvalidArgumentException('无效的参数');
        }
        $jiekouname = 'priceAndHourInterfaceGetHourPrice';

        if ($this->testmode) {
            $url = $this->host_test.$jiekouname;
            $comid = 'kfpttestCode';
            $comkey = 'kfpttestkey==';
        } else {
            $comid = $this->company_id;
            $comkey = $this->key;
            $url = $this->host.$jiekouname;
        }

        $data = array('dispCity' => $dispCity, 'dispProv' => $dispProv, 'sendCity' => $sendCity, 'sendProv' => $sendProv);
        $params = array('company_id' => $comid, 'msg_type' => 'GET_HOUR_PRICE', 'data' => $data);
        $fixedParams = array();
        foreach ($params as $k => $v) {
            if ('string' != gettype($v)) {
                $fixedParams += [$k => json_encode($v)];
            } else {
                $fixedParams += [$k => $v];
            }
        }
        $str_to_digest = '';
        foreach ($fixedParams as $k => $v) {
            $str_to_digest = $str_to_digest.$k.'='.$v.'&';
        }
        $str_to_digest = substr($str_to_digest, 0, -1).$comkey;
        $data_digest = base64_encode(md5($str_to_digest, true));

        try {
            $response = $this->getHttpClient()->post($url, [
                'form_params' => $fixedParams,
                'headers' => [
                    'ContentType' => 'application/x-www-form-urlencoded; charset=UTF-8',
                    'x-companyId' => $comid,
                    'x-dataDigest' => $data_digest,
                ],
            ])->getBody()->getContents();

            $res = \json_decode($response, true);
            if (isset($res['status']) && !$res['status']) {
                if (isset($res['message'])) {
                    throw new InvalidArgumentException($res['message']);
                } else {
                    throw new InvalidArgumentException($res['msg']);
                }
            }
            if (isset($res['result']) && !$res['result']) {
                if (isset($res['message'])) {
                    throw new InvalidArgumentException($res['message']);
                } else {
                    throw new InvalidArgumentException($res['msg']);
                }
            }

            $resData = new HourPriceData();
            $resData->status = true;
            $resData->message = $res['msg'];
            $resData->addMoney = $res['data']['addMoney'];
            $resData->firstMoney = $res['data']['firstMoney'];
            $resData->hour = $res['data']['hour'];
            return $resData;
        } catch (\Exception $e) {
            throw new HttpException($e->getMessage(), $e->getCode(), $e);
        }
    }

    /**
     * 获取电子面单.
     *
     * @param string    $partner   商家ID，又称电子面单账号、电子面单账户、客户ID(正式环境由中通合作网点提供，测试环境使用test)
     * @param OrderInfo $orderInfo 订单信息
     *
     * @return string json格式的
     */
    public function getElecOrder(OrderInfo $orderInfo):ResponseData
    {
        $jiekouname = 'partnerInsertSubmitagent';

        if ($this->testmode) {
            $url = $this->host_test.$jiekouname;
            $comid = 'ea8c719489de4ad0bf475477bad43dc6';
            $comkey = 'submitordertest==';
        } else {
            $comid = $this->company_id;
            $comkey = $this->key;
            $url = $this->host.$jiekouname;
        }
        $senderInfo = $orderInfo->sender;
        $receiverInfo = $orderInfo->receiver;

        $sender = array('name' => $senderInfo->name, 'company' => $senderInfo->company, 'mobile' => $senderInfo->mobile, 'phone' => $senderInfo->phone, 'city' => $senderInfo->province.$senderInfo->city.$senderInfo->country, 'address' => $senderInfo->address, 'zipcode' => $senderInfo->zipcode);
        $receiver = array('name' => $receiverInfo->name, 'company' => $receiverInfo->company, 'mobile' => $receiverInfo->mobile, 'phone' => $receiverInfo->phone, 'city' => $receiverInfo->province.$receiverInfo->city.$receiverInfo->country, 'address' => $receiverInfo->address, 'zipcode' => $receiverInfo->zipcode);
        $data = array('partner' => $this->partner, 'id' => $orderInfo->orderid, 'typeid' => '1', 'tradeid' => $orderInfo->tradeid, 'sender' => $sender, 'receiver' => $receiver,
        'weight' => $orderInfo->weight, 'size' => $orderInfo->size, 'quantity' => $orderInfo->quantity, 'price' => $orderInfo->price, 'freight' => $orderInfo->freight,
        'premium' => $orderInfo->premium, 'pack_charges' => $orderInfo->pack_charges,
        'other_charges' => $orderInfo->other_charges, 'order_sum' => $orderInfo->order_sum, 'collect_moneytype' => 'CNY', 'collect_sum' => $orderInfo->collect_sum,
        'remark' => $orderInfo->remark, 'order_type' => $orderInfo->order_type, );
        $params = array('company_id' => $comid, 'msg_type' => 'submitAgent', 'data' => $data);
        $fixedParams = array();
        foreach ($params as $k => $v) {
            if ('string' != gettype($v)) {
                $fixedParams += [$k => json_encode($v)];
            } else {
                $fixedParams += [$k => $v];
            }
        }
        $str_to_digest = '';
        foreach ($fixedParams as $k => $v) {
            $str_to_digest = $str_to_digest.$k.'='.$v.'&';
        }
        $str_to_digest = substr($str_to_digest, 0, -1).$comkey;
        $data_digest = base64_encode(md5($str_to_digest, true));

        try {
            $response = $this->getHttpClient()->post($url, [
                'form_params' => $fixedParams,
                'headers' => [
                    'ContentType' => 'application/x-www-form-urlencoded; charset=UTF-8',
                    'x-companyId' => $comid,
                    'x-dataDigest' => $data_digest,
                ],
            ])->getBody()->getContents();
            $res = \json_decode($response, true);
            if (isset($res['status']) && !$res['status']) {
                if (isset($res['message'])) {
                    throw new InvalidArgumentException($res['message']);
                } else {
                    throw new InvalidArgumentException($res['msg']);
                }
            }
            if (isset($res['result']) && !$res['result']) {
                if (isset($res['message'])) {
                    throw new InvalidArgumentException($res['message']);
                } else {
                    throw new InvalidArgumentException($res['msg']);
                }
            }
            $resData = new ElecOrderData();
            $resData->status = true;
            $resData->rawData = $res;
            $resData->message = $res['data']['message'];
            $resData->billCode = $res['data']['billCode'];
            $resData->orderId = $res['data']['orderId'];
            $resData->update = $res['data']['update'];
            $resData->siteCode = $res['data']['siteCode'];
            $resData->siteName = $res['data']['siteName'];
            return $resData;
        } catch (\Exception $e) {
            throw new HttpException($e->getMessage(), $e->getCode(), $e);
        }
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
        $jiekouname = 'subBillLog';

        $data = [];
        if ($this->testmode) {
            $url = $this->host_test.$jiekouname;
            $comid = 'kfpttestCode';
            $comkey = 'kfpttestkey==';
        } else {
            $comid = $this->company_id;
            $comkey = $this->key;
            $url = $this->host.$jiekouname;
        }
        $testid = '1111111111';

        foreach ($danhaos as $danhao) {
            $id = $danhao;
            if ($this->testmode) {
                $id = $testid;
            }
            $obj = array('id' => $id, 'billCode' => $danhao, 'pushCategory' => 'callBack', 'pushTarget' => $this->pushTarget, 'pushTime' => 1, 'subscriptionCategory' => 63, 'createBy' => $this->createBy);
            $data[] = $obj;
        }

        $params = array('company_id' => $comid, 'msg_type' => 'SUB', 'data' => $data);
        $fixedParams = array();
        foreach ($params as $k => $v) {
            if ('string' != gettype($v)) {
                $fixedParams += [$k => json_encode($v)];
            } else {
                $fixedParams += [$k => $v];
            }
        }
        $str_to_digest = '';
        foreach ($fixedParams as $k => $v) {
            $str_to_digest = $str_to_digest.$k.'='.$v.'&';
        }
        $str_to_digest = substr($str_to_digest, 0, -1).$comkey;
        $data_digest = base64_encode(md5($str_to_digest, true));

        try {
            $response = $this->getHttpClient()->post($url, [
                'form_params' => $fixedParams,
                'headers' => [
                    'ContentType' => 'application/x-www-form-urlencoded; charset=UTF-8',
                    'x-companyId' => $comid,
                    'x-dataDigest' => $data_digest,
                ],
            ])->getBody()->getContents();

            $res = \json_decode($response, true);

            if (isset($res[0]['status']) && !$res[0]['status']) {
                throw new InvalidArgumentException($res[0]['remark']);
            }
            if (isset($res['status']) && !$res['status']) {
                if (isset($res['remark'])) {
                    throw new InvalidArgumentException($res['remark']);
                } elseif (isset($res['message'])) {
                    throw new InvalidArgumentException($res['message']);
                } else {
                    throw new InvalidArgumentException($res['msg']);
                }
            }
            if (isset($res['result']) && !$res['result']) {
                if (isset($res['message'])) {
                    throw new InvalidArgumentException($res['message']);
                } else {
                    throw new InvalidArgumentException($res['msg']);
                }
            }
            $resData = new ResponseData();
            $resData->status = true;
            $resData->rawData = $res;
            $resData->message = "订阅成功";
            return $resData;
        } catch (\Exception $e) {
            throw new HttpException($e->getMessage(), $e->getCode(), $e);
        }
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
        $jiekouname = 'traceInterfaceNewTraces';

        $data = [];
        if ($this->testmode) {
            $url = $this->host_test.$jiekouname;
            $comid = 'kfpttestCode';
            $comkey = 'kfpttestkey==';
        } else {
            $comid = $this->company_id;
            $comkey = $this->key;
            $url = $this->host.$jiekouname;
        }
        $testid = '1111111111';

        foreach ($danhaos as $danhao) {
            $data[] = $danhao;
        }

        $params = array('company_id' => $comid, 'msg_type' => 'NEW_TRACES', 'data' => $data);
        $fixedParams = array();
        foreach ($params as $k => $v) {
            if ('string' != gettype($v)) {
                $fixedParams += [$k => json_encode($v)];
            } else {
                $fixedParams += [$k => $v];
            }
        }
        $str_to_digest = '';
        foreach ($fixedParams as $k => $v) {
            $str_to_digest = $str_to_digest.$k.'='.$v.'&';
        }
        $str_to_digest = substr($str_to_digest, 0, -1).$comkey;
        $data_digest = base64_encode(md5($str_to_digest, true));

        try {
            $response = $this->getHttpClient()->post($url, [
                'form_params' => $fixedParams,
                'headers' => [
                    'ContentType' => 'application/x-www-form-urlencoded; charset=UTF-8',
                    'x-companyId' => $comid,
                    'x-dataDigest' => $data_digest,
                ],
            ])->getBody()->getContents();

            $res = \json_decode($response, true);

            if (isset($res[0]['status']) && !$res[0]['status']) {
                throw new InvalidArgumentException($res[0]['remark']);
            }
            if (isset($res['status']) && !$res['status']) {
                if (isset($res['remark'])) {
                    throw new InvalidArgumentException($res['remark']);
                } elseif (isset($res['message'])) {
                    throw new InvalidArgumentException($res['message']);
                } else {
                    throw new InvalidArgumentException($res['msg']);
                }
            }
            if (isset($res['result']) && !$res['result']) {
                if (isset($res['message'])) {
                    throw new InvalidArgumentException($res['message']);
                } else {
                    throw new InvalidArgumentException($res['msg']);
                }
            }
            $resData = new TraceData();
            $resData->status = true;
            $resData->rawData = $res;
            $resData->message = $res['msg'];
            $resData->billCode = $res['data']['billCode'];
            $datas = [];
            $dArr = json_decode($res['data']['traces'],true);
            foreach ($dArr as $item){
                $gdata = new GuijiData();
                $gdata->rawData = $item;
                $gdata->desc = $item['desc'];
                $gdata->contacts = $item['dispOrRecMan'];
                $gdata->contactsCode = $item['dispOrRecManCode'];
                $gdata->contactsCode = $item['dispOrRecManCode'];
                $gdata->contactsTel = $item['dispOrRecManPhone'];
                $gdata->isCenter = $item['isCenter'];
                $gdata->preOrNextCity = $item['preOrNextCity'];
                $gdata->preOrNextProv = $item['preOrNextProv'];
                $gdata->preOrNextSite = $item['preOrNextSite'];
                $gdata->preOrNextSiteCode = $item['preOrNextSiteCode'];
                $gdata->preOrNextSitePhone = $item['preOrNextSitePhone'];
                $gdata->remark = $item['remark'];
                $gdata->scanCity = $item['scanCity'];
                $gdata->scanDate = $item['scanDate'];
                $gdata->scanProv = $item['scanProv'];
                $gdata->scanSite = $item['scanSite'];
                $gdata->scanSiteCode = $item['scanSiteCode'];
                $gdata->scanSitePhone = $item['scanSitePhone'];
                $gdata->scanType = $item['scanType'];
                $gdata->signMan = $item['signMan'];
                $datas[] = $gdata;
            }
            $resData->traceDatas = $datas;
            return $resData;
        } catch (\Exception $e) {
            throw new HttpException($e->getMessage(), $e->getCode(), $e);
        }
    }
}
