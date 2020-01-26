<?php


namespace entities;


class Category
{
    private $id;
    private $name;
    private $nbProducts;

    /**
     * Category constructor.
     * @param $id
     * @param $name
     */
    public function __construct($id, $name, $nbProduct)
    {
        $this->id = $id;
        $this->name = $name;
        $this->nbProducts = $nbProduct;
    }

    /**
     * @return mixed
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * @param mixed $id
     */
    public function setId($id)
    {
        $this->id = $id;
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
    public function setName($name)
    {
        $this->name = $name;
    }

    /**
     * @return mixed
     */
    public function getNbProducts()
    {
        return $this->nbProducts;
    }

    /**
     * @param mixed $nbProducts
     */
    public function setNbProducts($nbProducts)
    {
        $this->nbProducts = $nbProducts;
    }


}