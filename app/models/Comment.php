<?php

class Comment extends \Phalcon\Mvc\Model
{
    protected $id;
    protected $user_id;
    protected $post_id;
    protected $content;

    protected function initialize()
    {
        $this->belongsTo('post_id', Comment::class, 'id');

        $this->belongsTo('user_id', User::class, 'id');
    }

    protected function getId()
    {
        return $this->id;
    }

    protected function getUserId()
    {
        return $this->user_id;
    }

    protected function postId()
    {
        return $this->post_id;
    }

    public function getContent()
    {
        return $this->content;
    }

    protected function setUserId($user_id)
    {
        return $this->user_id = $user_id;
    }
}