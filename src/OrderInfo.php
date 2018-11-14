<?php

namespace Cjl\Easykuaidi;

class OrderInfo 
{
    /**
     * 订单号
     *
     */
    public $orderid;

    /**
     * 交易号
     *
     */
    public $tradeid='';

    /**
     * ContactInfo 发件人
     *
     */
    public $sender;

    /**
     * ContactInfo 收件人
     *
     */
    public $receiver;

    /**
     * 重量，单位：千克
     *
     */
    public $weight='';

    /**
     * 订单包裹大小（厘米）, 用半角的逗号来分隔长宽高	12,23,11
     *
     */
    public $size='';

    /**
     * 订单包裹内货物总数量
     *
     */
    public $quantity='';

    /**
     * 订单备注
     *
     */
    public $remark='';
    
    /**
     * 订单包裹中商品总价值
     *
     */
    public $price='';

    /**
     * 运输费
     *
     */
    public $freight='';

    /**
     * 保险费
     *
     */
    public $premium='';

    /**
     * 包装费
     *
     */
    public $pack_charges='';
 
    /**
     * 其他费用
     *
     */
    public $other_charges='';

    /**
     * 订单总金额
     *
     */
    public $order_sum='';

    /**
     * 到达收取金额，一般代收货款或者到付件才需指定
     *
     */
    public $collect_sum='';

    /**
     * 订单类型：0标准；1代收；2到付
     *
     */
    public $order_type=0;

}