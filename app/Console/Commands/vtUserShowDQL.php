<?php

namespace App\Console\Commands;

use Doctrine\DBAL\Query\Expression\ExpressionBuilder;
use Doctrine\ORM\Query\Expr;
use Illuminate\Console\Command;

// Doctrine
use EntityManager;
//use Doctrine_Core;

// VokkeTraining
use App\VokkeTraining\Entities\User;
use Illuminate\Database\Query\Expression;

class vtUserShowDQL extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'vokke:user:dqlshow';

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

        /** @var EntityManager $entityManager */
        $entityManager = \App::make(\Doctrine\ORM\EntityManager::class);
        $result = $entityManager->createQueryBuilder()
            ->select('potato')
            ->from(User::class, 'potato')
            ->join('potato.products', 'lemon')
            ->where('potato.name = :pName1')
            ->andWhere('lemon.id = 1')
            ->setParameter('pName1', 'User5')
            ->getQuery()->getOneOrNullResult();

        dd($result);
    }
}
