<?php

namespace App\VokkeTraining\Helpers;

// Doctrine
use EntityManager;

// VokkeTraining
use App\VokkeTraining\Classes\IEntityManagement;
use App\VokkeTraining\Entities\User;
use App\VokkeTraining\Entities\Product;
use App\VokkeTraining\Embeddables\Address;


trait DisplayHelpers
{
    public function renderMessageCLI( $message )
    {
        echo "\n{$message}\n";
    }

    public function renderUserProducts( $user )
    {
        if( $user )
        {
            /** @var User $user */
//            echo "User: " . $user->getName() . "\n";
            echo "- " . $user->getId() . ": " . $user->getName() . "\n";

            $products = $user->getProducts();

            if( count( $products ) != 0 )
            {
                $this->renderProducts( $products );
            }
            else
            {
                echo " *** No Product Available ***\n";
            }

            echo "\n";
        }
        else
        {
            echo "*** User with id " .  $this->getUserId() . " was not found! ***";
        }
    }

    public function renderProduct( $product )
    {
        echo "- " . $product->getId() . ": " . $product->getName() . "\n";
    }

    public function renderProducts( $products )
    {
        echo " Products: \n";
        /** @var Product $product */
        foreach ($products as $product)
        {
            $this->renderProduct( $product );
        }
    }

}