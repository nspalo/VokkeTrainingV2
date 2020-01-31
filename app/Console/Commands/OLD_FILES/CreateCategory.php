<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;

// Vokke Training
use App\VokkeTraining\Classes\CommandManager;

class CreateCategory extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'create:category
                            {--cid= : Category\'s id to be added.}
                            {--pid= : Product\'s id where the category is going to be added.}';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Command to create category and to add it product';

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
        //  $category = $this->argument("category");
        // $category_id = $this->option("cid");
        $product_id = $this->option("pid");

        // Create Product for a User
        ( new CommandManager() )->manageCategory( $product_id );
    }
}
