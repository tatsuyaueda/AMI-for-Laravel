<?php

namespace TatsuyaUeda\AmiForLaravel\Events;

use Illuminate\Queue\SerializesModels;
use Illuminate\Support\Facades\Event;
use PAMI\Message\Event\EventMessage;

class AgentCompleteEvent extends BaseEvent
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
    public $destchannel;
    public $destchannelstate;
    public $destchannelstatedesc;
    public $destcalleridnum;
    public $destcalleridname;
    public $destconnectedlinenum;
    public $destconnectedlinename;
    public $destlanguage;
    public $destaccountcode;
    public $destcontext;
    public $destexten;
    public $destpriority;
    public $destuniqueid;
    public $destlinkedid;
    public $queue;
    public $interface;
    public $membername;
    public $holdtime;
    public $talktime;
    public $reason;


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
