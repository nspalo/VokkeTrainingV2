<?php

namespace App\VokkeTraining\Helpers;

trait CommandHelpers
{
    private $dummyProducts = array(
        "Laptop",
        "Tablet",
        "Phone",
        "House",
        "Table",
        "Chair",
        "Guitar",
        "TV",
        "Monitor",
        "Car",
        "Motorcycle",
        "Wallet",
        "Keyboard"
    );
    
    public function getInputFromCLI( $argList, $argFilters )
    {
      $args = [];
      foreach( $argFilters as $filter )
      {
        if( array_key_exists( $filter, $argList ) )
        {
          if( ! is_null( $argList[ $filter ] ) )
          {            
            $args[ $filter ] = $argList[ $filter ];
          }
        }
      }

      return $args;
    }
    
    public function getDummyProduct()
    {
        $index = rand( 0, count($this->dummyProducts)-1);
        return $this->dummyProducts[ $index ];
    }
    
    public function generateRandomProducts( $numberOfProduct )
    {
        $products = [];

        for( $i = 0; $i < $numberOfProduct; $i++ )
        {
            array_push( $products, $this->getDummyProduct() );
        }

        return $products;
    }
}