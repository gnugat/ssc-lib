<?php

declare(strict_types=1);

use Symplify\MonorepoBuilder\Config\MBConfig;
use Symplify\MonorepoBuilder\Release\ReleaseWorker\PushTagReleaseWorker;
use Symplify\MonorepoBuilder\Release\ReleaseWorker\TagVersionReleaseWorker;

return static function (MBConfig $mbConfig): void {
    $mbConfig->packageDirectories([__DIR__.'/packages']);

    // for `release`
    $mbConfig->workers([
        TagVersionReleaseWorker::class, // `git tag -a <version>`
        PushTagReleaseWorker::class, // `git push --tags
    ]);
};
