<?php

/*
 * This file is part of the cjl/easykuaidi.
 *
 * (c) cjl<running727@163.com>
 *
 * This source file is subject to the MIT license that is bundled
 * with this source code in the file LICENSE.
 */

namespace Cjl\Easykuaidi\Controller;

use Illuminate\Routing\Controller;
use Illuminate\Http\Request;

class EasykuaidiController extends Controller
{
    /**
     * 中通的订阅推送接口.
     */
    public function ztoSubscribe(Request $request)
    {
        //这里处理好数据后 使用event发布事件
        // data_digest: 73ZzSwNqyr+Iy56v8HSvTw==

        // data: {"billCode":"680000000020","contacts":"","contactsTel":"","desc":"[东莞市]快件离开[东莞黄江]已发往[中转一区]","orderCode":"","partnerCode":"","remark1":"","remark2":"","remark3":"","remark4":"","remark5":"","remark6":"null","remark7":"","scanCity":"东莞市","scanDate":"2016-08-09 22:00:27","scanSite":"东莞黄江","scanType":"SEND"}

        // company_id: test

        // msg_type: Traces
    }

    /**
     * 快递100的订阅推送接口.
     */
    public function kuaidi100Subscribe(Request $request)
    {
        //这里处理好数据后 使用event发布事件
    }
}
