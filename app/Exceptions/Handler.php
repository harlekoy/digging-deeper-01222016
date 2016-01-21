<?php

namespace App\Exceptions;

use Exception;
use Illuminate\Auth\Access\AuthorizationException;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use Illuminate\Foundation\Exceptions\Handler as ExceptionHandler;
use Illuminate\Foundation\Validation\ValidationException;
use Symfony\Component\HttpKernel\Exception\HttpException;
use Symfony\Component\HttpKernel\Exception\NotFoundHttpException;

class Handler extends ExceptionHandler
{
    /**
     * A list of the exception types that should not be reported.
     *
     * @var array
     */
    protected $dontReport = [
        AuthorizationException::class,
        HttpException::class,
        ModelNotFoundException::class,
        ValidationException::class,
    ];

    /**
     * Report or log an exception.
     *
     * This is a great spot to send exceptions to Sentry, Bugsnag, etc.
     *
     * @param  \Exception  $e
     * @return void
     */
    public function report(Exception $e)
    {
        parent::report($e);
    }

    /**
     * Render an exception into an HTTP response.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Exception  $e
     * @return \Illuminate\Http\Response
     */
    public function render($request, Exception $e)
    {
        if ($e instanceof NotFoundHttpException || $e instanceof ModelNotFoundException) {
            $msg = $e->getMessage();
            if (starts_with($msg, 'No query results for model')) {
                $start = strrpos($msg, '\\') + 1;
                $end = strrpos($msg, ']') - $start;

                $model = substr($msg, $start, $end);
                return response()->json([
                    'error' => 'No matching ' . $this->camelCaseToWords($model) . ' found'
                ], 404);
            }
        }

        return parent::render($request, $e);
    }

    /**
     * Change camel case format to regular words
     *
     * @param  string $input
     * @return string
     * @author Harlequin Doyon
     */
    private function camelCaseToWords($input) {
        return str_replace('_', ' ', snake_case($input));
    }
}
