<?php

namespace TatsuyaUeda\AmiForLaravel\Events;

use Illuminate\Queue\SerializesModels;
use Illuminate\Support\Facades\Event;
use PAMI\Message\Event\EventMessage;

class ActionDBPutEvent extends Event
{
    use SerializesModels;

    public $family;
    public $key;
    public $val;

    /**
     * Create a new event instance.
     *
     * @return void
     */
    public function __construct($family, $key, $val)
    {
        $this->family = $family;
        $this->key = $key;
        $this->val = $val;
    }

}
