<?php

namespace TatsuyaUeda\AmiForLaravel\Events;

use Illuminate\Queue\SerializesModels;
use Illuminate\Support\Facades\Event;
use PAMI\Message\Event\EventMessage;

class LocalOptimizationBeginEvent extends BaseEvent
{
    use SerializesModels;

    public $privilege;
    public $localonechannel;
    public $localonechannelstate;
    public $localonechannelstatedesc;
    public $localonecalleridnum;
    public $localonecalleridname;
    public $localoneconnectedlinenum;
    public $localoneconnectedlinename;
    public $localonelanguage;
    public $localoneaccountcode;
    public $localonecontext;
    public $localoneexten;
    public $localonepriority;
    public $localoneuniqueid;
    public $localonelinkedid;
    public $localtwochannel;
    public $localtwochannelstate;
    public $localtwochannelstatedesc;
    public $localtwocalleridnum;
    public $localtwocalleridname;
    public $localtwoconnectedlinenum;
    public $localtwoconnectedlinename;
    public $localtwolanguage;
    public $localtwoaccountcode;
    public $localtwocontext;
    public $localtwoexten;
    public $localtwopriority;
    public $localtwouniqueid;
    public $localtwolinkedid;
    public $sourcechannel;
    public $sourcechannelstate;
    public $sourcechannelstatedesc;
    public $sourcecalleridnum;
    public $sourcecalleridname;
    public $sourceconnectedlinenum;
    public $sourceconnectedlinename;
    public $sourcelanguage;
    public $sourceaccountcode;
    public $sourcecontext;
    public $sourceexten;
    public $sourcepriority;
    public $sourceuniqueid;
    public $sourcelinkedid;
    public $destuniqueid;
    public $id;

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
