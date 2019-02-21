<?php

namespace TatsuyaUeda\AmiForLaravel\Events;

use Illuminate\Queue\SerializesModels;
use Illuminate\Support\Facades\Event;
use PAMI\Message\Event\EventMessage;

class DeviceStateChangeEvent extends BaseEvent
{
    use SerializesModels;

    public $device;
    public $state;

    /**
     * Create a new event instance.
     *
     * @param EventMessage $event
     */
    public function __construct(EventMessage $event)
    {
        parent::__construct($event);
    }

}
