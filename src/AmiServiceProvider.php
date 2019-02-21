<?php

namespace TatsuyaUeda\AmiForLaravel;

use Illuminate\Support\ServiceProvider;
use TatsuyaUeda\AmiForLaravel\Commands\AmiCommand;

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
