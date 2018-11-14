<?php

/*
 * This file is part of the cjl/easykuaidi.
 *
 * (c) cjl<running727@163.com>
 *
 * This source file is subject to the MIT license that is bundled
 * with this source code in the file LICENSE.
 */

namespace Cjl\Easykuaidi\Tests;

use Cjl\Easykuaidi\OrderInfo;
use Cjl\Easykuaidi\ContactInfo;
use Cjl\Easykuaidi\Adapter\ZTOAdapter;
use Cjl\Easykuaidi\Exceptions\InvalidArgumentException;
use PHPUnit\Framework\TestCase;
use GuzzleHttp\ClientInterface;

class ZTOAdapterTest extends TestCase
{
    // public function testGetHourPriceWithInvalidConstrctArguments()
    // {
    //     $adapter = new ZTOAdapter("","");
    //     // 断言会抛出此异常类
    //     $this->expectException(InvalidArgumentException::class);
    // }

    public function testGetHourPrice()
    {
        $adapter = new ZTOAdapter('asd', 'asd', true, 'test', 'test');

        $this->assertSame(['data' => ['addMoney' => '2', 'firstMoney' => '10', 'hour' => '0'], 'msg' => '获取报价成功', 'status' => true], $adapter->getHourPrice('无锡市', '江苏', '杭州市', '浙江'));
    }

    // public function testGetElecOrder()
    // {
    //     $adapter = new ZTOAdapter("asd","asd",true,'test','test');

    //     $sender = new ContactInfo();
    //     $sender->name = "站三";
    //     $sender->mobile = "13323233232";
    //     $sender->province = "江苏";
    //     $sender->city = "南通";
    //     $sender->country = "通州区";
    //     $sender->address = "冠华路900号";

    //     $receiver = new ContactInfo();
    //     $receiver->name = "lisi";
    //     $receiver->mobile = "13323233232";
    //     $receiver->province = "江苏";
    //     $receiver->city = "南京";
    //     $receiver->country = "玄武区";
    //     $receiver->address = "中华路100号";

    //     $orderInfo = new OrderInfo();
    //     $orderInfo->sender = $sender;
    //     $orderInfo->receiver = $receiver;
    //     $orderInfo->orderid = "xfs101100111011";

    //     $this->assertSame(['data'=>["billCode"=>"73100616669307","message"=>'单号获取成功',"orderId"=>'xfs101100111011',"siteCode"=>'02100',"siteName"=>'上海',"update"=>true],'message'=>'TRUE','result' => true],
    //         $adapter->getElecOrder($orderInfo));
    // }

    public function testSubBillLog()
    {
        $adapter = new ZTOAdapter('asd', 'asd', true, 'test', 'test', 'http://requestbin.leo108.com/174je361');
        $this->assertSame([['id' => '1111111111', 'mailNo' => '', 'remark' => '订阅成功', 'status' => true]], $adapter->subBillLog(['680000000020'], 'test'));
    }

    public function testGetHttpClient()
    {
        $w = new ZTOAdapter('asd', 'asd', true);

        // 断言返回结果为 GuzzleHttp\ClientInterface 实例
        $this->assertInstanceOf(ClientInterface::class, $w->getHttpClient());
    }

    public function testSetGuzzleOptions()
    {
        $w = new ZTOAdapter('asd', 'asd', true);

        // 设置参数前，timeout 为 null
        $this->assertNull($w->getHttpClient()->getConfig('timeout'));

        // 设置参数
        $w->setGuzzleOptions(['timeout' => 5000]);

        // 设置参数后，timeout 为 5000
        $this->assertSame(5000, $w->getHttpClient()->getConfig('timeout'));
    }
}
