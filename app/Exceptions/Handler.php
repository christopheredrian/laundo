<?php

namespace App\Exceptions;

use App\Traits\ApiResponser;
use Illuminate\Auth\AuthenticationException;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use Illuminate\Validation\ValidationException;
use Exception;
use Illuminate\Foundation\Exceptions\Handler as ExceptionHandler;
use Symfony\Component\HttpKernel\Exception\HttpException;

class Handler extends ExceptionHandler
{
    use ApiResponser;
    /**
     * A list of the exception types that are not reported.
     *
     * @var array
     */
    protected $dontReport = [
        //
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
     * @param  \Exception $exception
     * @return void
     */
    public function report(Exception $exception)
    {
        parent::report($exception);
    }

    /**
     * Render an exception into an HTTP response.
     *
     * @param  \Illuminate\Http\Request $request
     * @param  \Exception $exception
     * @return \Illuminate\Http\Response
     */
    public function render($request, Exception $exception)
    {

        /**
         *
         * Override exception response for API
         *
         */

        ##################################################
        #             Laravel Specific
        ##################################################

        if ($exception instanceof ValidationException) {
            return $this->convertValidationExceptionToResponse($exception, $request);
        }

        if ($exception instanceof ModelNotFoundException) {
            return $this->errorResponse($exception->getMessage(), 404);
        }

        if ($exception instanceof AuthenticationException) {
            /**
             * Forbidden
             */
            return $this->errorResponse($exception->getMessage(), 401);
        }

        if ($exception instanceof HttpException) {
            return $this->errorResponse($exception->getMessage(), $exception->getStatusCode());
        }

        ##################################################
        #             Php Exceptions
        ##################################################

        if ($exception instanceof \ErrorException) {
            return $this->errorResponse($exception->getMessage(), 500);
        }

        // Append other specific Exception types below


        /**
         *
         * Default
         *
         */
        if (config('app.debug')) {
            /**
             * We only render the message when APP_DEBUG is true
             */
            return parent::render($request, $exception);
        }

        /**
         *
         * Unexpected Exception
         *
         */
        return $this->errorResponse("Unexpected Exception. Try later", 500);

    }

    /**
     * Create a response object from the given validation exception.
     *
     * @param  \Illuminate\Validation\ValidationException $e
     * @param  \Illuminate\Http\Request $request
     * @return \Symfony\Component\HttpFoundation\Response
     */
    protected function convertValidationExceptionToResponse(ValidationException $e, $request)
    {

        $errors = $e->validator
            ->errors()
            ->getMessages();

        return $this->validationErrorResponse($errors, 422);
    }
}
