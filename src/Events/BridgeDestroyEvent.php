<?php

namespace TatsuyaUeda\AmiForLaravel\Events;

use Illuminate\Queue\SerializesModels;
use Illuminate\Support\Facades\Event;
use PAMI\Message\Event\EventMessage;

class BridgeDestroyEvent extends BaseEvent
{
    use SerializesModels;

    public $bridgeuniqueid;
    public $bridgetype;
    public $bridgetechnology;
    public $bridgecreator;
    public $bridgename;
    public $bridgenumchannels;
    public $bridgevideosourcemode;

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
