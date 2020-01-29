<?php

namespace App\VokkeTraining\Classes;

// Doctrine
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
    
    private function getUserId()
    {
      if( $this->args["rand"] )
      {
        return $this->getRandomUserId();
      }
      
      return ( array_key_exists( "uid", $this->args ) ) ? $this->args["uid"] : $this->getRandomUserId();
    }
    
    private function getUsername()
    {
      return ( array_key_exists( "username", $this->args ) ) ? $this->args["username"] : "DefaultName";
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
    
    private function getExpectedNumberOfProduct()
    {
      return ( array_key_exists( "number", $this->args ) ) ? $this->args[ "number" ] : 1;
    }
    
    private function createProduct( $productName )
    {
        return new Product( $productName );
    }
    
    private function createUser()
    {        
        $username = $this->getUsername();    
        return new User( $username );  
    }
    
    private function createUserWithProducts()
    {
        dump( "Create User With Product" );
        $user     = $this->createUser();
        $products = $this->generateRandomProducts( $this->getExpectedNumberOfProduct() );
        
        foreach( $products as $product )
        {
            $product = $this->createProduct( $product );
            $user->addProduct( $product );
        }
        
        return $user;
    }
    
    private function renderUserProduct( $user )
    {
        if( $user )
        {
            /** @var User $user */
            echo "User: " . $user->getName() . "\n";
            $products = $user->getProducts();
            
            if( count( $products ) != 0 )
            {
               echo " Products: \n";
              /** @var Product $product */
              foreach ($products as $product)
              {
                  echo "  - " . $product->getId() . ": " . $product->getName() . "\n";
              }
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
        $user = ( array_key_exists( "number", $this->args ) ) ? $this->createUserWithProducts() : $this->createUser();
        
        EntityManager::persist( $user );
        EntityManager::flush();
    }
    
    public function delete()
    {
        // TODO: Implement delete() method.
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
}
