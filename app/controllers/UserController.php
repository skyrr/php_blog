<?php
/**
 * Created by PhpStorm.
 * User: volodymyr
 * Date: 31.08.16
 * Time: 12:02
 */
class UserController extends \Phalcon\Mvc\Controller
{
    public function loginAction()
    {
//        if ($this->session->has("user_id")) {
//            return $this->response->redirect("/post/index");
//        }
        if ($this->request->isPost()) {
            $email = $this->request->getPost("email");
            $password = $this->request->getPost("password");

            $user = User::findFirst("email = '$email'");
            $user_password = $user->password;

            $user_id = $user->id;
            if ($user) {
                if ($this->security->checkHash($password, $user_password)) {
                    $this->session->set("user_id", $user_id);
                    return $this->dispatcher->forward(["controller" => "post", "action" => "index"]);
                }
            } else {
                $this->view->setVar("error", "Wrong password or email");
            }
        }
    }

    public function signInAction()
    {        if ($this->session->has("user_id")) {
            return $this->response->redirect("/post/index");
        }
        if ($this->request->isPost()) {
            $data = $this->request->getPost();
            $data['password'] = $this->security->hash($this->request->getPost('password'));

            $user = new User();

            $success = $user->create($data);
            if ($success) {
                $this->session->set("user_id", $user->getId());
                return $this->response->redirect("/post/index");
            } else {
                $messages = $user->getMessages();
                if ($messages) {
                    foreach ($messages as $message) {
                        $this->flash->error($message);
                    }
                }
            }
        }
    }

    public function logoutAction()
    {
        if ($this->session->has("user_id")) {
            $this->session->destroy();
        }

        return $this->response->redirect();
    }
    
}