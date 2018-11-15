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

class ContactInfo
{
    /**
     * 联系人姓名.
     */
    public $name;

    /**
     * 联系人手机.
     */
    public $mobile;

    /**
     * 联系人公司名称.
     */
    public $company;

    /**
     * 联系人座机号码
     */
    public $phone;

    /**
     * 省份.
     */
    public $province;

    /**
     * 城市
     */
    public $city;

    /**
     * 区县
     */
    public $country = '';

    /**
     * 街道地址
     */
    public $address = '';

    /**
     * 邮编.
     */
    public $zipcode = '';
}
