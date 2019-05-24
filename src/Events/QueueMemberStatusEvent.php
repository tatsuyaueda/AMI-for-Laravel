<?php

namespace TatsuyaUeda\AmiForLaravel\Events;

use Illuminate\Queue\SerializesModels;
use Illuminate\Support\Facades\Event;
use PAMI\Message\Event\EventMessage;

class QueueMemberStatusEvent extends BaseEvent
{
    use SerializesModels;

    public $privilege;
    public $queue;
    public $membername;
    public $interface;
    public $stateinterface;
    public $membership;
    public $penalty;
    public $callstaken;
    public $lastcall;
    public $lastpause;
    public $incall;
    public $status;
    public $paused;
    public $pausedreason;
    public $ringinuse;
    public $wrapuptime;

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
