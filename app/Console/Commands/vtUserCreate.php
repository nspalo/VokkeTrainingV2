<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;

// VokkeTraining
use App\VokkeTraining\Classes\UserManagement;
use App\VokkeTraining\Helpers\CommandHelpers;

class vtUserCreate extends Command
{
    use CommandHelpers;
    
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'vokke:user:create
                            {--name= : Set User name for the new User.}
                            {--street= : Set Street.}
                            {--city= : Set city}
                            {--country= : Set country}
                            {--postal_code= : Set postal_code}
                            ';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Command to create a user';

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
        $args = $this->getInputFromCLI( $this->options(), ["name", "street", "city", "country", "postal_code"] );

        ( new UserManagement( $args ) )->create();
    }
}
