<?php

namespace TatsuyaUeda\AmiForLaravel;

use Illuminate\Notifications\Action;
use Illuminate\Support\Facades\Event;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\ServiceProvider;
use TatsuyaUeda\AmiForLaravel\Commands\AmiCommand;
use TatsuyaUeda\AmiForLaravel\Events\ActionDBGetEvent;
use TatsuyaUeda\AmiForLaravel\Events\ActionDBPutEvent;
use TatsuyaUeda\AmiForLaravel\Events\ActionUpdateConfigEvent;

class AmiServiceProvider extends ServiceProvider
{
    /**
     * Bootstrap services.
     *
     * @return void
     */
    public function boot()
    {

        // コマンドの登録
        if ($this->app->runningInConsole()) {
            $this->commands([
                AmiCommand::class,
            ]);
        }

        Event::listen(ActionDBGetEvent::class, function (ActionDBGetEvent $data) {
            $ami = app(Ami::class);
            $ami->actionDBGet($data->family, $data->key);
        });

        Event::listen(ActionDBPutEvent::class, function (ActionDBPutEvent $data) {
            $ami = app(Ami::class);
            $ami->actionDBPut($data->family, $data->key, $data->val);
        });

        Event::listen(ActionUpdateConfigEvent::class, function (ActionUpdateConfigEvent $data) {
            $ami = app(Ami::class);
            $ami->actionUpdateConfig($data->filename, $data->category, $data->var, $data->val, $data->reload);
        });

    }

    /**
     * Register services.
     *
     * @return void
     */
    public function register()
    {
        $this->app->singleton(Ami::class);
    }
}
