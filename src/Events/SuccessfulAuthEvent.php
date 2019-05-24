<?php

namespace TatsuyaUeda\AmiForLaravel\Events;

use Illuminate\Queue\SerializesModels;
use Illuminate\Support\Facades\Event;
use PAMI\Message\Event\EventMessage;

class SuccessfulAuthEvent extends BaseEvent
{
    use SerializesModels;

    public $privilege;
    public $eventtv;
    public $severity;
    public $service;
    public $eventversion;
    public $accountid;
    public $sessionid;
    public $localaddress;
    public $remoteaddress;
    public $usingpassword;
    public $sessiontv;

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
