<?php
declare(strict_types=1);

namespace Framework\Core\DependencyInjection;

use Framework\Exception\RuntimeException;
use Framework\Security\PasswordManager;
use Framework\Security\PasswordManagerInterface;
use Framework\Service\Logger\BasicLogger;
use Framework\Service\Logger\LoggerInterface;

class Container implements ContainerInterface
{
    /** @var array */
    protected $services = [];

    /**
     * Container constructor.
     * @throws RuntimeException
     */
    public function __construct()
    {
        // custom DI:
        $this->services[PasswordManagerInterface::class] = $this->get(PasswordManager::class);
        $this->services[LoggerInterface::class] = $this->get(BasicLogger::class);
    }

    /**
     * @param string $id
     * @param object $service
     */
    public function set(string $id, object $service): void
    {
        $this->services[$id] = $service;
    }

    /**
     * @param string $className
     * @return object
     * @throws RuntimeException
     */
    public function get(string $className): object
    {
        if (isset($this->services[$className])) {
            return $this->services[$className];
        }

        try {
            $reflector = new \ReflectionClass($className);
            if ($reflector->isInstantiable()) {
                // get class constructor
                $constructor = $reflector->getConstructor();
                if (is_null($constructor)) {
                    // get new instance from class
                    $instance = $reflector->newInstance();
                    $this->set($className, $instance);
                    return $instance;
                } else {
                    $parameters = $constructor->getParameters();
                    $dependencies = [];
                    foreach ($parameters as $parameter) {
                        $dependency = $parameter->getType();
                        $dependencies[] = $this->get($dependency->getName());
                    }
                    $instance = $reflector->newInstanceArgs($dependencies);
                    $this->set($className, $instance);
                    return $instance;
                }
            } elseif ($reflector->isInterface()) {
                $class_name_impl = preg_replace('/Interface$/', '', $className);
                if (class_exists($class_name_impl)) {
                    return $this->get($class_name_impl);
                } else {
                    throw new RuntimeException("Interface implementation {$className} is not exist in container.");
                }
            }
        } catch (\Throwable $exception) {
            throw new RuntimeException($exception->getMessage());
        }
        throw new RuntimeException("Class or service {$className} is not exist in container.");
    }
}
