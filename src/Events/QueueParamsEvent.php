<?php

namespace TatsuyaUeda\AmiForLaravel\Events;

use Illuminate\Queue\SerializesModels;
use Illuminate\Support\Facades\Event;
use PAMI\Message\Event\EventMessage;

class QueueParamsEvent extends BaseEvent
{
    use SerializesModels;

    public $queue;
    public $max;
    public $strategy;
    public $calls;
    public $holdtime;
    public $talktime;
    public $completed;
    public $abandoned;
    public $servicelevel;
    public $servicelevelperf;
    public $weight;
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
