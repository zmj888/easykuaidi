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

use Cjl\Easykuaidi\Events\EasykuaidiEvent;
use Cjl\Easykuaidi\GuijiData;
use Illuminate\Routing\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;

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
        Log::info('ztoSubscribe');

        $guijiData = new GuijiData();
        $guijiData->rawData = $request->data;
        $guijiData->kuaidicom = "zto";
		
        if (!empty($request->data)) {
            $data = json_decode($request->data,true);
			$guijiData->billCode = $data['billCode'];
			$guijiData->contacts = $data['contacts'];
			$guijiData->contactsTel = $data['contactsTel'];
			$guijiData->desc = $data['desc'];
			$guijiData->scanType = $data['scanType'];
			$guijiData->scanSite = $data['scanSite'];
			$guijiData->scanCity = $data['scanCity'];
			$guijiData->scanDate = $data['scanDate'];
			$guijiData->remark1 = $data['remark1'];
			$guijiData->remark2 = $data['remark2'];
			$guijiData->remark3 = $data['remark3'];
			$guijiData->remark4 = $data['remark4'];
			$guijiData->remark5 = $data['remark5'];
			$guijiData->remark6 = $data['remark6'];
		}
		
		
        event(new EasykuaidiEvent($guijiData));
		
		$resp = array('message'=>'','result'=>'success','status'=>true,'statusCode'=>'0');
        return json_encode($resp);
    }

    /**
     * 快递100的订阅推送接口.
     */
    public function kuaidi100Subscribe(Request $request)
    {
        //这里处理好数据后 使用event发布事件
    }
}
