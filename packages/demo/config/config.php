<?php

declare(strict_types=1);

use Rector\Website\Demo\HttpKernel\Controller\RectorRunValueResolver;
use Symfony\Component\DependencyInjection\Loader\Configurator\ContainerConfigurator;
use Symplify\SmartFileSystem\SmartFileSystem;

return static function (ContainerConfigurator $containerConfigurator): void {
    $services = $containerConfigurator->services();

    $services->defaults()
        ->public()
        ->autowire()
        ->autoconfigure();

    $services->load('Rector\Website\Demo\\', __DIR__ . '/../src/')
        ->exclude(
            [
                __DIR__ . '/../src/Exception/*',
                __DIR__ . '/../src/Entity/*',
                __DIR__ . '/../src/ValueObject/*',
                __DIR__ . '/../src/Validator/Constraint/*',
            ]
        );

    $services->set(RectorRunValueResolver::class)
        ->tag('controller.argument_value_resolver', ['priority' => 550]);

    $services->set(SmartFileSystem::class);
};
