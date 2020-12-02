<?php
declare(strict_types=1);

namespace Framework\Core\DependencyInjection;

use Framework\Exception\RuntimeException;
use Framework\Security\PasswordManager;
use Framework\Security\PasswordManagerInterface;

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
     * @param string $class_name
     * @return object
     * @throws RuntimeException
     */
    public function get(string $class_name): object
    {
        if (isset($this->services[$class_name])) {
            return $this->services[$class_name];
        }

        try {
            $reflector = new \ReflectionClass($class_name);
            if ($reflector->isInstantiable()) {
                // get class constructor
                $constructor = $reflector->getConstructor();
                if (is_null($constructor)) {
                    // get new instance from class
                    $instance = $reflector->newInstance();
                    $this->set($class_name, $instance);
                    return $instance;
                } else {
                    $parameters = $constructor->getParameters();
                    $dependencies = [];
                    foreach ($parameters as $parameter) {
                        $dependency = $parameter->getClass();
                        $dependencies[] = $this->get($dependency->name);
                    }
                    $instance = $reflector->newInstanceArgs($dependencies);
                    $this->set($class_name, $instance);
                    return $instance;
                }
            } elseif ($reflector->isInterface()) {
                $class_name_impl = preg_replace('/Interface$/', '', $class_name);
                if (class_exists($class_name_impl)) {
                    return $this->get($class_name_impl);
                } else {
                    throw new RuntimeException("Interface implementation {$class_name} is not exist in container.");
                }
            }
        } catch (\Throwable $exception) {
            throw new RuntimeException($exception->getMessage());
        }
        throw new RuntimeException("Class or service {$class_name} is not exist in container.");
    }
}
