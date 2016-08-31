<?php

class Comment extends \Phalcon\Mvc\Model
{
    protected $id;
    protected $comment;

    protected function getId()
    {
        return $this->id;
    }

    protected function getComment()
    {
        return $this->comment;
    }
}