<?php


namespace DAOs;


abstract class DAO
{
    public abstract function findAll();

    public abstract function findByID($id);

    public abstract function insert($entity);
}