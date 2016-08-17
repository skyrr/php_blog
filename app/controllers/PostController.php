<?php
/**
 * Created by PhpStorm.
 * User: volodymyr
 * Date: 17.08.16
 * Time: 15:35
 */
class PostController extends \Phalcon\Mvc\Controller
{
    public function indexAction()
    {
        $posts = Post::find();
        $this->view->setVar("posts", $posts);

    }

    public function showAction()
    {

    }

    public function createAction()
    {
        if ($this->request->isPost()) {
            $data = $this->request->getPost();
            $post = new Post($data);
            $success = $post->create();
            if ($success) {
                echo "Запис створено!";
            } else {
                echo "Error!";
            }
        }
    }
}
