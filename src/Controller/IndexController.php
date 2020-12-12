<?php
declare(strict_types=1);

namespace App\Controller;

use App\Model\UserModel;
use Framework\Core\Controller;
use Framework\Core\Core;
use Framework\Exception\AccessDeniedException;
use Framework\Exception\RuntimeException;
use Framework\Response\Response;
use Framework\Service\Logger\LoggerInterface;

class IndexController extends Controller
{
    /** @var UserModel */
    protected $userModel;

    /** @var LoggerInterface */
    protected $logger;

    /**
     * IndexController constructor.
     * @param UserModel $userModel
     * @param LoggerInterface $logger
     */
    public function __construct(UserModel $userModel, LoggerInterface $logger)
    {
        $this->userModel = $userModel;
        $this->logger = $logger;
    }

    /**
     * @return Response
     * @throws RuntimeException
     */
    public function indexAction()
    {
        $users = $this->getCache()->getCache('users');

        if (!$users) {
            $users = $this->userModel->getAll();
            $this->getCache()->setCache('users', $users, 10);
        }
        $params = [
            'users' => $users,
            'auth' => $this->isAuth()
        ];
        return $this->renderView("index", $params);
    }

    /**
     * @return Response
     * @throws RuntimeException
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

        return $this->renderView("json", ['json' => json_encode($usersJson)], 'application/json', true);
    }

    /**
     * @param $id
     * @return Response
     * @throws RuntimeException
     */
    public function userAction($id)
    {
        $user = $this->userModel->getById($id);
        if (!$this->isAuth()) {
            Core::redirect("/index.php/index/login");
        }
        return $this->renderView("user", ['user' => $user]);
    }

    /**
     * @return Response
     * @throws RuntimeException
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
            $this->logger->error("Invalid login data", ['login' => $_POST['login']]);
        }
        return $this->renderView("login");
    }

    /**
     * @return Response
     * @throws RuntimeException
     */
    public function logoutAction()
    {
        $this->destroyAuth();
        return $this->renderView("logout");
    }

    /**
     * @return Response
     * @throws AccessDeniedException
     * @throws RuntimeException
     */
    public function insertAction()
    {
        if (!$this->isAuth()) {
            throw new AccessDeniedException();
        }

        //todo: validate
        if (isset($_POST['login']) && isset($_POST['password'])) {
            $id = $this->userModel->addUser($_POST['login'], $_POST['password']);
            $this->getCache()->dropByKey('users');
            Core::redirect("/index.php/index/index");
        }
        return $this->renderView("insert");
    }
}

