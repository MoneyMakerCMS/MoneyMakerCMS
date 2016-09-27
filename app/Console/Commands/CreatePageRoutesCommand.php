<?php

namespace App\Console\Commands;

use App\Events\Admin\Pages\PagesAlteredEvent;
use Illuminate\Console\Command;

class CreatePageRoutesCommand extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'page:routes';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Generate Page routes for dynamic pages';

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
        $this->info('Starting page routes generation');
        event(new PagesAlteredEvent());
        $this->info('Page routes genererated');
    }
}
