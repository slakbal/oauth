<?php

namespace Slakbal\Oauth\Exceptions;

use Exception;
use Illuminate\Support\Facades\Log;

class AuthException extends Exception
{
    public static function providerNotSupported(string $provider): Exception
    {
        $message = __('Possible URL tampering. The `:provider` oauth provider is not supported.', ['provider' => $provider]);

        Log::warning('OAUTH: '.$message);

        return new static($message);
    }
}
