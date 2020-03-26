<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use App\Events\Analytics;

class PushAnalytics extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'analytics:push';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Send out the analytics event to populate the frontend';

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
        // Inform
        $this->info('Pushing analytics...');

        // Fire event
        event( new Analytics());

        // Inform
        $this->info('Complete.');
    }
}
