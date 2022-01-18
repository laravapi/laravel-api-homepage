<?php

namespace App\Actions;

use App\Models\Api;
use Illuminate\Support\Arr;
use Illuminate\Support\Facades\Http;
use phpDocumentor\Reflection\DocBlockFactory;
use ReflectionMethod;
use ReflectionParameter;

class ParseWrapper
{
    protected $internalMethods = ['__call', 'boot', 'config'];

    public function execute(Api $api)
    {
        $api->update(['github' => $this->getGitHubLink($api)]);

        shell_exec('composer require ' . $api->wrapper_package);

        $factory  = DocBlockFactory::createInstance();

        $wrapperClass = $this->loadWrapperClass($api->wrapper_class);

        $reflector = new \ReflectionClass($wrapperClass);

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

        if(property_exists($wrapperClass, 'faker')) {
            $fakeWrapperClass = $wrapperClass->faker;

            $fakeWrapper = $this->loadWrapperFakerClass($fakeWrapperClass);

            foreach ($methods as $index => $method) {
                if (method_exists($fakeWrapper, $method['name'])) {
                    $temp = $methods[$index];
                    $temp['exampleResponse'] = $fakeWrapper->{$method['name']}(1, 2, 3, 4, 5, 6, 7, 8);
                    $methods[$index] = $temp;
                }
            }
        }

        $envKeys = collect($wrapperClass->config())
            ->mapWithKeys(fn($configItem, $envKey) => [$envKey => $configItem['description']])
            ->toArray();

        $api->update([
            'documentation' => [
                'env' => $envKeys,
                'methods' => $methods,
            ],
        ]);

        shell_exec('composer remove ' . $api->wrapper_package);
    }

    private function loadWrapperClass($wrapperClass)
    {
        if(!class_exists($wrapperClass)) {
            $classMap = require base_path('vendor/composer/autoload_classmap.php');
            require $classMap[$wrapperClass];
        }

        return new $wrapperClass;
    }

    private function loadWrapperFakerClass($wrapperClass)
    {
        if(!class_exists($wrapperClass)) {
            $classMap = require base_path('vendor/composer/autoload_classmap.php');
            require $classMap[$wrapperClass];
        }

        return new $wrapperClass;
    }

    private function getGitHubLink(Api $api)
    {
        $packagistInfo = Http::get('https://repo.packagist.org/p2/' . $api->api_package. '.json');

        if($packagistInfo->status() == 200) {
            return Arr::get(Arr::first($packagistInfo->json('packages')), '0.source.url');
        }
    }
}
