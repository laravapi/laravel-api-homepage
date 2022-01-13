<?php

namespace App\Actions;

use App\Models\Service;
use phpDocumentor\Reflection\DocBlockFactory;
use ReflectionMethod;
use ReflectionParameter;

class ParseWrapper
{
    protected $internalMethods = ['__call', 'boot', 'config'];

    public function execute(Service $service)
    {
        shell_exec('composer require ' . $service->package);

        $factory  = DocBlockFactory::createInstance();

        $definitionClass = $this->loadDefinitionClass($service->definition);

        $reflector = new \ReflectionClass($definitionClass);

        $methods = collect($reflector->getMethods())
            ->filter(fn(ReflectionMethod $method) => !in_array($method->name, $this->internalMethods))
            ->map(function(ReflectionMethod $method) use ($factory) {
                $docblock = $factory->create($method->getDocComment());

                return [
                    'name' => $method->getShortName(),
                    'summary' => $docblock->getSummary(),
                    'description' => $docblock->getDescription()->render(),
                    'parameters' => collect($method->getParameters())->map(function(ReflectionParameter $parameter) {
                        return [
                            'name' => $parameter->getName(),
                            'typeHint' => $parameter->getType()->getName(),
                        ];
                    })->toArray(),
                ];
            })->values();

        $envKeys = collect($definitionClass->config())
            ->mapWithKeys(fn($configItem, $envKey) => [$envKey => $configItem['description']])
            ->toArray();

        $service->update([
            'documentation' => [
                'env' => $envKeys,
                'methods' => $methods,
            ],
        ]);

        shell_exec('composer remove ' . $service->package);
    }

    private function loadDefinitionClass($definitionClass)
    {
        if(!class_exists($definitionClass)) {
            $classMap = require base_path('vendor/composer/autoload_classmap.php');
            require $classMap[$definitionClass];
        }

        return new $definitionClass;
    }
}
