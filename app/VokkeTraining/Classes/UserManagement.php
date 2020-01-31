<?php

namespace App\VokkeTraining\Classes;

// Doctrine
use App\VokkeTraining\Embeddables\Address;
use EntityManager;

// VokkeTraining
use App\VokkeTraining\Classes\IEntityManagement;
use App\VokkeTraining\Entities\User;
use App\VokkeTraining\Entities\Product;

class UserManagement implements IEntityManagement
{
    use CommandHelpers;
    
    private $args;
    
    public function __construct( $args )
    {      
      $this->args = $args;
      return $this;
    }

    private function getRandomUserId()
    {
        $user_ids = [];
        $users = $this->getAll();

        /** @var User $user */
        foreach( $users as $user )
        {
            array_push( $user_ids, $user->getId() );
        }

        return rand( 1, count($user_ids) - 1 );
    }
    
    private function getUserId()
    {
        if( ( array_key_exists( "rand", $this->args ) ? $this->args["rand"] : false ) )
        {
            return $this->getRandomUserId();
        }

        return ( array_key_exists( "uid", $this->args ) ) ? $this->args["uid"] : $this->getRandomUserId();
    }

    private function getUsername()
    {
      return ( array_key_exists( "name", $this->args ) ) ? $this->args["name"] : "Juan Tamad";
    }

    private function createUser()
    {        
        $username = $this->getUsername();
        /** @var User $user */
        $user = new User( $username );

        /** @var Address $address */
        $address = $user->getAddress();
        $address->setStreet( $this->args["street"] );
        $address->setCity( $this->args["city"] );
        $address->setCountry( $this->args["country"] );
        $address->setPostalCode( $this->args["postal_code"] );

        return $user;
    }

    private function get()
    {
        $user_id = $this->getUserId();
        return EntityManager::getRepository(User::class)->find( $user_id );
    }

    private function getAll()
    {
        return EntityManager::getRepository(User::class)->findAll();
    }
    
    public function create()
    {
        $user = $this->createUser();

        EntityManager::persist( $user );
        EntityManager::flush();
    }
    
    public function delete()
    {
        $user = $this->get();
        EntityManager::remove( $user );
        EntityManager::flush();
    }
    
    public function show()
    {
        if( array_key_exists( "uid", $this->args ) )
        {
            $user = $this->get();
            $this->renderUserProduct( $user );
        }
        else
        {
            $users = $this->getAll();
            foreach( $users as $user )
            {
              $this->renderUserProduct( $user );
            }
        }
    }

// --- OLD FUNCTIONS ---

//    private function getExpectedNumberOfProduct()
//    {
//        return ( array_key_exists( "number", $this->args ) ) ? $this->args[ "number" ] : 1;
//    }
//
//    private function createProduct( $productName )
//    {
//        return new Product( $productName );
//    }
//
//    private function createUserWithProducts()
//    {
//        dump( "Create User With Product" );
//        $user     = $this->createUser();
//        $products = $this->generateRandomProducts( $this->getExpectedNumberOfProduct() );
//
//        foreach( $products as $product )
//        {
//            $product = $this->createProduct( $product );
//            $user->addProduct( $product );
//        }
//
//        return $user;
//    }

//    private function renderUserProduct( $user )
//    {
//        if( $user )
//        {
//            /** @var User $user */
//            echo "User: " . $user->getName() . "\n";
//            $products = $user->getProducts();
//
//            if( count( $products ) != 0 )
//            {
//               echo " Products: \n";
//              /** @var Product $product */
//              foreach ($products as $product)
//              {
//                  echo "  - " . $product->getId() . ": " . $product->getName() . "\n";
//              }
//            }
//            else
//            {
//              echo " *** No Product Available ***\n";
//            }
//
//            echo "\n";
//        }
//        else
//        {
//            echo "*** User with id " .  $this->getUserId() . " was not found! ***";
//        }
//    }

}
