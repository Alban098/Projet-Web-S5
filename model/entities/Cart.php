<?php


namespace entities;


class Cart
{
    private $items;

    /**
     * Cart constructor.
     */
    public function __construct()
    {
        $this->items = array();
    }

    public function add($product, $qty) {
        if (isset($this->items[$product->getId()]))
            $this->items[$product->getId()] = array($product, $this->items[$product->getId()][1] + $qty);
        else
            $this->items[$product->getId()] = array($product, $qty);
        if ($this->items[$product->getId()][1] <= 0)
            unset($this->items[$product->getId()]);
    }

    public function set($product, $qty) {
        if ($qty > 0)
            $this->items[$product->getId()] = array($product, $qty);
        else
            unset($this->items[$product->getId()]);
    }

    public function remove($product) {
        if (isset($this->items[$product->getId()]))
            unset($this->items[$product->getId()]);
    }

    public function getTotal() {
        $total = 0;
        foreach ($this->items as $item) {
            $total += $item[0]->getPrice() * $item[1];
        }
        return $total;
    }

    public function getNbProducts() {
        $total = 0;
        foreach ($this->items as $item) {
            $total += $item[1];
        }
        return $total;
    }

    public function isEmpty() {
        return count($this->items) == 0;
    }

    /**
     * @return mixed
     */
    public function getItems()
    {
        return $this->items;
    }

    /**
     * @param mixed $items
     */
    public function setItems($items)
    {
        $this->items = $items;
    }
}