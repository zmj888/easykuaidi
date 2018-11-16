<h1 align="center"> easykuaidi </h1>

<p align="center"> 对接多家快递平台的电子面单、价格查询、订阅轨迹等接口的Laravel5.5+扩展包。</p>


[![Build Status](https://travis-ci.org/zmj888/easykuaidi.svg?branch=master)](https://travis-ci.org/zmj888/easykuaidi)
[![StyleCI](https://github.styleci.io/repos/157537267/shield?branch=master)](https://github.styleci.io/repos/157537267)
[![Latest Stable Version](https://poser.pugx.org/cjl/easykuaidi/v/stable)](https://packagist.org/packages/cjl/easykuaidi)
[![Total Downloads](https://poser.pugx.org/cjl/easykuaidi/downloads)](https://packagist.org/packages/cjl/easykuaidi)
[![Latest Unstable Version](https://poser.pugx.org/cjl/easykuaidi/v/unstable)](https://packagist.org/packages/cjl/easykuaidi)
[![License](https://poser.pugx.org/cjl/easykuaidi/license)](https://packagist.org/packages/cjl/easykuaidi)

## 说明
实现对接多加快递平台的电子面单、价格查询、订阅轨迹等接口。 初步实现三家：中通、圆通、顺风 另外作为补充，也对接快递100的接口

## 安装

```
$ composer require cjl/easykuaidi
```

Add the service provider to config/app.php in the providers array. If you're using Laravel 5.5 or greater, there's no need to do this.

```
Cjl\Easykuaidi\EasykuaidiServiceProvider::class
```
## 配置

```
$ php artisan vendor:publish --provider="Cjl\Easykuaidi\EasykuaidiServiceProvider"
```


## 使用

- 时效价格查询
```
$this->app('easykuaidi')->getHourPrice('无锡市','江苏','杭州市','浙江');
```


- 订阅快递轨迹
```
$this->app('easykuaidi')->subBillLog(['680000000021'], 'test')
```
在App/Listeners下面新建一个注册事件订阅者，订阅事件
```
Cjl\Easykuaidi\Events\EasykuaidiEvent
```

在EventServiceProvider里注册订阅者类，比如
```
    protected $subscribe = [
        'App\Listeners\EasykuaidiSubscriber',
    ];
```

- 电子面单
```
	$sender = new \Cjl\Easykuaidi\Data\ContactInfo();
    
    $sender->name = "站三";
    
    $sender->mobile = "13323233232";
    
    $sender->province = "江苏";
    
    $sender->city = "南通";
    
    $sender->country = "通州区";
    
    $sender->address = "冠华路900号";
    
    $receiver = new \Cjl\Easykuaidi\Data\ContactInfo();
    
    $receiver->name = "lisi";
    
    $receiver->mobile = "13323233232";
    
    $receiver->province = "江苏";
    
    $receiver->city = "南京";
    
    $receiver->country = "玄武区";
    
    $receiver->address = "中华路100号";
    
    $orderInfo = new \Cjl\Easykuaidi\Data\OrderInfo();
    
    $orderInfo->sender = $sender;
    
    $orderInfo->receiver = $receiver;
    
    $orderInfo->orderid = "xfs101100111011";
    
	$this->app('easykuaidi')->getElecOrder($orderInfo);
 ```


## Contributing

You can contribute in one of three ways:

1. File bug reports using the [issue tracker](https://github.com/cjl/easykuaidi/issues).
2. Answer questions or fix bugs on the [issue tracker](https://github.com/cjl/easykuaidi/issues).
3. Contribute new features or update the wiki.

_The code contribution process is not very formal. You just need to make sure that you follow the PSR-0, PSR-1, and PSR-2 coding guidelines. Any new code contributions must be accompanied by unit tests where applicable._

## License

MIT