<?php

namespace App\VokkeTraining\Classes;

// Doctrine
use EntityManager;

// VokkeTraining
use App\VokkeTraining\Helpers\CommandHelpers;
use App\VokkeTraining\Classes\IEntityManagement;
//use App\VokkeTraining\Entities\User;
use App\VokkeTraining\Entities\Product;
//use App\VokkeTraining\Embeddables\Address;
use App\VokkeTraining\Classes\UserManagement;

class ProductManagement implements IEntityManagement
{
    use CommandHelpers;

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
        // TODO: Implement show() method.
    }

    public function create()
    {
        $user = $this->createProduct();

        EntityManager::persist( $user );
        EntityManager::flush();
    }

    public function delete()
    {
        $product = $this->get();
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
        dd("TEST");
        $user    = ( new UserManagement( $this->args ) )->get();
        $product = $this->get();

//        $user->addProduct( $product );
//
//        EntityManager::persist( $product );
//        EntityManager::flush();
    }

}