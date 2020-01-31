<?php

namespace App\VokkeTraining\Entities;

// Doctrine

use Doctrine\ORM\Mapping AS ORM;
use Doctrine\ORM\Mapping\OneToMany;
use Doctrine\ORM\Mapping\JoinColumn;
use Doctrine\Common\Collections\ArrayCollection;

// Laravel
use App\VokkeTraining\Entities\Product;
use App\VokkeTraining\Embeddables\Address;

/**
 * @ORM\Entity
 * @ORM\Table(name="user")
 */
class User
{
    /**
     * @ORM\Id
     * @ORM\GeneratedValue
     * @ORM\Column(type="integer")
     */
    protected $id;

    /**
     * @ORM\Column(type="string")
     */
    protected $name;

    /**
     * @ORM\Embedded(class="App\VokkeTraining\Embeddables\Address")
     * @var Address\Address
     */
    private $address;

    // @joinColumn onDelete="restrict"
    // @joinColumn onDelete="set null"
    /**
     * @ORM\OneToMany(targetEntity="Product", mappedBy="user", cascade={"persist"})
     * @JoinColumn(name="user_id", referencedColumnName="id", onDelete="restrict")
     * @var ArrayCollection|Product[]
     */
    protected $products;

    /**
     * User constructor.
     * @param $name
     * @param $products
     */
    public function __construct( $name )
    {
        $this->name     = $name;
        $this->products = new ArrayCollection;
        $this->address  = new Address();
    }

    /**
     * @return mixed
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * @return mixed
     */
    public function getName()
    {
        return $this->name;
    }

    /**
     * @param mixed $name
     */
    public function setName($name): void
    {
        $this->name = $name;
    }

    public function addProduct( Product $product )
    {
        if( ! $this->products->contains( $product ) )
        {
            $product->setUser($this);
            $this->products->add($product);
        }
    }

    /**
     * @return Product[]|ArrayCollection
     */
    public function getProducts()
    {
        return $this->products;
    }

    /**
     * @return Address\Address
     */
    public function getAddress(): Address
    {
        return $this->address;
    }

}