<?php
/**
 * Created by PhpStorm.
 * User: volodymyr
 * Date: 17.08.16
 * Time: 15:51
 */
class Post extends \Phalcon\Mvc\Model
{
    protected $id;
    protected $user_id;
    protected $title;
    protected $content;
    protected $created_at;
    protected $updated_at;

    protected function beforeValidationOnCreate()
    {
        $this->created_at = date("Y-m-d H:i:s");
        $this->updated_at = date("Y-m-d H:i:s");
    }

    protected function initialize()
    {
        $this->hasMany(
            'id',
            Comment::class,
            'post_id'
        );

        $this->belongsTo('user_id', User::class, 'id');
    }

    public function getId()
    {
        return $this->id;
    }

    public function getTitle()
    {
        return $this->title;
    }

    public function getContent()
    {
        return $this->content;
    }

    public function getCreatedAt()
    {
        return $this->created_at;
    }

    public function getUpdatedAt()
    {
        return $this->updated_at;
    }
}