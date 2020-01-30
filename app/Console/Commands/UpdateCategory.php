<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;

// Vokke Training
use App\VokkeTraining\Classes\CommandManager;

class UpdateCategory extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'update:category
                            {--cid= : Id of category that you want to update.}
                            {--name= : Set value to update name of the category.}
                            {--pid= : Id of new product that you want it to be assigned.}';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Command to update category';

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
        $category_id   = $this->option("cid");
        $category_name = $this->option("name");
        $product_id    = $this->option("pid");

        // Create Product for a User
        ( new CommandManager() )->updateCategory( $category_id, $category_name, $product_id );
    }
}
