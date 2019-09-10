<?php
declare(strict_types=1);

namespace Controller;

use Core\Controller;
use Core\Core;
use Exception\AccessDeniedException;
use Model\UserModel;

class IndexController extends Controller
{
    /** @var UserModel */
    protected $userModel;

    /**
     * IndexController constructor.
     * @param UserModel $userModel
     */
    public function __construct(UserModel $userModel)
    {
        $this->userModel = $userModel;
    }

    /**
     * @return \Response\Response
     */
    public function indexAction()
    {
        $users = $this->getCache()->getCache('users');

        if (!$users) {
            $users = $this->userModel->getAll();
            $this->getCache()->setCache('users', $users, 10);
        }
        $params = array(
            'users' => $users,
            'auth' => $this->isAuth()
        );
        return $this->renderView("index", $params);
    }

    public function jsonAction()
    {
        $users = $this->getCache()->getCache('users');
        if (!$users) {
            $users = $this->userModel->getAll();
            $this->getCache()->setCache('users', $users, 10);
        }

        $usersJson = json_encode($users);
        return $this->renderView("json", $usersJson, 'application/json', true);
    }

    /**
     * @param $id
     * @return \Response\Response
     */
    public function userAction($id)
    {
        $user = $this->userModel->getById($id);
        if (!$this->isAuth()) {
            Core::redirect("/index.php/index/login");
        }
        return $this->renderView("user", $user);
    }

    /**
     * @return \Response\Response
     */
    public function loginAction()
    {
        if ($this->isAuth()) {
            Core::redirect("/index.php/index/index");
        }

        if (!empty($_POST['login']) && !empty($_POST['password'])) {
            $user = $this->userModel->getUserByLoginPassword($_POST['login'], $_POST['password']);

            if ($user) {
                $this->setAuth($user->login);
                set_flash_message(t('Success login'));
                Core::redirect("/index.php/index/index");
            }
            set_flash_message(t('Invalid login data'));
        }
        return $this->renderView("login");
    }

    /**
     * @return \Response\Response
     */
    public function logoutAction()
    {
        $this->destroyAuth();
        return $this->renderView("logout");
    }

    /**
     * @return \Response\Response
     * @throws AccessDeniedException
     */
    public function insertAction()
    {
        if (!$this->isAuth()) {
            throw new AccessDeniedException();
        }

        if (isset($_POST['login']) && isset($_POST['password'])) {
            $id = $this->userModel->addUser($_POST['login'], $_POST['password']);
            $this->getCache()->dropByKey('users');
            Core::redirect("/index.php/index/index");
        }
        return $this->renderView("insert");
    }
}

