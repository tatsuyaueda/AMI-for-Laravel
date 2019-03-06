<?php

namespace TatsuyaUeda\AmiForLaravel\Events;

use Illuminate\Queue\SerializesModels;
use Illuminate\Support\Facades\Event;
use PAMI\Message\Event\EventMessage;

class ExtensionStatusEvent extends BaseEvent
{
    use SerializesModels;

    public $rivilege;
    public $exten;
    public $context;
    public $hint;
    public $status;
    public $statustext;

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
