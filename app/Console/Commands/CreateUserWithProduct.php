<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;

// Vokke Training
use App\VokkeTraining\Classes\CommandManager;

class CreateUserWithProduct extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'create:user
                            {user : Name of the new User.}
                            
                            {--number= : Number of products to be created randomly.}';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'A command that creates a user and adds random products.';

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
        $username = $this->argument('user');
        $number   = $this->option("number");

        //address_street, address_postal_code, address_city, address_country

        // Create User and Product
        ( new CommandManager() )->createUserWithProduct( $username, $number );
    }
}
