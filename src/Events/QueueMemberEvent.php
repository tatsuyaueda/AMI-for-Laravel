<?php

namespace TatsuyaUeda\AmiForLaravel\Events;

use Illuminate\Queue\SerializesModels;
use Illuminate\Support\Facades\Event;
use PAMI\Message\Event\EventMessage;

class QueueMemberEvent extends BaseEvent
{
    use SerializesModels;

    public $queue;
    public $name;
    public $location;
    public $stateinterface;
    public $membership;
    public $penalty;
    public $callstaken;
    public $lastcall;
    public $incall;
    public $status;
    public $paused;
    public $pausedreason;
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
