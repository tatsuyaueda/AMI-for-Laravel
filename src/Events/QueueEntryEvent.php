<?php

namespace TatsuyaUeda\AmiForLaravel\Events;

use Illuminate\Queue\SerializesModels;
use Illuminate\Support\Facades\Event;
use PAMI\Message\Event\EventMessage;

class QueueEntryEvent extends BaseEvent
{
    use SerializesModels;

    public $queue;
    public $position;
    public $channel;
    public $uniqueid;
    public $calleridnum;
    public $calleridname;
    public $connectedlinenum;
    public $connectedlinename;
    public $wait;
    public $actionid;

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
