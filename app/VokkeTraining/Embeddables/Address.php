<?php

namespace App\VokkeTraining\Embeddables\Address;

use Doctrine\ORM\Mapping AS ORM;

/**
 * @ORM\Embeddable
 */
class Address
{
    /**
     * @ORM\@Column(type="string")
     */
    private $street;

    /**
     * @ORM\@Column(type="string")
     */
    private $postalCode;

    /**
     * @ORM\@Column(type="string")
     */
    private $city;

    /**
     * @ORM\@Column(type="string")
     */
    private $country;


    /**
     * @return mixed
     */
    public function getCompleteAddress()
    {
        return $this->getStreet() . ", " . $this->getCity() . ", " . $this->getCountry() . ", " . $this->getPostalCode();
    }

    /**
     * @return mixed
     */
    public function getStreet()
    {
        return $this->street;
    }

    /**
     * @param mixed $street
     */
    public function setStreet($street): void
    {
        $this->street = $street;
    }

    /**
     * @return mixed
     */
    public function getPostalCode()
    {
        return $this->postalCode;
    }

    /**
     * @param mixed $postalCode
     */
    public function setPostalCode($postalCode): void
    {
        $this->postalCode = $postalCode;
    }

    /**
     * @return mixed
     */
    public function getCity()
    {
        return $this->city;
    }

    /**
     * @param mixed $city
     */
    public function setCity($city): void
    {
        $this->city = $city;
    }

    /**
     * @return mixed
     */
    public function getCountry()
    {
        return $this->country;
    }

    /**
     * @param mixed $country
     */
    public function setCountry($country): void
    {
        $this->country = $country;
    }

}