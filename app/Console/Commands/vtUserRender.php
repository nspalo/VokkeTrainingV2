<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;

// VokkeTraining
use App\VokkeTraining\Classes\UserManagement;
use App\VokkeTraining\Classes\CommandHelpers;

class vtUserRender extends Command
{
    use CommandHelpers;
    
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'vokke:user:show
                            {--rand : Option to randomly show user.}
                            {--uid= : Option to specify a user by providing its id.}';
    
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
        $args = $this->getInputFromCLI( $this->options(), ["rand", "uid"] );
         //dd( $args, $this->options() );
        ( new UserManagement( $args ) )->show();
    }
}
