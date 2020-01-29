<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;

// VokkeTraining
use App\VokkeTraining\Classes\UserManagement;
use App\VokkeTraining\Classes\CommandHelpers;

class vtUserCreate extends Command
{
    use CommandHelpers;
    
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'vokke:user:create
                            {--username= : Set Username for the new User.}
                            {--number= : Number of products to be created randomly.}';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Command description';

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
        // Get CLI Input
        $args = $this->getInputFromCLI( $this->options(), ["username", "number"] );
        
        //dd("stop", $args );
        
        ( new UserManagement( $args ) )->create();
    }
}
