<?php
/**
 * Created by PhpStorm.
 * User: volodymyr
 * Date: 31.08.16
 * Time: 12:02
 */
class CommentController extends \Phalcon\Mvc\Controller
{
    protected $user_id;


    public function beforeExecuteRoute()
    {
        $user_id = $this->session->get("user_id");
        $user = User::findFirst($user_id);
        $this->user_id = $user->getId();
    }

    public function commentAction()
    {
        $id = $this->dispatcher->getParam('id');
        if ($this->request->isPost()) {
            $data = $this->request->getPost();
            $comment = new Comment(["user_id" => $this->user_id, "post_id" => $id]);
            $success = $comment->create($data);
            if ($success) {
                echo "Коментар створено!";
            } else {
                echo "Помилка!";
            }
        }
        $post = Post::findFirst($id);
        $this->view->post = $post;
        //$comments = Comment::find(["post_id" => $post]);
        $comments = $post->getComment();
        $this->view->comments = $comments;
    }
}