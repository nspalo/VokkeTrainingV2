<?php


namespace App\VokkeTraining\Entities;

use Doctrine\ORM\Mapping AS ORM;

/**
 * @ORM\Entity
 * @ORM\Table(name="cat")
 */
class Cat extends Animal
{
    /**
     * Cat constructor.
     * @param $name
     */
    public function __construct( $name )
    {
            $this->name = $name;
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
}