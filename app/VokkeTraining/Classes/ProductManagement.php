<?php

namespace App\VokkeTraining\Classes;

// Doctrine

use EntityManager;

// VokkeTraining
use App\VokkeTraining\Entities\Product;
use App\VokkeTraining\Helpers\CommandHelpers;
use App\VokkeTraining\Helpers\DisplayHelpers;
use App\VokkeTraining\Classes\IEntityManagement;

class ProductManagement implements IEntityManagement
{
    use CommandHelpers;
    use DisplayHelpers;

    private $args;

    public function __construct( $args )
    {
        $this->args = $args;
        return $this;
    }

    private function getProductName()
    {
        return ( array_key_exists( "name", $this->args ) ) ? $this->args["name"] : "Test Product";
    }

    private function createProduct()
    {
        $productName = $this->getProductName();
        return new Product( $productName );
    }

    public function show()
    {
        if( array_key_exists( "pid", $this->args ) )
        {
            $this->renderProduct( $this->get() );
        }
        else
        {
            $this->renderProducts( $this->getAll() );
        }
    }

    public function create()
    {
        $user = $this->getUser();
        $product = $this->createProduct();
        $message = "User was not found, Product was created!";

        if( ! is_null($user) )
        {
            $message = "Product was created and assigned to the User.";
            $user->addProduct( $product );
        }

        $this->renderMessageCLI( $message );
        EntityManager::persist( $product );
        EntityManager::flush();
    }

    public function delete()
    {
        $product = $this->get();
        $this->renderMessageCLI( "Product was deleted." );

        EntityManager::remove( $product );
        EntityManager::flush();
    }

    private function getRandomProductId()
    {
        $product_ids = [];
        $products = $this->getAll();

        /** @var Product $product */
        foreach( $products as $product )
        {
            array_push($product_ids, $product->getId() );
        }

        return rand( 1, count($product_ids) - 1 );
    }

    private function getProductId()
    {
        if( ( array_key_exists( "rand", $this->args ) ? $this->args["rand"] : false ) )
        {
            return $this->getRandomProductId();
        }

        return ( array_key_exists( "pid", $this->args ) ) ? $this->args["pid"] : $this->getRandomProductId();
    }

    private function get()
    {
        $product_id = $this->getProductId();
        return EntityManager::getRepository(Product::class)->find( $product_id );
    }

    private function getAll()
    {
        return EntityManager::getRepository(Product::class)->findAll();
    }

    public function assignProduct()
    {
        $user    = $this->getUser();
        $product = $this->get();
        $user->addProduct( $product );
        $this->renderMessageCLI( "Product was assigned to User." );

        EntityManager::persist( $product );
        EntityManager::flush();
    }

}