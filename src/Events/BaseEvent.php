<?php

namespace TatsuyaUeda\AmiForLaravel\Events;

use Illuminate\Queue\SerializesModels;
use Illuminate\Support\Facades\Event;
use PAMI\Message\Event\EventMessage;

class BaseEvent extends Event
{
    use SerializesModels;

    /**
     * Create a new event instance.
     *
     * @param EventMessage $event
     */
    public function __construct(EventMessage $event)
    {

        foreach ($event->getKeys() as $key => $value) {
            // プロパティ名に - が使えないため _ に置換
            $key = str_replace('-', '_', $key);

            if (!property_exists($this, $key)) {
                continue;
            }

            $this->{$key} = $value;
        }

    }

}
