<?php

/*
 * This file is part of the cjl/easykuaidi.
 *
 * (c) cjl<running727@163.com>
 *
 * This source file is subject to the MIT license that is bundled
 * with this source code in the file LICENSE.
 */

use Illuminate\Support\Facades\Route;

Route::any('/easykuaidi/ztosubscribe', 'Cjl\Easykuaidi\Controller\EasykuaidiController@ztosubscribe')
    ->name('easykuaidi.ztosubscribe');

Route::any('/easykuaidi/kuaidi100subscribe', 'Cjl\Easykuaidi\Controller\EasykuaidiController@kuaidi100subscribe')
    ->name('easykuaidi.kuaidi100subscribe');
