<?php
namespace controller;

use app\core\Controller;
use app\core\Core;
use model\UserModel;

class IndexController extends Controller
{

    public function __construct()
    {
        parent::__construct();
    }

    public function indexAction()
    {
        $u = new UserModel();
        $users = $this->cache->getCache('users');
        if (!$users) {
            $users = $u->getAll();
            $this->cache->setCache('users', $users, 10);
        }
        $params = array(
            'users' => $users,
            'auth' => $this->isAuth()
        );
        return $this->renderView("index", $params);
    }

    public function jsonAction()
    {
        $u = new UserModel();
        $users = $this->cache->getCache('users');
        if (!$users) {
            $users = $u->getAll();
            $this->cache->setCache('users', $users, 10);
        }

        $usersJson = json_encode($users);
        return $this->renderView("json", $usersJson, 'application/json', true);
    }

    public function userAction($id)
    {
        $u = new UserModel();
        $user = $u->getById($id);
        if (!$this->isAuth()) {
            Core::redirect("/index.php/index/login");
        }
        return $this->renderView("user", $user);
    }

    public function loginAction()
    {
        if ($this->isAuth()) {
            Core::redirect("/index.php/index/index");
        }

        if (!empty($_POST['login']) && !empty($_POST['password'])) {
            $u = new UserModel();
            $user = $u->getUserByLoginPassword($_POST['login'], $_POST['password']);

            if ($user) {
                $this->setAuth($user->login);
                Core::redirect("/index.php/index/index");
            }
        }
        return $this->renderView("login");
    }

    public function logoutAction()
    {
        $this->destroyAuth();
        return $this->renderView("logout");
    }

    public function insertAction()
    {
        if (!$this->isAuth()) {
            Core::redirect("/index.php/index/login");
        }

        if (isset($_POST['login']) && isset($_POST['password'])) {
            $u = new UserModel();
            $id = $u->addUser($_POST['login'], $_POST['password']);
            $this->cache->dropByKey('users');
            Core::redirect("/index.php/index/login");
        }
        return $this->renderView("insert");
    }
}

