<?php


namespace entities;


class Product
{
    private $id;
    private $category;
    private $name;
    private $desc;
    private $img;
    private $price;
    private $rating;

    /**
     * Product constructor.
     * @param $id integer
     * @param $category Category
     * @param $name string
     * @param $desc string
     * @param $img string
     * @param $price float
     * @param $rating int
     */
    public function __construct($id, $category, $name, $desc, $img, $price, $rating)
    {
        $this->id = $id;
        $this->category = $category;
        $this->name = $name;
        $this->desc = $desc;
        $this->img = $img;
        $this->price = $price;
        $this->rating = $rating;
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
    public function getCategory()
    {
        return $this->category;
    }

    /**
     * @param mixed $category
     */
    public function setCategory($category)
    {
        $this->category = $category;
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
    public function getDesc()
    {
        return $this->desc;
    }

    /**
     * @param mixed $desc
     */
    public function setDesc($desc)
    {
        $this->desc = $desc;
    }

    /**
     * @return mixed
     */
    public function getImg()
    {
        if (file_exists("assets/img/products/".$this->img))
            return $this->img;
        return "dummy.jpg";
    }

    /**
     * @param mixed $img
     */
    public function setImg($img)
    {
        $this->img = $img;
    }

    /**
     * @return mixed
     */
    public function getPrice()
    {
        return $this->price;
    }

    /**
     * @param mixed $price
     */
    public function setPrice($price)
    {
        $this->price = $price;
    }

    /**
     * @return mixed
     */
    public function getRating()
    {
        return $this->rating;
    }

    /**
     * @param mixed $rating
     */
    public function setRating($rating)
    {
        $this->rating = $rating;
    }


}