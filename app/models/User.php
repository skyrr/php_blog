<?php

class User extends \Phalcon\Mvc\Model
{
    protected $id;
    protected $name;
    protected $email;
    protected $password;

    public function getId()
    {
        return $this->id;
    }

    public function getName()
    {
        return $this->name;
    }

    public function getEmail()
    {
        return $this->email;
    }

    public function getPassword()
    {
        return $this->password;
    }
}