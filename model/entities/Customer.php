<?php


namespace entities;


class Customer
{
    private $id;
    private $forename;
    private $surname;
    private $phone;
    private $email;
    private $registered;
    private $address;

    /**
     * Customer constructor.
     * @param $id int
     * @param $forename string
     * @param $surname string
     * @param $phone int
     * @param $email string
     * @param $registered bool
     * @param $address int
     */
    public function __construct($id, $forename, $surname, $phone, $email, $registered, $address)
    {
        $this->id = $id;
        $this->forename = $forename;
        $this->surname = $surname;
        $this->phone = $phone;
        $this->email = $email;
        $this->registered = $registered;
        $this->address = $address;
    }

    /**
     * @return mixed
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * @param mixed $id
     */
    public function setId($id)
    {
        $this->id = $id;
    }

    /**
     * @return mixed
     */
    public function getForename()
    {
        return $this->forename;
    }

    /**
     * @param mixed $forename
     */
    public function setForename($forename)
    {
        $this->forename = $forename;
    }

    /**
     * @return mixed
     */
    public function getSurname()
    {
        return $this->surname;
    }

    /**
     * @param mixed $surname
     */
    public function setSurname($surname)
    {
        $this->surname = $surname;
    }

    /**
     * @return mixed
     */
    public function getPhone()
    {
        return $this->phone;
    }

    /**
     * @param mixed $phone
     */
    public function setPhone($phone)
    {
        $this->phone = $phone;
    }

    /**
     * @return mixed
     */
    public function getEmail()
    {
        return $this->email;
    }

    /**
     * @param mixed $email
     */
    public function setEmail($email)
    {
        $this->email = $email;
    }

    /**
     * @return mixed
     */
    public function getRegistered()
    {
        return $this->registered;
    }

    /**
     * @param mixed $registered
     */
    public function setRegistered($registered)
    {
        $this->registered = $registered;
    }

    /**
     * @return mixed
     */
    public function getAddress()
    {
        return $this->address;
    }

    /**
     * @param mixed $addresses
     */
    public function setAddress($address)
    {
        $this->address = $address;
    }
}