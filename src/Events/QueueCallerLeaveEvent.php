<?php

namespace TatsuyaUeda\AmiForLaravel\Events;

use Illuminate\Queue\SerializesModels;
use Illuminate\Support\Facades\Event;
use PAMI\Message\Event\EventMessage;

class QueueCallerLeaveEvent extends BaseEvent
{
    use SerializesModels;

    public $channel;
    public $channelstate;
    public $channelstatedesc;
    public $calleridnum;
    public $calleridname;
    public $connectedlinenum;
    public $connectedlinename;
    public $language;
    public $accountcode;
    public $context;
    public $exten;
    public $priority;
    public $uniqueid;
    public $linkedid;
    public $queue;
    public $position;
    public $count;

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
