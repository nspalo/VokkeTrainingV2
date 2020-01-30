<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;

// Vokke Training
use App\VokkeTraining\Classes\CommandManager;

class RemoveCategory extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'remove:category
                            {--cid= : Category\'s id to be added.}';

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
        //
         $category_id = $this->option("cid");
//        $product_id = $this->option("pid");

        // Create Product for a User
        ( new CommandManager() )->removeCategory( $category_id );
    }
}
