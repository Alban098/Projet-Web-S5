<?php


namespace DAOs;


use connection\Connection;
use entities\Category;
include "entities/Category.php";

class CategoryDAO extends DAO
{

    private static $instance;

    private static function createInstance(){
        self::$instance = new CategoryDAO();
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
        $query = $bdd->prepare("SELECT * FROM Categories;");
        $query->execute();

        $categories = array();
        while ($data = $query->fetch()) {
            array_push($categories, new Category(
                $data['id'],
                $data['name'],
                self::getNbProduct($data['id'])
            ));
        }
        $query->closeCursor();
        return $categories;
    }

    public function findByID($id)
    {
        $bdd = Connection::getConnection();
        $query = $bdd->prepare("SELECT * FROM Categories WHERE id= ?;");
        $query->execute(array($id));
        $data = $query->fetch();
        $query->closeCursor();
        if (isset($data['id'])) {
            return new Category(
                $data['id'],
                $data['name'],
                self::getNbProduct($data['id'])
            );
        }
        return null;
    }

    public static function findByName($name)
    {
        $bdd = Connection::getConnection();
        $query = $bdd->prepare("SELECT * FROM Categories WHERE name= ?;");
        $query->execute(array($name));
        $data = $query->fetch();
        $query->closeCursor();
        if (isset($data['id'])) {
            return new Category(
                $data['id'],
                $data['name'],
                self::getNbProduct($data['id'])
            );
        }
        return null;
    }

    public static function getNbProduct($id) {
        $bdd = Connection::getConnection();
        $query = $bdd->prepare("SELECT COUNT(id) from Products WHERE category=?");
        $query->execute(array($id));
        $data = $query->fetch();
        $query->closeCursor();
        if (isset($data[0])) {
            return $data[0];
        }
        return 0;
    }

    public function insert($entity) {}
}