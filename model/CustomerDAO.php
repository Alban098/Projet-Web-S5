<?php


namespace DAOs;


use connection\Connection;
use entities\Customer;
include "entities/Customer.php";

class CustomerDAO extends DAO
{
    private static $instance;

    private static function createInstance(){
        self::$instance = new CustomerDAO();
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
        $query = $bdd->prepare("SELECT * FROM Customers;");
        $query->execute();

        $customers = array();
        while ($data = $query->fetch()) {
            array_push($customers, new Customer(
                $data['id'],
                $data['forename'],
                $data['surname'],
                $data['phone'],
                $data['email'],
                $data['registered'],
                $data['address']
            ));
        }
        $query->closeCursor();
        return $customers;
    }

    public function findByID($id)
    {
        $bdd = Connection::getConnection();
        $query = $bdd->prepare("SELECT * FROM Customers WHERE id= ?;");
        $query->execute(array($id));
        $data = $query->fetch();
        $query->closeCursor();
        if (isset($data['id'])) {
            return new Customer(
                $data['id'],
                $data['forename'],
                $data['surname'],
                $data['phone'],
                $data['email'],
                $data['registered'],
                $data['address']
            );
        }
        return null;
    }

    public function insert($entity)
    {
        $bdd = Connection::getConnection();
        $query = $bdd->prepare("INSERT INTO Customers VALUES (?, ?, ?, ?, ?, ?, ?);");
        $id = $this->getNextID();
        $query->execute(array($id, $entity->getForename(), $entity->getSurname(), $entity->getPhone(), $entity->getEmail(), $entity->getRegistered(), $entity->getAddress()));
        $entity->setId($id);
        $query->closeCursor();
    }

    public function getNextID() {
        $bdd = Connection::getConnection();
        $query = $bdd->prepare("SELECT MAX(id)+1 from Customers");
        $query->execute();
        $data = $query->fetch();
        $query->closeCursor();
        if (isset($data[0])) {
            return $data[0];
        }
        return 0;
    }
}