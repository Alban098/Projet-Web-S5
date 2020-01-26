<?php


namespace DAOs;


use connection\Connection;
use entities\Order;
include "entities/Order.php";

class OrderDAO extends DAO
{
    private static $instance;

    private static function createInstance(){
        self::$instance = new OrderDAO();
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
        $query = $bdd->prepare("SELECT * FROM Orders;");
        $query->execute();
        $deliveryInfoDAO = new DeliveryInfoDAO();
        $orderItemDAO = new OrderItemDAO();
        $orders = array();
        while ($data = $query->fetch()) {
            $deliveryInfo = $deliveryInfoDAO->findByID($data['address']);
            $items = $orderItemDAO->findByOrder($data['id']);
            array_push($orders, new Order(
                $data['id'],
                $data['customer'],
                $data['registered'],
                $deliveryInfo,
                $data['payment'],
                $data['date'],
                $data['status'],
                $data['session'],
                $data['total'],
                $items
            ));
        }
        $query->closeCursor();
        return $orders;
    }

    public function findByStatus($status)
    {
        $bdd = Connection::getConnection();
        $query = $bdd->prepare("SELECT * FROM Orders WHERE status=? ORDER BY date DESC, id DESC;");
        $query->execute(array($status));
        $deliveryInfoDAO = new DeliveryInfoDAO();
        $orderItemDAO = new OrderItemDAO();
        $orders = array();
        while ($data = $query->fetch()) {
            $deliveryInfo = $deliveryInfoDAO->findByID($data['address']);
            $items = $orderItemDAO->findByOrder($data['id']);
            array_push($orders, new Order(
                $data['id'],
                $data['customer'],
                $data['registered'],
                $deliveryInfo,
                $data['payment'],
                $data['date'],
                $data['status'],
                $data['session'],
                $data['total'],
                $items
            ));
        }
        $query->closeCursor();
        return $orders;
    }

    public function findByID($id)
    {
        $bdd = Connection::getConnection();
        $query = $bdd->prepare("SELECT * FROM Orders WHERE id= ?;");
        $query->execute(array($id));
        $data = $query->fetch();
        $query->closeCursor();
        if (isset($data['id'])) {
            $deliveryInfoDAO = new DeliveryInfoDAO();
            $orderItemDAO = new OrderItemDAO();
            $deliveryInfo = $deliveryInfoDAO->findByID($data['address']);
            $items = $orderItemDAO->findByOrder($data['id']);
            return new Order(
                $data['id'],
                $data['customer'],
                $data['registered'],
                $deliveryInfo,
                $data['payment'],
                $data['date'],
                $data['status'],
                $data['session'],
                $data['total'],
                $items
            );
        }
        return null;
    }

    public function update($entity) {
        $bdd = Connection::getConnection();
        $query = $bdd->prepare("UPDATE Orders SET customer=?, registered=?, address=?, payment=?, date=?, status=?, session=?, total=? WHERE id= ?;");
        $query->execute(array($entity->getCustomer(), $entity->getRegistered(), $entity->getAddress()->getId(), $entity->getPayment(), $entity->getDate(), $entity->getStatus(), $entity->getSession(), $entity->getTotal(), $entity->getId()));
        $query->closeCursor();
    }

    public function insert($entity)
    {
        $bdd = Connection::getConnection();
        $query = $bdd->prepare("INSERT INTO Orders VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?);");
        $id = $this->getNextID();
        $query->execute(array($id, $entity->getCustomer(), $entity->getRegistered(), $entity->getAddress()->getId(), $entity->getPayment(), $entity->getDate()->format('Y-m-d'), $entity->getStatus(), $entity->getSession(), $entity->getTotal()));
        foreach ($entity->getItems() as $item) {
            $item->setOrder($id);
            OrderItemDAO::getInstance()->insert($item);
        }
        $entity->setId($id);
        $query->closeCursor();
    }

    public function getNextID() {
        $bdd = Connection::getConnection();
        $query = $bdd->prepare("SELECT MAX(id)+1 from Orders");
        $query->execute();
        $data = $query->fetch();
        $query->closeCursor();
        if (isset($data[0])) {
            return $data[0];
        }
        return 0;
    }
}