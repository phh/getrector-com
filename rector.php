<?php

declare(strict_types=1);

use Rector\Config\RectorConfig;
use Rector\PHPUnit\Set\PHPUnitSetList;
use Rector\Privatization\Rector\Class_\FinalizeClassesWithoutChildrenRector;
use Rector\Set\ValueObject\LevelSetList;
use Rector\Set\ValueObject\SetList;

return static function (RectorConfig $rectorConfig): void {
    $rectorConfig->paths([__DIR__ . '/config', __DIR__ . '/src', __DIR__ . '/tests', __DIR__ . '/routes']);

    $rectorConfig->importNames();

    $rectorConfig->sets([
        PHPUnitSetList::PHPUNIT_100,
        SetList::DEAD_CODE,
        SetList::CODE_QUALITY,
        SetList::CODING_STYLE,
        SetList::NAMING,
        SetList::PRIVATIZATION,
        SetList::TYPE_DECLARATION,
        LevelSetList::UP_TO_PHP_81,
    ]);

    $rectorConfig->skip([
        '*/Fixture/*',
        '*/Expected/*',
        // on purpose
        // fix date time on master
        \Rector\Naming\Rector\Class_\RenamePropertyToMatchTypeRector::class,

        // keep FQN names to avoid scoping
        \Rector\Php55\Rector\String_\StringClassNameToClassConstantRector::class => [__DIR__ . '/utils/Rector'],
    ]);

    $rectorConfig->rule(FinalizeClassesWithoutChildrenRector::class);
};
