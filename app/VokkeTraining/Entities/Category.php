<?php


namespace App\VokkeTraining\Entities;

// Doctrine
use Doctrine\ORM\Mapping AS ORM;
//use Doctrine\ORM\Mapping\ManyToOne;
use Doctrine\ORM\Mapping\ManyToMany;
use Doctrine\ORM\Mapping\JoinColumn;
use Doctrine\Common\Collections\ArrayCollection;

// Laravel
use App\VokkeTraining\Entities\Product;


/**
 * @ORM\Entity
 * @ORM\Table(name="category")
 */
class Category
{
    /**
     * @ORM\ManyToMany(targetEntity="Product", inversedBy="category")
     * @var ArrayCollection|Product[]
     */
    protected $products;

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
     * Category constructor.
     * @param $name
     */
    public function __construct( $name )
    {
        $this->name = $name;
        $this->products = new ArrayCollection;
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
            $this->products[] = $product;
            //$product->addCategory( $this );
        }
    }

    /**
     * @return Product[]|ArrayCollection
     */
    public function getProducts()
    {
        return $this->products;
    }
}