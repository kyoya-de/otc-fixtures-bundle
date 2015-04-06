<?php
namespace Otc\Bundle\FixturesBundle\Composer;

use Composer\Installer\PackageEvent;

class ScriptHandler
{
    public static function updateAppKernel(PackageEvent $event)
    {
        ob_start();
        var_dump($event->getOperation());
        $event->getIO()->write(ob_get_clean(), true);
    }
}
