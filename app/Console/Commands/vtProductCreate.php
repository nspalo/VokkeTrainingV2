<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;

// VokkeTraining
use App\VokkeTraining\Classes\ProductManagement;
use App\VokkeTraining\Helpers\CommandHelpers;

class vtProductCreate extends Command
{
    use CommandHelpers;

    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'vokke:product:create
                            {--name= : Set Product name for the new Product.}
                            {--uid=  : Set the user id to automatically assign it to as user.}
                            ';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Command to create a new product';

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
        $args = $this->getInputFromCLI( $this->options(), ["name", "uid"] );
        ( new ProductManagement( $args ) )->create();
    }
}
