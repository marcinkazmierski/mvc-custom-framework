<?php
namespace controller;

use app\core\Controller;
use app\core\Core;
use model\User;

class IndexController extends Controller
{

    public function __construct()
    {
        parent::__construct();
    }


    public function indexAction()
    {
        $u = new User();
        $users = $u->getUsers();
        print $this->renderView("index", $users);
        $users->closeCursor(); // close PDO
    }

    public function userAction($id)
    {
        $u = new User();
        $user = $u->getUser((int)$id)->fetch();
        if ($_SESSION['auth'] == FALSE) {
            Core::redirect("/index.php/index/login");
        }
        print $this->renderView("user", $user);
    }

    public function loginAction()
    {

        if (!isset($_POST['login']) || !isset($_POST['password']) && $_SESSION['auth'] == FALSE) {
            print $this->renderView("login");
        } elseif (isset($_POST['login']) && isset($_POST['password']) && $_SESSION['auth'] == FALSE) {
            if (!empty($_POST['login']) && !empty($_POST['password'])) {

                $u = new User();
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
        print $this->renderView("logout");
    }

    public function insertAction()
    {
        if (isset($_POST['login']) && isset($_POST['password'])) {
            $u = new User();
            $u->addUser($_POST['login'], $_POST['password']);
            Core::redirect("/index.php/index/login");
        }
        print $this->renderView("insert");
    }
}

