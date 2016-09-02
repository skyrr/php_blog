<?php

class User extends \Phalcon\Mvc\Model
{
    protected $id;
    protected $name;
    protected $email;
    protected $password;

    protected function initialize()
    {
        $this->hasMany(
            'id',
            Comment::class,
            'user_id'
        );

        $this->hasMany(
            'id',
            Post::class,
            'user_id'
        );
    }

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