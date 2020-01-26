<?php


namespace entities;


class OrderItem
{
    private $id;
    private $order;
    private $productId;
    private $quantity;
    private $product;

    /**
     * OrderItem constructor.
     * @param $id int
     * @param $order int
     * @param $product int
     * @param $quantity int
     */
    public function __construct($id, $order, $productId, $quantity)
    {
        $this->id = $id;
        $this->order = $order;
        $this->productId = $productId;
        $this->quantity = $quantity;
        $product = null;
    }

    /**
     * @return int
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * @param int $id
     */
    public function setId($id)
    {
        $this->id = $id;
    }

    /**
     * @return int
     */
    public function getOrder()
    {
        return $this->order;
    }

    /**
     * @param int $order
     */
    public function setOrder($order)
    {
        $this->order = $order;
    }

    /**
     * @return int
     */
    public function getProductId()
    {
        return $this->productId;
    }

    /**
     * @param int $productId
     */
    public function setProductId($productId)
    {
        $this->productId = $productId;
    }

    /**
     * @return int
     */
    public function getQuantity()
    {
        return $this->quantity;
    }

    /**
     * @param int $quantity
     */
    public function setQuantity($quantity)
    {
        $this->quantity = $quantity;
    }

    /**
     * @return mixed
     */
    public function getProduct()
    {
        return $this->product;
    }

    /**
     * @param mixed $product
     */
    public function setProduct($product)
    {
        $this->product = $product;
        $this->productId = $product->getId();
    }



}