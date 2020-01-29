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
    private $args;
    
    public function __construct( $args )
    {      
      $this->args = $args; 
      return $this;
    }
    
    private function getUsername()
    {
      return ( array_key_exists( "username", $this->args ) ) ? $this->args["username"] : "UserName";
    }
    
    private function createUser()
    {
      $username = $this->getUsername();      
      return new User( $username );      
    }
    
    private function createUserWithProduct( $user, $product_name )
    {
        $product = ( ! is_null( $product_name ) ) ? $product_name : $this->getDummyProduct();
        //$user    = $this->getUser( $user_id );
        $product = $this->createProduct( $product );
        $user->addProduct( $product );
    }
    
    private function createUserWithProducts()
    {
      
    }
    
    public function create()
    {
      /** @var User $user */
      $user = $this->createUser();
      
      
      $this->createUserWithProduct( $user, $product_name );
      
      // EntityManager::persist( $user );
      // EntityManager::flush();
    }

    public function delete()
    {
        // TODO: Implement delete() method.
    }

    public function get()
    {
        // TODO: Implement get() method.
    }

    public function getAll()
    {
        // TODO: Implement getAll() method.
    }
}
