<?php

namespace App\Exceptions;

use Illuminate\Foundation\Exceptions\Handler as ExceptionHandler;
use Illuminate\Support\ViewErrorBag;
use Symfony\Component\HttpKernel\Exception\HttpExceptionInterface;
use Throwable;

class Handler extends ExceptionHandler
{
    /**
     * A list of exception types with their corresponding custom log levels.
     *
     * @var array<class-string<\Throwable>, \Psr\Log\LogLevel::*>
     */
    protected $levels = [
        //
    ];

    /**
     * A list of the exception types that are not reported.
     *
     * @var array<int, class-string<\Throwable>>
     */
    protected $dontReport = [

    ];

    /**
     * A list of the inputs that are never flashed to the session on validation exceptions.
     *
     * @var array<int, string>
     */
    protected $dontFlash = [
        'current_password',
        'password',
        'password_confirmation',
    ];

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

    /**
     * Override default method.
     * To have separate error page for dashboard and public area.
     */
    protected function renderHttpException(HttpExceptionInterface $e)
    {
        $status = $e->getStatusCode();

        $this->registerErrorViewPaths();

        if (view()->exists($this->getViewName($status))) {
            return response()->view($this->getViewName($status), ['exception' => $e], $status, $e->getHeaders());
        }

        if ($view = $this->getHttpExceptionView($e)) {
            return response()->view($view, [
                'errors' => new ViewErrorBag,
                'exception' => $e,
            ], $e->getStatusCode(), $e->getHeaders());
        }

        return $this->convertExceptionToResponse($e);
    }

    /**
     * Determine what view to show based on route
     *
     * @param int $status
     * @return string
     */
    protected function getViewName($status)
    {
        if (request()->is('dashboard/*')) {
            return "dashboard.errors.{$status}";
        }
    }
}
