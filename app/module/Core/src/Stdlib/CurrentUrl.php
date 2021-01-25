<?php

namespace Core\Stdlib;

use Laminas\Stdlib\RequestInterface;

trait CurrentUrl
{
    public function getUrl(RequestInterface $request): string
    {
        $protocol = $request->getServer('HTTPS') ? 'http://' : 'https://';

        return "{$protocol}{$request->getServer('HTTP_HOST')}";
    }
}