<?php

namespace TatsuyaUeda\AmiForLaravel;

use PAMI\Client\Impl\ClientImpl;
use PAMI\Message\Action\CoreShowChannelsAction;
use PAMI\Message\Action\DBGetAction;
use PAMI\Message\Action\DBPutAction;
use PAMI\Message\Action\QueueStatusAction;
use PAMI\Message\Action\StatusAction;
use PAMI\Message\Action\UpdateConfigAction;
use PAMI\Message\Event\EventMessage;
use ReflectionClass;

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
                        case 'Unhold':
                            $eventName = $event->getKey('EventName');
                            break;
                    }
                } else {
                    $eventName = $event->getName();
                }

                $this->invokeEvent($eventName, $event);
            }
        );

        $time3s = null;

        while (true) {
            $this->client->process();
            usleep(1000);

            // 3sごとに更新
            // ToDo:この中で書くのはいまいち
            if ($time3s == null || time() - $time3s == 3) {

                $events = [];
                $events = array_merge($events, $this->actionQueueStatus()->getEvents());
                $events = array_merge($events, $this->actionStatus()->getEvents());

                foreach ($events as $event) {
                    $eventName = $event->getName();
                    $this->invokeEvent($eventName, $event);
                }

                $time3s = time();
            }
        }
    }

    private function invokeEvent($eventName, $event)
    {
        $className = "\\TatsuyaUeda\\AmiForLaravel\\Events\\" . $eventName . "Event";

        if (class_exists($className)) {
            // クラスが存在していれば、コンストラクタを呼ぶ
            event(call_user_func(
                array(new ReflectionClass($className), 'newInstance'),
                $event
            ));
        } else {
            // 存在しなければ、吐き出す
            var_dump('Unknown Event from AMI Package');
            var_dump($event);
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

    /**
     * @param $family
     * @param $key
     * @throws \PAMI\Client\Exception\ClientException
     */
    public function actionDBGet($family, $key)
    {

        $action = new DBGetAction($family, $key);
        $result = $this->client->send($action);

        var_dump($result);

        foreach ($result->getEvents() as $event) {
            $eventName = $event->getName();
            $this->invokeEvent($eventName, $event);
        }
    }

    /**
     *
     */
    public function actionDBPut($family, $key, $value)
    {

        $action = new DBPutAction($family, $key, $value);
        return $this->client->send($action);

    }

    public function actionGetConfig($queueName, $value)
    {

//        $action = new GetConfigAction('queues.conf');
//        $a = $this->client->send($action);
//        var_dump($a);

    }

    /**
     * ConfigをUpdateする
     * @param $filename
     * @param $category
     * @param $var
     * @param $value
     * @param $reload
     * @throws \PAMI\Client\Exception\ClientException
     */
    public function actionUpdateConfig($filename, $category, $var, $value, $reload = '')
    {

        $action = new UpdateConfigAction();
        $action->setSrcFilename($filename);
        $action->setDstFilename($filename);
        $action->setAction('Update');
        $action->setCat($category);
        $action->setVar($var);
        $action->setValue($value);
        $action->setReload($reload);

        $result = $this->client->send($action);
        var_dump($result);

    }

}