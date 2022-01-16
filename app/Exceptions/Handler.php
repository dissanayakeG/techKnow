<?php

namespace App\Exceptions;

use Exception;
use Illuminate\Foundation\Exceptions\Handler as ExceptionHandler;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Validation\ValidationException;
use Tymon\JWTAuth\Exceptions\TokenInvalidException;

class Handler extends ExceptionHandler
{
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
     * @param Exception $exception
     * @return void
     * @throws Exception
     */
    public function report(Exception $exception)
    {
        parent::report($exception);
    }

    /**
     * Render an exception into an HTTP response.
     *
     * @param  Request  $request
     * @param Exception $exception
     * @return Response
     */
    public function render($request, Exception $exception)
    {
        if($exception instanceof TokenInvalidException) {
            return response()->json(['error' => 'Token invalid'], 400);
        }

        if ($exception instanceof ValidationException)
        {
            $response['errors']['validations'] = $exception->errors();
            return response(['data'=>$response])->header('Content-Type', 'application/json');
        }

        return parent::render($request, $exception);
    }

    //for globally response validation formatting
    // protected function invalidJson($request, ValidationException $exception)
    // {
    //     return response()->json([
    //         'data' => [],
    //         'meta' => [
    //             'message' => 'The given data is invalid',
    //             'errors' => $exception->errors()
    //         ]
    //     ], $exception->status);
    // }
}
