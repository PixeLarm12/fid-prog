<?php

use App\Enums\AbstractEnum;
use App\Jobs\SendMaxPrizePointsEmail;
use App\Util\StringUtil;
use Illuminate\Foundation\Application;
use Illuminate\Foundation\Configuration\Exceptions;
use Illuminate\Foundation\Configuration\Middleware;
use Illuminate\Validation\ValidationException;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpKernel\Exception\BadRequestHttpException;
use Symfony\Component\HttpKernel\Exception\NotFoundHttpException;
use Symfony\Component\HttpKernel\Exception\TooManyRequestsHttpException;
use Symfony\Component\HttpKernel\Exception\UnauthorizedHttpException;
use Symfony\Component\HttpKernel\Exception\UnprocessableEntityHttpException;

return Application::configure(basePath: dirname(__DIR__))
    ->withRouting(
        api: __DIR__.'/../routes/api.php',
        commands: __DIR__.'/../routes/console.php',
        apiPrefix: AbstractEnum::API_ROUTE_PREFIX
    )
    ->withMiddleware(function (Middleware $middleware) {
        // 
    })
    ->withExceptions(function (Exceptions $exceptions) {
        $exceptions->render(function (Throwable $e) {
            $return = (object) [
                'code' => Response::HTTP_INTERNAL_SERVER_ERROR,
                'message' => 'Some unusual error had occurred'
            ];

            if($e instanceof ValidationException) {
                $return->message = StringUtil::getValidationErrorsMessages($e->errors());
                $return->code = $e->status;
            } else if($e instanceof NotFoundHttpException) {
                $return->message = $e->getMessage();
                $return->code = Response::HTTP_NOT_FOUND;
            } else if($e instanceof BadRequestHttpException) {
                $return->message = $e->getMessage();
                $return->code = Response::HTTP_BAD_REQUEST;
            } else if($e instanceof TooManyRequestsHttpException) {
                $return->message = $e->getMessage();
                $return->code = Response::HTTP_TOO_MANY_REQUESTS;
            } else if($e instanceof UnauthorizedHttpException) {
                $return->message = $e->getMessage();
                $return->code = Response::HTTP_UNAUTHORIZED;
            } else if($e instanceof UnprocessableEntityHttpException) {
                $return->message = $e->getMessage();
                $return->code = Response::HTTP_UNPROCESSABLE_ENTITY;
            } else if($e instanceof Exception) {
                $return->message = $e->getMessage();
                $return->code = Response::HTTP_INTERNAL_SERVER_ERROR;
            }

            return response()->json(
                ['message' => $return->message],
                $return->code
            );
        });
    })
    ->withSchedule(function (Schedule $schedule) {
        $schedule->job(new SendMaxPrizePointsEmail())->daily();
    })
    ->create();