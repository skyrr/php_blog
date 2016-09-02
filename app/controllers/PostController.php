<?php
/**
 * Created by PhpStorm.
 * User: volodymyr
 * Date: 17.08.16
 * Time: 15:35
 */
class PostController extends \Phalcon\Mvc\Controller
{
    protected $user_id;

    public function beforeExecuteRoute()
    {
        $user_id = $this->session->get("user_id");
        $user = User::findFirst($user_id);
        $this->user_id = $user->getId();
        $this->view->setVar('user', $this->user);
    }

    public function indexAction()
    {
        $posts = Post::find();
        $this->view->posts = $posts;
        $user_id = $this->session->get("user_id");
        if ($user_id) {
            $this->user_id = $user_id;
            $this->user = User::findFirst($user_id);
        }

        $this->view->setVar('user', $this->user);
        $this->view->user_id = $this->user_id;
    }

    public function showAction()
    {

    }

    public function createAction()
    {
        if ($this->request->isPost()) {

            $data = $this->request->getPost();
            $post = new Post(["user_id" => $this->user_id]);
            $success = $post->create($data);
            if ($success) {
                echo "Запис створено!";
            } else {
                echo "Error!";
            }
        }
    }

    public function commentAction()
    {
        $id = $this->dispatcher->getParam('id');
        $post = Post::findFirst($id);
        $this->view->post = $post;
    }
}
