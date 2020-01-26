<?php


namespace DAOs;


use connection\Connection;
use entities\Product;
include "entities/Product.php";

class ProductDAO extends DAO
{
    private static $instance;

    private static function createInstance(){
        self::$instance = new ProductDAO();
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
        $query = $bdd->prepare("SELECT * FROM Products;");
        $query->execute();
        $categoryDAO = new CategoryDAO();

        $products = array();
        while ($data = $query->fetch()) {
            $category = $categoryDAO->findByID($data['category']);
            array_push($products, new Product(
                $data['id'],
                $category,
                $data['name'],
                $data['description'],
                $data['img'],
                $data['price'],
                $data['rating']
            ));
        }
        $query->closeCursor();
        return $products;
    }

    public function findByCat($category)
    {
        $bdd = Connection::getConnection();
        $query = $bdd->prepare("SELECT * FROM Products WHERE category= ?;");
        $query->execute(array($category->getID()));
        $products = array();
        while ($data = $query->fetch()) {
            array_push($products, new Product(
                $data['id'],
                $category,
                $data['name'],
                $data['description'],
                $data['img'],
                $data['price'],
                $data['rating']
            ));
        }
        $query->closeCursor();
        return $products;
    }


    public function findByID($id)
    {
        $bdd = Connection::getConnection();
        $query = $bdd->prepare("SELECT * FROM Products WHERE id= ?;");
        $query->execute(array($id));
        $data = $query->fetch();
        $query->closeCursor();
        if (isset($data['id'])) {
            $categoryDAO = new CategoryDAO();
            $category = $categoryDAO->findByID($data['category']);
            return new Product(
                $data['id'],
                $category,
                $data['name'],
                $data['description'],
                $data['img'],
                $data['price'],
                $data['rating']
            );
        }
        return null;
    }

    public function getCount() {
        $bdd = Connection::getConnection();
        $query = $bdd->prepare("SELECT Count(id) from Products");
        $query->execute();
        $data = $query->fetch();
        $query->closeCursor();
        if (isset($data[0])) {
            return $data[0];
        }
        return 0;
    }

    public function insert($entity) {}
}