<?php

namespace TatsuyaUeda\AmiForLaravel\Events;

use Illuminate\Queue\SerializesModels;
use Illuminate\Support\Facades\Event;
use PAMI\Message\Event\EventMessage;

class ActionDBGetEvent extends Event
{
    use SerializesModels;

    public $family;
    public $key;

    /**
     * Create a new event instance.
     *
     * @return void
     */
    public function __construct($family, $key)
    {
        $this->family = $family;
        $this->key = $key;
    }

}
