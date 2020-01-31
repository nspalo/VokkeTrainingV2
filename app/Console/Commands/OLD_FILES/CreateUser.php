<?php

namespace App\Console\Commands;

// Laravel
use Illuminate\Console\Command;

// Vokke Training
use App\VokkeTraining\Classes\CommandManager;

class CreateUser extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'create:user
                            {user : Name of the new User.}
                            {street}
                            {city}
                            {country}
                            {postal_code}
                            ';

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
        $address  = [
            "street"      => $this->argument('street'),
            "city"        => $this->argument('city'),
            "country"     => $this->argument('country'),
            "postal_code" => $this->argument('postal_code'),
        ];


        // Create User and Product
        ( new CommandManager() )->createUser( $username, $address );
    }
}
