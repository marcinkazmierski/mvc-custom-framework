<?php
declare(strict_types = 1);

namespace Controller;

use Core\Controller;
use Core\Core;
use Cqrs\Command\Command\CreateUserCommand;
use Cqrs\Command\CommandBus\CommandBus;
use Cqrs\Command\CommandBus\SimpleCommandBus;
use Cqrs\Command\CommandHandler\CreateUserHandler;
use Cqrs\Command\Repository\UserRepository;
use Cqrs\Query\Query\UserQuery;
use Model\Command\UserRepositoryImpl;
use Model\Query\UserQueryImpl;
use Cqrs\ValueObject\Email;
use Cqrs\ValueObject\UserName;
use Exception\AccessDeniedException;


class IndexController extends Controller
{
    /** @var userQuery */
    protected $userQuery;

    /** @var  CommandBus */
    protected $commandBus;

    /** @var UserRepository */
    protected $userRepository;

    public function __construct()
    {
        // TODO: DI
        $this->userQuery = new UserQueryImpl();
        $this->commandBus = new SimpleCommandBus();
        $this->userRepository = new UserRepositoryImpl();

        //TODO: Command register
        $createUserHandler = new CreateUserHandler($this->userRepository);
        $this->commandBus->registerHandler(CreateUserCommand::class, $createUserHandler);

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
        // Query
        // TODO: from cache
        $users = $this->userQuery->getAllUsers();

        // Command
        $email = new Email('test@testtest.pl');
        $username = new UserName('ewa_' . rand());
        $command = new CreateUserCommand($email, $username);
        $this->commandBus->handle($command);

        return $this->renderView("users", ['users' => $users]);
    }
}

