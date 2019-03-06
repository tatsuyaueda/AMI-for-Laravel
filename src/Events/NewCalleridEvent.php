<?php

namespace TatsuyaUeda\AmiForLaravel\Events;

use Illuminate\Queue\SerializesModels;
use Illuminate\Support\Facades\Event;
use PAMI\Message\Event\EventMessage;

class NewCalleridEvent extends BaseEvent
{
    use SerializesModels;

    public $privilege;
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
    public $cid_callingpres;

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
