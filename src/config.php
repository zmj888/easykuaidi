<?php

/*
 * This file is part of the cjl/easykuaidi.
 *
 * (c) cjl<running727@163.com>
 *
 * This source file is subject to the MIT license that is bundled
 * with this source code in the file LICENSE.
 */

return [
    /*
    * 指定使用哪种接口，zto：中通，kuaidi100：快递100，sto：申通，yto：圆通，sf：顺丰
    */
    'default' => 'zto',

    'testmode' => true,

    /*
     * 中通
     */
    'zto' => [
        /*
        * 中通 合作商编码 （在个人中心查看）
        */
        'company_id' => '',

        /*
        * 中通 合作商签名key
        */
        'key' => '',

        /*
        * 商家ID，又称电子面单账号、电子面单账户、客户ID(正式环境由中通合作网点提供，测试环境使用test)
        */
        'partner_id' => 'test',

        /*
        * 订阅人（ 测试环境统一为：test，生产环境在联调通过后分配。）
        */
        'create_by' => 'test',
    ],

    /*
     * 快递100
     */
    'kuaidi100' => [
        /*
        * 合作商签名key
        */
        'key' => '',
    ],
];
