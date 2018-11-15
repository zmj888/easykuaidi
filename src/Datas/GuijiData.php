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

class GuijiData extends ResponseData
{
    /**
     * 原始数据.
     */
    public $rawData;

    /**
     * 快递公司，如中通：zto.
     */
    public $kuaidicom;

    /**
     * 运单号.
     */
    public $billCode;

    /**
     * 收\派件业务员姓名 或 签收客户姓名 或 代理点名称
     */
    public $contacts;

    /**
     * 收\派件业务电话 或 代理点联系电话
     */
    public $contactsTel;

    /**
     * 派件或收件员编号
     */
    public $contactsCode;

    /**
     * 扫描类型，事件/操作，详情参见scanType编码规范
     */
    public $scanType;

    /**
     * 扫描网点是否中心("T" or "F")
     */
    public $isCenter;

    /**
     * 扫描网点
     */
    public $scanSite;

    /**
     * 扫描网点编号
     */
    public $scanSiteCode;

    /**
     * 扫描网点联系方式
     */
    public $scanSitePhone;

    /**
     * 扫描网点所在省份
     */
    public $scanProv;

    /**
     * 扫描城市
     */
    public $scanCity;

    /**
     * 扫描时间（yyyy-MM-dd HH:mm:ss）
     */
    public $scanDate;

    /**
     * 值为[THIRD_PARTY_SIGN] 时，为代理点信息
     */
    public $remark1;

    /**
     * 代理点地址
     */
    public $remark2;

    /**
     * 问题件二级编码
     */
    public $remark3;

    /**
     * 备注信息，后期约定，未用到的可以忽略
     */
    public $remark4;

    /**
     * 备注信息，后期约定，未用到的可以忽略
     */
    public $remark5;

    /**
     * 备注信息，后期约定，未用到的可以忽略
     */
    public $remark6;


    /**
     * 备注
     */
    public $remark;


    /**
     * 上一站或下一站城市
     */
    public $preOrNextCity;

    /**
     * 上一站或下一站省份
     */
    public $preOrNextProv;

    /**
     * 上一站或下一站网点
     */
    public $preOrNextSite;

    /**
     * 上一站或下一站网点编号
     */
    public $preOrNextSiteCode;

    /**
     * 上一站或下一站网点联系方式
     */
    public $preOrNextSitePhone;

    /**
     * 签收人
     */
    public $signMan;

    /**
     * 	路由详细描述
     */
    public $desc;
}
