<?php
use Illuminate\Support\Facades\Route;

Route::any('/easykuaidi/ztosubscribe', 'Cjl\Easykuaidi\Controller\EasykuaidiController@ztosubscribe')
    ->name('easykuaidi.ztosubscribe');

Route::any('/easykuaidi/kuaidi100subscribe', 'Cjl\Easykuaidi\Controller\EasykuaidiController@kuaidi100subscribe')
    ->name('easykuaidi.kuaidi100subscribe');
