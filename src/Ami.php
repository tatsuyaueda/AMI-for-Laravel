<?php

namespace TatsuyaUeda\AmiForLaravel;

use Illuminate\Support\Carbon;
use PAMI\Client\Impl\ClientImpl;
use PAMI\Message\Action\CoreShowChannelsAction;
use PAMI\Message\Action\GetConfigAction;
use PAMI\Message\Action\QueueRuleAction;
use PAMI\Message\Action\QueuesAction;
use PAMI\Message\Action\QueueStatusAction;
use PAMI\Message\Action\QueueSummaryAction;
use PAMI\Message\Action\StatusAction;
use PAMI\Message\Action\UpdateConfigAction;
use PAMI\Message\Event\DialBeginEvent;
use PAMI\Message\Event\DialEndEvent;
use PAMI\Message\Event\EventMessage;
use PAMI\Message\Event\UnknownEvent;
use PAMI\Message\Event\OriginateResponseEvent;
use ReflectionClass;
use TatsuyaUeda\AmiForLaravel\Events\DeviceStateChangeEvent;

/**
 * Class AsteriskLinker
 * @package App\Libs
 */
class Ami
{
    // クライアント
    private $client = null;
    // 接続状態
    private $connect = false;

    /**
     * AsteriskLinker constructor.
     */
    public function __construct()
    {
        $options = array(
            'host' => env('ASTERISK_AMI_HOST'),
            'scheme' => 'tcp://',
            'port' => env('ASTERISK_AMI_PORT', 5038),
            'username' => env('ASTERISK_AMI_USER'),
            'secret' => env('ASTERISK_AMI_SECRET'),
            'connect_timeout' => 10,
            'read_timeout' => 50
        );

        $this->client = new ClientImpl($options);

        $this->client->open();

        $this->connect = true;

    }

    /**
     * デストラクタ
     */
    public function __destruct()
    {
        // 接続されている場合は、切断する
        if ($this->connect) {
            $this->client->close();
            $this->connect = false;
        }
    }

    /**
     * プレゼンス情報の更新
     */
    public function handle()
    {
        if (!$this->connect) {
            return;
        }

        // すべてのイベントを捕捉
        $this->client->registerEventListener(
            function (EventMessage $event) {

                $eventName = '';

                if ($event->getName() == 'UnknownEvent') {
                    // PHP-AMIで対応していないイベントの場合
                    switch ($event->getKey('EventName')) {
                        case 'AgentComplete':
                            $eventName = 'AgentComplete';
                            break;
                        case 'Unhold':
                            $eventName = 'Unhold';
                            break;
                    }
                } else {
                    $eventName = $event->getName();
                }

                // クラス名を生成
                $className = "\\TatsuyaUeda\\AmiForLaravel\\Events\\" . $eventName . "Event";

                if (class_exists($className)) {
                    // クラスが存在していれば、コンストラクタを呼ぶ
                    event(call_user_func(
                        array(new ReflectionClass($className), 'newInstance'),
                        $event
                    ));
                } else {
                    // 存在しなければ、吐き出す
                    var_dump($event);
                }
            }
        );

        $time = null;

        while (true) {
            $this->client->process();
            usleep(1000);

            // 3sごとに更新
            if ($time == null || time() - $time == 3) {

                $events = [];
                $events = array_merge($events, $this->actionQueueStatus()->getEvents());
//                $events = array_merge($events, $this->actionCoreShowChannels()->getEvents());
                $events = array_merge($events, $this->actionStatus()->getEvents());
//                $this->actionGetConfig();

                foreach ($events as $event) {
                    $eventName = $event->getName();
                    $className = "\\TatsuyaUeda\\AmiForLaravel\\Events\\" . $eventName . "Event";

                    if (class_exists($className)) {
                        // クラスが存在していれば、コンストラクタを呼ぶ
                        event(call_user_func(
                            array(new ReflectionClass($className), 'newInstance'),
                            $event
                        ));
                    } else {
                        // 存在しなければ、吐き出す
                        var_dump($event);
                    }
                }

                $time = time();
            }
        }
    }

    public function actionQueueStatus()
    {

        $action = new QueueStatusAction();
        return $this->client->send($action);

    }

    public function actionCoreShowChannels()
    {

        $action = new CoreShowChannelsAction();
        return $this->client->send($action);

    }

    public function actionStatus()
    {

        $action = new StatusAction();
        return $this->client->send($action);

    }


    public function actionGetConfig()
    {

//        $action = new GetConfigAction('queues.conf');
//        $a = $this->client->send($action);
//        var_dump($a);

        $b = new UpdateConfigAction();
        $b->setSrcFilename('queues.conf');
        $b->setDstFilename('queues.conf');
        $b->setAction('Update');
        $b->setCat('Cust');
        $b->setVar('maxlen');
        $b->setValue('5');
        $b->setReload('Queues');
        $c = $this->client->send($b);
        var_dump($c);
    }

}