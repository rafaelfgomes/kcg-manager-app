<?php

namespace App\Core;

use Symfony\Component\DependencyInjection\ContainerBuilder;
use Symfony\Component\DependencyInjection\Reference;
use RecursiveDirectoryIterator;
use RecursiveIteratorIterator;
use ReflectionClass;
use SplFileInfo;

class Kernel {
    private ContainerBuilder $container;

    public function __construct() {
        $this->container = new ContainerBuilder();

        $this->registerServices();
    }

    public function getContainer(): ContainerBuilder {
        return $this->container;
    }

    //Automatically register classes from Models, Services, Repositories ans Controllers folder
    private function registerServices() {
        // Auto register Models
        $this->registerNamespace(__DIR__ . '/../Models', 'App\\Models');
        
        //  Auto register Services
        $this->registerNamespace(__DIR__ . '/../Services', 'App\\Services');
        
        //  Auto register Repositories
        $this->registerNamespace(__DIR__ . '/../Repositories', 'App\\Repositories');
        
        //  Auto register Web Controllers
        $this->registerNamespace(__DIR__ . '/../Controllers', 'App\\Controllers');
    }

    private function registerNamespace(string $directory, string $namespace): void {
        if (! is_dir($directory)) {
            return;
        }

        $iterator = new RecursiveIteratorIterator(new RecursiveDirectoryIterator($directory));

        foreach ($iterator as $file) {
            if (! $this->isValidFile($file)) {
                continue;
            }

            $relativePath = str_replace([$directory, '/', '\\'], ['', '\\', '\\'], $file->getPathname());
                
            $className = $namespace . str_replace('.php', '', $relativePath);

            if (! class_exists($className)) {
                continue;
            }

            $reflection = new ReflectionClass($className);

            $constructor = $reflection->getConstructor();

            if (! $constructor) {
                $this->container->register($className, $className);

                continue;
            }

            $dependencies = [];

            foreach ($constructor->getParameters() as $param) {
                $type = $param->getType();

                if ($this->isValidType($type)) {
                    $dependencies[] = new Reference($type->getName());
                }
            }

            $definition = $this->container->register($className, $className);
            
            foreach ($dependencies as $dependency) {
                $definition->addArgument($dependency);
            }
        }
    }

    private function isValidFile(SplFileInfo $file): bool {
        return $file->isFile() && pathinfo($file, PATHINFO_EXTENSION) === 'php';
    }

    private function isValidType(object $type): bool {
        return $type && ! $type->isBuiltin();
    }
}
