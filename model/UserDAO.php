<?php


namespace DAOs;


use connection\Connection;
use entities\User;

include "entities/User.php";

class UserDAO extends DAO
{

    private static $instance;

    private static function createInstance(){
        self::$instance = new UserDAO();
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
        $query = $bdd->prepare("SELECT * FROM User;");
        $query->execute();

        $users = array();
        while ($data = $query->fetch()) {
            array_push($users, new User(
                $data['id'],
                $data['customer'],
                $data['username'],
                $data['hash'],
                $data['role']
            ));
        }
        $query->closeCursor();
        return $users;
    }

    public function findByID($id)
    {
        $bdd = Connection::getConnection();
        $query = $bdd->prepare("SELECT * FROM User WHERE id= ?;");
        $query->execute(array($id));
        $data = $query->fetch();
        $query->closeCursor();
        if (isset($data['id'])) {
            return new User(
                $data['id'],
                $data['customer'],
                $data['username'],
                $data['hash'],
                $data['role']
            );
        }
        return null;
    }

    public function findByUsername($username)
    {
        $bdd = Connection::getConnection();
        $query = $bdd->prepare("SELECT * FROM User WHERE username= ?;");
        $query->execute(array($username));
        $data = $query->fetch();
        $query->closeCursor();
        if (isset($data['id'])) {
            return new User(
                $data['id'],
                $data['customer'],
                $data['username'],
                $data['hash'],
                $data['role']
            );
        }
        return null;
    }

    public function insert($entity)
    {
        $bdd = Connection::getConnection();
        $query = $bdd->prepare("INSERT INTO user VALUES (?, ?, ?, ?, ?);");
        $id = $this->getNextID();
        $query->execute(array($id, $entity->getCustomer(), $entity->getUsername(), $entity->getHash(), $entity->getRole()));
        $query->closeCursor();
        $entity->setId($id);
    }

    public function getNextID() {
        $bdd = Connection::getConnection();
        $query = $bdd->prepare("SELECT MAX(id)+1 from User");
        $query->execute();
        $data = $query->fetch();
        $query->closeCursor();
        if (isset($data[0])) {
            return $data[0];
        }
        return 0;
    }
}