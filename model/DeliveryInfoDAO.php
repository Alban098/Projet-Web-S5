<?php


namespace DAOs;


use connection\Connection;
use entities\DeliveryInfo;
include "entities/DeliveryInfo.php";


class DeliveryInfoDAO extends DAO
{

    private static $instance;

    private static function createInstance(){
        self::$instance = new DeliveryInfoDAO();
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
        $query = $bdd->prepare("SELECT * FROM DeliveryInfos;");
        $query->execute();

        $addresses = array();
        while ($data = $query->fetch()) {
            array_push($addresses, new DeliveryInfo(
                $data['id'],
                $data['forename'],
                $data['surname'],
                $data['address'],
                $data['city'],
                $data['postcode'],
                $data['phone'],
                $data['email']
            ));
        }
        $query->closeCursor();
        return $addresses;
    }

    public function findByID($id)
    {
        $bdd = Connection::getConnection();
        $query = $bdd->prepare("SELECT * FROM DeliveryInfos WHERE id= ?;");
        $query->execute(array($id));
        $data = $query->fetch();
        $query->closeCursor();
        if (isset($data['id'])) {
            return new DeliveryInfo(
                $data['id'],
                $data['forename'],
                $data['surname'],
                $data['address'],
                $data['city'],
                $data['postcode'],
                $data['phone'],
                $data['email']
            );
        }
        return null;
    }

    public function insert($entity)
    {
        $bdd = Connection::getConnection();
        $query = $bdd->prepare("INSERT INTO DeliveryInfos VALUES (?, ?, ?, ?, ?, ?, ?, ?);");
        $id = $this->getNextID();
        $query->execute(array($id, $entity->getForename(), $entity->getSurname(), $entity->getAddress(), $entity->getCity(), $entity->getPostCode(), $entity->getPhone(), $entity->getEmail()));
        $entity->setId($id);
        $query->closeCursor();
    }

    public function getNextID() {
        $bdd = Connection::getConnection();
        $query = $bdd->prepare("SELECT MAX(id)+1 from DeliveryInfos");
        $query->execute();
        $data = $query->fetch();
        $query->closeCursor();
        if (isset($data[0])) {
            return $data[0];
        }
        return 0;
    }
}