<?php

namespace Config;

use Doctrine\ORM\EntityManager;
use Symfony\Component\DependencyInjection\ContainerBuilder;
use Symfony\Component\DependencyInjection\Reference;
use ReflectionClass;
use Symfony\Component\Finder\Finder;

class Kernel {
    private ContainerBuilder $container;

    public function __construct(EntityManager $entityManager) {
        $this->container = new ContainerBuilder();

        $this->container->set(EntityManager::class, $entityManager);

        $this->registerServices();
    }

    public function getContainer(): ContainerBuilder {
        return $this->container;
    }

    // Automatically register classes from Models, Services, Repositories ans Controllers folder
    private function registerServices(): void {
        $directories = [
            'Repositories' => 'App\Repositories',
            'Services' => 'App\Services',
            'Models' => 'App\Models',
            'Controllers' => 'App\Controllers'
        ];

        foreach ($directories as $folder => $namespace) {
            $this->registerFromDirectory(rootPath() . "/src/$folder", $namespace);
        }
    }

    private function registerFromDirectory(string $path, string $namespace): void {
        if (! is_dir($path)) {
            return;
        }

        $finder = new Finder();

        $finder->files()->in($path)->name('*.php');

        foreach ($finder as $file) {
            
            $relativePath = str_replace([$path, '/', '.php'], ['', '\\', ''], $file->getRealPath());

            $className = $namespace . $relativePath;

            if (! class_exists($className)) {
                continue;
            }

            $reflection = new ReflectionClass($className);

            $constructor = $reflection->getConstructor();

            $dependencies = [];

            if ($constructor) {
                foreach ($constructor->getParameters() as $param) {
                    $type = $param->getType();
    
                    if ($this->isValidType($type)) {
                        $dependencies[] = new Reference($type->getName());
                    }
                }
            }

            $this->container->register($className, $className)->setArguments($dependencies);

            // If is an Interface, create alias for implementaion
            foreach ($reflection->getInterfaces() as $interface) {
                $this->container->setAlias($interface->getName(), $className);
            }

            $definition = $this->container->register($className, $className);
            
            foreach ($dependencies as $dependency) {
                $definition->addArgument($dependency);
            }
        }
    }

    private function isValidType(object $type): bool {
        return $type && ! $type->isBuiltin();
    }

    public function get(string $id) {
        return $this->container->get($id);
    }
}
