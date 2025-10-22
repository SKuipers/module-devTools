<?php

namespace Gibbon\Module\DevTools;

/**
 * Dev Formats
 */
class DevFormat 
{
    public static function code(string $code): string
    {
        $code = htmlentities($code);

        return <<<HTML
        <code class="rounded-md text-xs bg-gray-200 text-gray-700 p-2">{$code}</code>
        HTML;
    }

    public static function codeBlock(string $code): string
    {
        $code = htmlentities($code);

        return <<<HTML
        <code class="block rounded-md text-xs bg-gray-200 text-gray-700 p-6 mb-3"><pre>{$code}</pre></code>
        HTML;
    }

}
