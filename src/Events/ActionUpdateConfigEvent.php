<?php

namespace TatsuyaUeda\AmiForLaravel\Events;

use Illuminate\Queue\SerializesModels;
use Illuminate\Support\Facades\Event;
use PAMI\Message\Event\EventMessage;

class ActionUpdateConfigEvent extends Event
{
    use SerializesModels;

    public $filename;
    public $category;
    public $var;
    public $val;
    public $reload;

    /**
     * Create a new event instance.
     *
     * @return void
     */
    public function __construct($filename, $category, $var, $val, $reload = '')
    {
        $this->filename = $filename;
        $this->category = $category;
        $this->var = $var;
        $this->val = $val;
        $this->reload = $reload;
    }

}
