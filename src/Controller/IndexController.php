<?php
declare(strict_types=1);

namespace App\Controller;


use App\Model\UserModel;
use Framework\Core\Controller;
use Framework\Core\Core;
use Framework\Exception\AccessDeniedException;
use Framework\Response\Response;

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
     * @return Response
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

    /**
     * @return Response
     */
    public function jsonAction()
    {
        $users = $this->getCache()->getCache('users');
        if (!$users) {
            $users = $this->userModel->getAll();
            $this->getCache()->setCache('users', $users, 10);
        }

        //presenter
        $usersJson = [];
        foreach ($users as $user) {
            $usersJson[] = [
                'id' => $user->id,
                'login' => $user->login,
            ];
        }

        return $this->renderView("json", json_encode($usersJson), 'application/json', true);
    }

    /**
     * @param $id
     * @return Response
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
     * @return Response
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
     * @return Response
     */
    public function logoutAction()
    {
        $this->destroyAuth();
        return $this->renderView("logout");
    }

    /**
     * @return Response
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

