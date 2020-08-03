<?php

namespace App\Entities;

use Doctrine\ORM\Mapping as ORM;

/**
 * Class Product
 *
 * @ORM\Entity
 * @ORM\Table(name="products")
 */
class Product
{
    /**
     * Product Id
     *
     * @ORM\Id
     * @ORM\Column(type="integer")
     * @ORM\GeneratedValue
     * @var integer
     */
    protected $id;

    /**
     * Product Name
     *
     * @ORM\Column(type="string")
     * @var string
     */
    protected $name;

    /**
     * Get Product ID
     *
     * @return int
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * Get Product Name
     *
     * @return string
     */
    public function getName()
    {
        return $this->name;
    }

    /**
     * Set Product name
     *
     * @param string $name Product name
     *
     * @return void
     */
    public function setName($name)
    {
        $this->name = $name;
    }
}
