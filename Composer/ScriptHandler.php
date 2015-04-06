<?php
namespace Otc\Bundle\FixturesBundle\Composer;

use Composer\Script\Event;

class ScriptHandler
{
    public static function updateAppKernel(Event $event)
    {
        ob_start();
        var_dump($event);
        file_put_contents(__DIR__ . '/../../../../../../../install.log', ob_get_clean());
    }
}
