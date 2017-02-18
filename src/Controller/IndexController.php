<?php
declare(strict_types = 1);

namespace Controller;

use Core\Controller;
use Core\Core;
use Cqrs\Query\Query\UserQuery;
use Cqrs\Query\Query\UserQueryImpl;
use Exception\AccessDeniedException;
use Model\UserModel;

class IndexController extends Controller
{
    protected $userQuery;

    public function __construct()
    {
        /** @var userQuery */
        $this->userQuery = new UserModel();
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
                set_flash_message(t('Success login'));
                Core::redirect("/index.php/index/index");
            }
            set_flash_message(t('Invalid login data'));
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
            throw new AccessDeniedException();
        }

        if (isset($_POST['login']) && isset($_POST['password'])) {
            $u = new UserModel();
            $id = $u->addUser($_POST['login'], $_POST['password']);
            $this->cache->dropByKey('users');
            Core::redirect("/index.php/index/index");
        }
        return $this->renderView("insert");
    }

    public function usersAction()
    {
        // Query Command
        $users = $this->userQuery->getAllUsers();
        return $this->renderView("users", ['users' => $users]);
    }
}

