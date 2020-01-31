<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;

use EntityManager;
use App\VokkeTraining\Entities\Dog;

class vtDogCreate extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'vokke:dog:create
                            {--name= : Set name.}';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Command to create dog';

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
        //dump( $this->option("name"));
        $name = $this->option("name");
        $dog = new Dog( $name );

        EntityManager::persist( $dog );
        EntityManager::flush();

    }
}
