<?php

namespace App\VokkeTraining\Entities;

use Doctrine\ORM\Mapping AS ORM;

/**
 * @ORM\Entity
 * @ORM\InheritanceType("SINGLE_TABLE")
 * @ORM\DiscriminatorColumn(name="animalType", type="string")
 * @ORM\DiscriminatorMap({"animal" = "Animal", "dog" = "Dog", "cat" = "Cat"})
 */
class Animal
{
    /**
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="UUID")
     * @ORM\Column(name="id", type="guid")
     */
    protected $id;

    /**
     * @ORM\Column(type="string")
     */
    protected $name;
}