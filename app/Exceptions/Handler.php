<?php

namespace App\Exceptions;

use Illuminate\Foundation\Exceptions\Handler as ExceptionHandler;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use Illuminate\Http\Response;
use Symfony\Component\HttpKernel\Exception\NotFoundHttpException;
use Throwable;


class Handler extends ExceptionHandler
{
    /**
     * A list of the exception types that are not reported.
     *
     * @var array<int, class-string<Throwable>>
     */
    protected $dontReport = [
        //
    ];

    /**
     * A list of the inputs that are never flashed for validation exceptions.
     *
     * @var array<int, string>
     */
    protected $dontFlash = [
        'current_password',
        'password',
        'password_confirmation',
    ];


    /**
     * Report the exception.
     *
     * @return bool|null
     */
    public function report(Throwable $e)
    {
        parent::report($e);
    }

    /**
     * Render the exception into an HTTP response.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function render($request, Throwable $e)
    {

        if ($request->expectsJson()) {

            if ($e instanceof ModelNotFoundException) {
                return response()->json([
                    'errors' => 'Article Model not found'
                ], Response::HTTP_NOT_FOUND);
            }

            if ($e instanceof NotFoundHttpException) {
                return response()->json([
                    'errors' => 'Given route is incorrect.'
                ], Response::HTTP_NOT_FOUND);
            }
        }

        // dd($e);
        return parent::render($request, $e);
    }

    /**
     * Register the exception handling callbacks for the application.
     *
     * @return void
     */
    public function register()
    {
        $this->reportable(function (Throwable $e) {
            //
        });
    }
}
