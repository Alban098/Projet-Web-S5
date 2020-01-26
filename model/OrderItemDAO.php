<?php


namespace DAOs;

use connection\Connection;
use entities\OrderItem;
include 'entities/OrderItem.php';

class OrderItemDAO extends DAO
{
    private static $instance;

    private static function createInstance(){
        self::$instance = new OrderItemDAO();
    }

    public static function getInstance() {
        if (!isset(self::$instance)) {
            self::createInstance();
        }
        return self::$instance;
    }

    public function findAll()
    {
        $bdd = Connection::getConnection();
        $query = $bdd->prepare("SELECT * FROM OrderItems;");
        $query->execute();

        $orderItems = array();
        while ($data = $query->fetch()) {
            array_push($orderItems, new OrderItem(
                $data['id'],
                $data['orderId'],
                $data['product'],
                $data['quantity']
            ));
        }
        $query->closeCursor();
        return $orderItems;
    }

    public function findByID($id)
    {
        $bdd = Connection::getConnection();
        $query = $bdd->prepare("SELECT * FROM OrderItems WHERE id= ?;");
        $query->execute(array($id));
        $data = $query->fetch();
        $query->closeCursor();
        if (isset($data['id'])) {
            $orderItem = new OrderItem(
                $data['id'],
                $data['orderId'],
                $data['product'],
                $data['quantity']
            );
            $product = ProductDAO::getInstance()->findById($orderItem->getProductId());
            $orderItem->setProduct($product);
            return $orderItem;
        }
        return null;
    }

    public function findByOrder($orderId)
    {
        $bdd = Connection::getConnection();
        $query = $bdd->prepare("SELECT * FROM OrderItems WHERE orderId= ?;");
        $query->execute(array($orderId));

        $orderItems = array();
        while ($data = $query->fetch()) {
            $orderItem = new OrderItem(
                $data['id'],
                $data['orderId'],
                $data['product'],
                $data['quantity']
            );
            $product = ProductDAO::getInstance()->findById($orderItem->getProductId());
            $orderItem->setProduct($product);
            array_push($orderItems, $orderItem);
        }
        $query->closeCursor();
        return $orderItems;
    }

    public function insert($entity)
    {
        $bdd = Connection::getConnection();
        $query = $bdd->prepare("INSERT INTO OrderItems VALUES (?, ?, ?, ?);");
        $id = $this->getNextID();
        $query->execute(array($id, $entity->getOrder(), $entity->getProductId(), $entity->getQuantity()));
        $entity->setId($id);
        $query->closeCursor();
    }

    public function getNextID() {
        $bdd = Connection::getConnection();
        $query = $bdd->prepare("SELECT MAX(id)+1 from OrderItems");
        $query->execute();
        $data = $query->fetch();
        $query->closeCursor();
        if (isset($data[0])) {
            return $data[0];
        }
        return 0;
    }
}