<?php
namespace Otc\Bundle\FixturesBundle\Composer;

use Composer\Script\Event;

class ScriptHandler
{
    public static function updateAppKernel(Event $event)
    {
        ob_start();
        var_dump($event);
        $event->getIO()->write(ob_get_clean(), true);
    }
}
