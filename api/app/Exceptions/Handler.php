<?php

namespace App\Exceptions;

use Exception;
use Throwable;

use Illuminate\Auth\Access\AuthorizationException;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use Illuminate\Foundation\Exceptions\Handler as ExceptionHandler;
use Illuminate\Validation\ValidationException;
use Spatie\QueryBuilder\Exceptions\InvalidFilterQuery;
use Spatie\QueryBuilder\Exceptions\InvalidSortQuery;
use Symfony\Component\HttpKernel\Exception\MethodNotAllowedHttpException;
use Symfony\Component\HttpKernel\Exception\NotFoundHttpException;
use Symfony\Component\HttpKernel\Exception\UnauthorizedHttpException;

class Handler extends ExceptionHandler
{
    /**
     * A list of the exception types that are not reported.
     *
     * @var array
     */
    protected $dontReport = [
        NotFoundHttpException::class,
    ];

    /**
     * A list of the inputs that are never flashed for validation exceptions.
     *
     * @var array
     */
    protected $dontFlash = [
        'password',
        'password_confirmation',
    ];

    /**
     * Report or log an exception.
     *
     * @param  \Exception  $exception
     * @return void
     */
    public function report(Throwable  $exception)
    {
        parent::report($exception);

        if ($this->shouldReport($exception)) {

        }
    }

    /**
     * Render an exception into an HTTP response.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Exception  $exception
     * @return \Illuminate\Http\Response
     */
    public function render($request, Throwable  $exception)
    {
        switch (get_class($exception)) {
            case NotFoundHttpException::class:
                return response()->json([
                    'message' => 'Not Found',
                    'url' => url()->current()
                ], 404);

            case UnauthorizedHttpException::class:
                return response()->json([
                    'message' => 'Unauthorized'
                ], 401);

            case MethodNotAllowedHttpException::class:
                return response()->json([
                    'message' => 'Method Not Allowed'
                ], 405);

            case ModelNotFoundException::class:
                return response()->json([
                    'message' => 'Item Not Found'
                ], 405);

            case InvalidFilterQuery::class:
            case InvalidSortQuery::class:
                return response()->json([
                    'message' => $exception->getMessage()
                ], 400);

            case ValidationException::class:
                return response()->json([
                    'message' => $exception->getMessage(),
                    'validator' => $exception->validator->messages()
                ], 422);
            case AuthorizationException::class:
                return response()->json([
                    'message' => $exception->getMessage()
                ], 403);

            default:
                return response()->json([
                    'message' => $exception->getMessage()
                ], 500);
        }

        return parent::render($request, $exception);
    }
}
