<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;

// VokkeTraining
use App\VokkeTraining\Classes\ProductManagement;
use App\VokkeTraining\Helpers\CommandHelpers;

class vtProductRender extends Command
{
    use CommandHelpers;

    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'vokke:product:show
                            {--rand : Option to randomly show product.}
                            {--pid= : Option to specify a product by providing its id.}';

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
        $args = $this->getInputFromCLI( $this->options(), ["rand", "pid"] );
        //dd( $args, $this->options() );
        ( new ProductManagement( $args ) )->show();
    }
}
