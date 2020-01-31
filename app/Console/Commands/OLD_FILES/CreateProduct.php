<?php

namespace App\Console\Commands;

// Laravel
use Illuminate\Console\Command;

// Vokke Training
use App\VokkeTraining\Classes\CommandManager;

class CreateProduct extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'create:product
                            {--uid= : User\'s id where the product is going to be added.}
                            {--product= : Name of the product to be added.}';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'An artisan command that adds a product to a user.';

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
        $user_id     = $this->option("uid");
        $productName = $this->option("product");

        // Create Product for a User
        ( new CommandManager() )->addProductToUser( $user_id, $productName );
    }

}
