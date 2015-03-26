<?php

namespace InternetInvest\MarkupTool;

use Composer\Script\Event;
use Composer\Installer\PackageEvent;

class Configuration 
{
    public static function postPackageInstall(PackageEvent $event)
    {
        $installedPackage = $event->getOperation()->getPackage();
        // do stuff
        $rootDir = getcwd();
        mkdir($rootDir . '/views');
    }
} 