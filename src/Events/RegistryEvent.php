<?php

namespace TatsuyaUeda\AmiForLaravel\Events;

use Illuminate\Queue\SerializesModels;
use Illuminate\Support\Facades\Event;
use PAMI\Message\Event\EventMessage;

class RegistryEvent extends BaseEvent
{
    use SerializesModels;

    public $channeltype;
    public $username;
    public $domain;
    public $status;

    /**
     * Create a new event instance.
     *
     * @return void
     */
    public function __construct(EventMessage $event)
    {
        parent::__construct($event);
    }

}
