<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;

// VokkeTraining
use App\VokkeTraining\Classes\ProductManagement;
use App\VokkeTraining\Helpers\CommandHelpers;

class vtProductAssign extends Command
{
    use CommandHelpers;
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'vokke:product:assign
                            {--pid= : product id of the product to assign.}
                            {--uid= : user id where the product is going to assign.}
                            ';
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
        $args = $this->getInputFromCLI( $this->options(), ["pid", "uid"] );

        ( new ProductManagement( $args ) )->assignProduct();
    }
}
