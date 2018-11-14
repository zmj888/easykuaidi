<?php

namespace Cjl\Easykuaidi\Adapter;

use GuzzleHttp\Client;
use Cjl\Easykuaidi\EasykuaidiAdapterInterface;

abstract class AbstractEasykuaidiAdapter implements EasykuaidiAdapterInterface
{
    /**
     * 
     * 是否测试模式
     * 
     */
    protected $testmode = false;

    /**
     * @var array GuzzleHttp的配置参数
     */
    protected $guzzleOptions = [];

    /**
     * 
     * 回调接口地址
     * 
     */
    protected $pushTarget;

    /**
     * 
     * 获取GuzzleHttp的Client对象
     * @return Client
     */
    public function getHttpClient()
    {
        return new Client($this->guzzleOptions);
    }

    /**
     * 
     * 设置GuzzleHttp的配置参数
     *
     */
    public function setGuzzleOptions(array $options)
    {
        $this->guzzleOptions = $options;
    }

}