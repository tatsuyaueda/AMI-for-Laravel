<?php

namespace TatsuyaUeda\AmiForLaravel\Events;

use Illuminate\Queue\SerializesModels;
use Illuminate\Support\Facades\Event;
use PAMI\Message\Event\EventMessage;

class RTCPSentEvent extends BaseEvent
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
    public $to;
    public $from;
    public $ssrc;
    public $pt;
    public $reportcount;
    public $sentntp;
    public $sentrtp;
    public $sentpackets;
    public $sentoctets;
    public $report0sourcessrc;
    public $report0fractionlost;
    public $report0cumulativelost;
    public $report0highestsequence;
    public $report0sequencenumbercycles;
    public $report0iajitter;
    public $report0lsr;
    public $report0dlsr;
    
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
