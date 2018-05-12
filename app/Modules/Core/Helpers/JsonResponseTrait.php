<?php

namespace App\Modules\Core\Helpers;

use Exception;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Validation\ValidationException;
use Illuminate\Auth\Access\AuthorizationException;
use Tymon\JWTAuth\Exceptions\TokenExpiredException;
use Tymon\JWTAuth\Exceptions\TokenInvalidException;
use Tymon\JWTAuth\Exceptions\TokenBlacklistedException;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use Symfony\Component\HttpKernel\Exception\HttpException;
use Symfony\Component\HttpKernel\Exception\UnauthorizedHttpException;
/**
 * JsonResponse Handler Trait
 *
 * @author Yuana
 * @since 22, oct 2017
 */
trait JsonResponseTrait
{
    protected function errorResponse(Exception $e)
    {
        $response = $this->getResponseStructure();

        $status = Response::HTTP_INTERNAL_SERVER_ERROR;

        if ($e instanceof UnauthorizedHttpException) {

            $status = Response::HTTP_UNAUTHORIZED;

            switch (is_object($e->getPrevious()) && get_class($e->getPrevious())) {
                case TokenExpiredException::class:
                    $response['error_code'] = ErrorCode::TOKEN_EXPIRED;
                    break;
                case TokenInvalidException::class:
                    $response['error_code'] = ErrorCode::TOKEN_INVALID;
                    break;
                case TokenBlacklistedException::class:
                    $response['error_code'] = ErrorCode::TOKEN_BLACKLISTED;
                    break;
                default:
                    $response['error_code'] = ErrorCode::TOKEN_NOT_PROVIDED;
                    break;
            }
        } else if ($e instanceof AuthorizationException) {

            $status = Response::HTTP_FORBIDDEN;
            $response['error_code'] = ErrorCode::PRIVILEGE_ACTION_UNAUTHORIZED;

        } else if ($e instanceof ValidationException) {

            $status = Response::HTTP_BAD_REQUEST;
            $response['error_validation'] = $e->errors();

        } else if ($e instanceof HttpException) {

            $status = $e->getStatusCode();

        } else if ($e instanceof ModelNotFoundException) {

            $status = Response::HTTP_NOT_FOUND;

        }

        $response['code']       = $status;
        $response['message']    = Response::$statusTexts[$status];
        $response['error']      = $e->getMessage();

        if (config('app.debug')) {
            $response['exception']  = get_class($e);
            $response['trace']      = $e->getTrace();
        }

        return $this->jsonResponse($response, $status);
    }

    protected function jsonResponse(array $payload = null, $statusCode = Response::HTTP_BAD_REQUEST)
    {
        return response()->json($payload ?: [], $statusCode);
    }

    protected function jsonResponseSuccess(array $payload = null, $msg = null)
    {
        $response = $this->getResponseStructure();

        $payload = array_merge($response, $payload);
        $payload['code'] = Response::HTTP_OK;
        $payload['message'] = !empty($msg) ? $msg : Response::$statusTexts[Response::HTTP_OK];

        return $this->jsonResponse($payload, Response::HTTP_OK);
    }

    protected function getResponseStructure()
    {
        return [
            'code' => null,
            'message' => null,
            'error' => null,
            'error_code' => null,
            'error_validation' => null,
            'data' => null
        ];
    }
}
