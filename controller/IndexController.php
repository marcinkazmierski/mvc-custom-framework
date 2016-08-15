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

        return $this->renderView("index", $users);
    }

    public function jsonAction()
    {
        $u = new UserModel();
        $users = $this->cache->getCache('users');
        if (!$users) {
            $users = $u->getUsers();
            $this->cache->setCache('users', $users, 10);
        }

        return $this->renderView("index", $users, 'application/json');
    }

    public function userAction($id)
    {
        $u = new UserModel();
        $user = $u->getUser((int)$id)->fetch();
        if ($_SESSION['auth'] == FALSE) {
            Core::redirect("/index.php/index/login");
        }
        return $this->renderView("user", $user);
    }

    public function loginAction()
    {

        if (!isset($_POST['login']) || !isset($_POST['password']) && $_SESSION['auth'] == FALSE) {
            return $this->renderView("login");
        } elseif (isset($_POST['login']) && isset($_POST['password']) && $_SESSION['auth'] == FALSE) {
            if (!empty($_POST['login']) && !empty($_POST['password'])) {

                $u = new UserModel();
                $sql = $u->authUser($_POST['login'], $_POST['password']);
                if ((int)$sql > 0) {
                    $_SESSION['user'] = $_POST['login'];
                    $_SESSION['auth'] = TRUE;
                    Core::redirect("/index.php/index/index");
                }
            }
        }

        if (!empty($_SESSION['auth']) && $_SESSION['auth'] == TRUE) {
            Core::redirect("/index.php/index/index");
        } else
            if ($_POST) {
                Core::redirect("/index.php/index/login");
            }
    }

    public function logoutAction()
    {
        $_SESSION['auth'] = FALSE;
        session_destroy();
        return $this->renderView("logout");
    }

    public function insertAction()
    {
        if (isset($_POST['login']) && isset($_POST['password'])) {
            $u = new UserModel();
            $u->addUser($_POST['login'], $_POST['password']);
            Core::redirect("/index.php/index/login");
        }
        return $this->renderView("insert");
    }
}

