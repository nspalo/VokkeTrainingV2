<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;

use EntityManager;
use App\VokkeTraining\Entities\Cat;

class vtCatCreate extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'vokke:cat:create
                            {--name= : Set name.}';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Command to create a cat.';

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
        $name = $this->option("name");
        $cat = new Cat( $name );

        EntityManager::persist( $cat );
        EntityManager::flush();

    }
}
