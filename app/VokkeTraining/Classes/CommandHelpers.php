<?php

namespace App\VokkeTraining\Classes;

trait CommandHelpers
{
    private $dummyProducts = array(
        "Phone",
        "Tablet",
        "House",
        "Car",
        "Motorcycle",
        "Guitar",
        "Table",
        "Laptop",
        "Chair",
        "Wallet",
        "Monitor",
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
}