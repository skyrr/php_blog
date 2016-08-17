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
    protected $title;
    protected $content;
    protected $created_at;

    protected function beforeValidationOnCreate()
    {
        $this->created_at = date("Y-m-d H:i:s");
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
}