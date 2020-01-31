<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;

// VokkeTraining
use App\VokkeTraining\Classes\ProductManagement;
use App\VokkeTraining\Helpers\CommandHelpers;

class vtProductDelete extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'vokke:product:assign
                            {--pid= : product id of the product to delete.}';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Command to delete product';

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
        $args = $this->getInputFromCLI( $this->options(), ["pid"] );
        ( new ProductManagement( $args ) )->delete();
    }
}
