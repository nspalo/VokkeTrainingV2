<?php

namespace App\Console\Commands;

// Laravel
use Illuminate\Console\Command;

// Vokke Training
use App\VokkeTraining\Classes\CommandManager;

class ShowUser extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'show:user
                            {--uid= : Option to specify a user by providing its id.}';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'An artisan command that lists a random user from the database and all their products.';

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
        $user_id = $this->option("uid");

        // User Products
        ( new CommandManager() )->showUserProducts( $user_id );
    }

}
