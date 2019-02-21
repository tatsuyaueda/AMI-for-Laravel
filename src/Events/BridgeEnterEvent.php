<?php

namespace TatsuyaUeda\AmiForLaravel\Events;

use Illuminate\Queue\SerializesModels;
use Illuminate\Support\Facades\Event;
use PAMI\Message\Event\EventMessage;

class BridgeEnterEvent extends BaseEvent
{
    use SerializesModels;

    public $bridgeuniqueid;
    public $bridgetype;
    public $bridgetechnology;
    public $bridgecreator;
    public $bridgename;
    public $bridgenumchannels;
    public $bridgevideosourcemode;
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
