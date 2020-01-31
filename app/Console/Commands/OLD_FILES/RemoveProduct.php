<?php

namespace App\Console\Commands;

// Laravel
use Illuminate\Console\Command;

// Vokke Training
use App\VokkeTraining\Classes\CommandManager;

class RemoveProduct extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'remove:product
                            {--uid= : User\'s id where the product is going to be removed.}
                            {--pid= : Option to specify the product by providing its id.}';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'An artisan command that removes a product from a user.';

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
        $user_id    = $this->option("uid");
        $product_id = $this->option("pid");

        ( new CommandManager() )->removeProductFromUser( $user_id, $product_id );
    }

}
