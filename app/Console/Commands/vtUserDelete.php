<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;

// VokkeTraining
use App\VokkeTraining\Classes\UserManagement;
use App\VokkeTraining\Helpers\CommandHelpers;

class vtUserDelete extends Command
{
    use CommandHelpers;

    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'vokke:user:delete {--uid= : User Id to delete.}';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Command to delete a user';

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
        $args = $this->getInputFromCLI( $this->options(), ["uid"] );

        ( new UserManagement( $args ) )->delete();
    }
}
