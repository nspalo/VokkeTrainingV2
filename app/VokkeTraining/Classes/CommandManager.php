<?php

namespace App\VokkeTraining\Classes;

// Doctrine
use EntityManager;

// VokkeTraining
use App\VokkeTraining\Entities\User;
use App\VokkeTraining\Entities\Product;
use App\VokkeTraining\Entities\Category;

class CommandManager
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

    private $dummyCategories = [
        "consumer",
        "convenience",
        "shopping",
        "specialty",
    ];

    /**
     * CommandManager constructor.
     */
    public function __construct()
    {
        return $this;
    }

    // User
    public function createUserWithProduct($username, $number)
    {
        $products  = $this->generateRandomProducts( $number );
        $user      = $this->createUser( $username );

        foreach( $products as $product )
        {
            $product = $this->createProduct( $product );
            $user->addProduct( $product );
        }

        EntityManager::persist( $user );
        EntityManager::flush();
    }

    private function createUser( $username, $address )
    {
        dd( $address );
        return new User( $username );
    }

    private function getUser( $user_id )
    {
        $user_id = ( ! is_null(  $user_id ) ) ?  $user_id : $this->getRandomUserId();
        return EntityManager::getRepository(User::class)->find( $user_id );
    }

    private function getUserAll()
    {
        return EntityManager::getRepository(User::class)->findAll();
    }

    private function getRandomUserId()
    {
        $user_ids = [];
        $users = $this->getUserAll();

        /** @var User $user */
        foreach( $users as $user )
        {
            array_push( $user_ids, $user->getId() );
        }

        return rand( 1, count($user_ids) - 1 );
    }

    // Products
    public function showUserProducts($user_id )
    {
        $user = $this->getUser( $user_id );
        $this->renderUserProduct( $user );
    }

    public function addProductToUser( $user_id, $product = null )
    {
        $product = ( ! is_null( $product ) ) ? $product : $this->getDummyProduct();

        $user = $this->getUser( $user_id );
        $product = $this->createProduct( $product );
        $user->addProduct( $product );

        EntityManager::persist( $product );
        EntityManager::flush();
    }

    public function removeProductFromUser( $user_id, $product_id = null )
    {
        $user       = $this->getUser( $user_id );
        $product_id = ( ! is_null( $product_id ) ) ? $product_id : $this->getRandomProductId( $user );

        //dd($user, $product_id);
        $product = $this->getProduct( $product_id );

        EntityManager::remove($product);
        EntityManager::flush();
    }

    private function renderUserProduct( $user )
    {
        if( $user )
        {
            /** @var User $user */
            echo "User Name: " . $user->getName() . "\n";
            $products = $user->getProducts();

            echo "User Products: \n";
            /** @var Product $product */
            foreach ($products as $product)
            {
                echo "[" . $product->getId() . "] " . $product->getName() . "\n";
            }
        }
        else
        {
            echo "*** User with id " .  $this->option("uid") . " was not found! ***";
        }
    }

    private function createProduct( $productName )
    {
        return new Product( $productName );
    }

    private function getProduct( $product_id )
    {
//        $product = EntityManager::getRepository(User::class)->find( 1 );
        $product = EntityManager::getRepository(Product::class)->find( $product_id );

        return $product;
        //return EntityManager::getRepository(Product::class)->find( $product_id );
    }

    private function getUserIdFromProduct( $product_id )
    {
        /** @var Product $product */
        $product = $this->getProduct( $product_id );

        /** @var Product $product */
        $user = $product->getUser();

        return $user->getId();
    }

    private function getUserProduct( $user_id, $product_id )
    {
        //return EntityManager::getRepository(Product::class)->find( $product_id );
    }

    private function getDummyProduct()
    {
        $index = rand( 0, count($this->dummyProducts)-1);
        return $this->dummyProducts[ $index ];
    }

    private function generateRandomProducts($numberOfProduct )
    {
        $products = [];

        for( $i = 0; $i < $numberOfProduct; $i++ )
        {
            array_push( $products, $this->getDummyProduct() );
        }

        return $products;
    }

    private function getRandomProductId( $user )
    {
        $product_ids = [];

        if( $user )
        {
            $products = $user->getProducts();

            /** @var Product $product */
            foreach ($products as $product)
            {
                array_push( $product_ids, $product->getId() );
            }
        }

        // randomly get all possible product id from the user
        return $product_ids[ rand( 0, count($product_ids)-1) ];
    }

    // Category
    private function createCategory( $categoryName )
    {
        return new Category( $categoryName );
    }

    private function getCategoryAll()
    {
        return EntityManager::getRepository(Category::class)->findAll();
    }

    private function getCategory( $category_id )
    {
        return EntityManager::getRepository(Category::class)->find( $category_id );
    }

    private function getCategoryLastId()
    {
        $category_ids = [];
        $categories = $this->getCategoryAll();

        /** @var Category $category */
        foreach( $categories as $category )
        {
            array_push( $category_ids, $category->getId() );
        }

        return ( 0 == count( $category_ids ) ) ? 1 :  max( $category_ids ) + 1;
    }

    private function getDummyCategory()
    {
        $index = rand( 0, count($this->dummyCategories) - 1 );
        return $this->dummyCategories[ $index ];
    }

    public function manageCategory( $product_id )
    {
        $categoryLastId = $this->getCategoryLastId();
        $categoryName = "Cat: " .  $categoryLastId  . " - " . $this->getDummyCategory();

        $category = $this->createCategory( $categoryName );

        if( ! is_null( $product_id ) )
        {
            $product = $this->getProduct( $product_id );
            $product->addCategory( $category );
            //$category->addProduct( $product );
        }

        EntityManager::persist( $category );
        EntityManager::flush();
    }

    public function removeCategory( $category_id )
    {
        $category = $this->getCategory( $category_id );
        EntityManager::remove($category);
        EntityManager::flush();
    }

    public function updateCategory( $category_id, $category_name, $product_id )
    {
        /** @var Category $category */
        $category = $this->getCategory( $category_id );

        if( ! is_null( $category ) )
        {
            if( ! is_null( $category_name ))
            {
                $category->setName( $category_name );
            }

            if( ! is_null( $product_id ) )
            {
                $product = $this->getProduct( $product_id );
                $product->addCategory( $category );
//                $category->addProduct( $product );
//                $product->addCategory( $category );
                //EntityManager::persist( $product );
            }

        }

        EntityManager::persist( $category );
        EntityManager::flush();

//        dd( $category );
    }

}