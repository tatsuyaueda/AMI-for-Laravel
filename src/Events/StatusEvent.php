<?php

namespace TatsuyaUeda\AmiForLaravel\Events;

use Illuminate\Queue\SerializesModels;
use Illuminate\Support\Facades\Event;
use PAMI\Message\Event\EventMessage;

class StatusEvent extends BaseEvent
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
    public $accountcode;
    public $context;
    public $exten;
    public $priority;
    public $uniqueid;
    public $type;
    public $dnid;
    public $effectiveconnectedlinenum;
    public $effectiveconnectedlinename;
    public $timetohangup;
    public $bridgeid;
    public $linkedid;
    public $application;
    public $data;
    public $nativeformats;
    public $readformat;
    public $readtrans;
    public $writeformat;
    public $writetrans;
    public $callgroup;
    public $pickupgroup;
    public $seconds;
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
