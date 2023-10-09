<?php

namespace App\Exceptions;

use Exception;
use Illuminate\Foundation\Exceptions\Handler as ExceptionHandler;

class CustomNotFoundException extends Exception
{
    if ($exception instanceof NotFoundHttpException) {
        return response()->view('errors.404error', [], 404);
    }

    return parent::render($request, $exception);
}
