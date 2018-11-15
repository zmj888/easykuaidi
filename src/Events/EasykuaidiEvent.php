<?php

/*
 * This file is part of the cjl/easykuaidi.
 *
 * (c) cjl<running727@163.com>
 *
 * This source file is subject to the MIT license that is bundled
 * with this source code in the file LICENSE.
 */

namespace Cjl\Easykuaidi\Events;

use Cjl\Easykuaidi\GuijiData;
use Illuminate\Broadcasting\Channel;
use Illuminate\Queue\SerializesModels;
use Illuminate\Broadcasting\PrivateChannel;
use Illuminate\Foundation\Events\Dispatchable;
use Illuminate\Broadcasting\InteractsWithSockets;

class EasykuaidiEvent
{
    use Dispatchable, InteractsWithSockets, SerializesModels;

    public $guijiData;

    /**
     * Create a new event instance.
     */
    public function __construct(GuijiData $guijiData)
    {
        $this->guijiData = $guijiData;
    }

    /**
     * Get the channels the event should broadcast on.
     *
     * @return \Illuminate\Broadcasting\Channel|array
     */
    public function broadcastOn()
    {
        return new PrivateChannel('channel-name');
    }
}
