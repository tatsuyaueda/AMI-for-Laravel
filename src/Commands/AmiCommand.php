<?php

namespace TatsuyaUeda\AmiForLaravel\Commands;

use Illuminate\Console\Command;
use Illuminate\Support\Facades\Event;
use TatsuyaUeda\AmiForLaravel\Ami;

class AmiCommand extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'command:AmiCommand';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'AMI(Asterisk Manager Interface) Daemon';

    /**
     * Create a new command instance.
     *
     * @return void
     */
    public function __construct()
    {
        parent::__construct();
    }

    /**
     * Execute the console command.
     *
     * @return mixed
     */
    public function handle()
    {
        $ami = app(Ami::class);
        $ami->handle();

    }
}
