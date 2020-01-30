<?php

namespace App\VokkeTraining\Entities;

// Doctrine
use Doctrine\ORM\Mapping AS ORM;
//use Doctrine\ORM\Mapping\ManyToOne;
use Doctrine\ORM\Mapping\ManyToMany;
use Doctrine\ORM\Mapping\JoinColumn;
use Doctrine\Common\Collections\ArrayCollection;

// Laravel
use App\VokkeTraining\Entities\User;
use App\VokkeTraining\Entities\Category;

/**
 * @ORM\Entity
 * @ORM\Table(name="product")
 */
class Product
{
    /**
     * @ORM\ManyToOne(targetEntity="User", inversedBy="products")
     *  @JoinColumn(name="user_id", referencedColumnName="id")
     * @var User
     */
    protected $user;

    /**
     * @ORM\ManyToMany(targetEntity="Category", inversedBy="product", cascade={"persist"})
     * @var ArrayCollection|Category[]
     */
    protected $categories;

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
     * Product constructor.
     * @param User $user
     * @param $name
     */
    //    public function __construct(User $user, $name)
    public function __construct($name)
    {
        $this->name = $name;
        $this->categories = new ArrayCollection;
    }

    /**
     * @return mixed
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * @return User
     */
    public function getUser(): User
    {
        return $this->user;
    }

    /**
     * @param User $user
     */
    public function setUser(User $user): void
    {
        $this->user = $user;
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

    public function addCategory( Category $category )
    {
        if( ! $this->categories->contains( $category ) )
        {
            //$this->categories->addProduct($category);
            $this->categories[] = $category;
        }
    }
}