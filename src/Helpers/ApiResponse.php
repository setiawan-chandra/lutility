<?php

namespace Kastanaz\Lutility\Helpers;

use Illuminate\Http\JsonResponse;

class ApiResponse
{
    /**
     * Http response code status array
     *
     * @var array
     */
    private static array $code = [
        'success' => 200,
        'created' => 201,
        'bad_request' => 400,
        'unauthorized' => 401,
        'forbidden' => 403,
        'not_found' => 404,
        'unprocessable_entity' => 422,
        'internal_server_error' => 500,
    ];

    /**
     * Base of json response
     *
     * @param string $message
     * @param [type] $data
     * @param integer $statusCode
     * @param array $errors
     * @return JsonResponse
     */
    protected static function base(string $message, $data, int $statusCode, array $errors = []): JsonResponse
    {
        return response()->json([
            'message' => $message,
            'data' => $data,
            'errors' => $errors,
        ], $statusCode);
    }

    /**
     * Success response
     *
     * @param  string  $message
     * @param  mixed  $data
     * @return JsonResponse
     */
    public static function success(string $message = '', $data = null, array $errors = []): JsonResponse
    {
        $message = $message ?: __('lutility::response.success');

        return self::base($message, $data, self::$code['success'], $errors);
    }

    /**
     * Created response
     *
     * @param  string  $message
     * @param  mixed  $data
     * @return JsonResponse
     */
    public static function created(string $message = '', $data = null, array $errors = []): JsonResponse
    {
        $message = $message ?: __('lutility::response.created');

        return self::base($message, $data, self::$code['created'], $errors);
    }

    /**
     * Bad Request Response
     *
     * @param  string  $message
     * @param  mixed  $data
     * @return JsonResponse
     */
    public static function badRequest(string $message = '', $data = null, array $errors = []): JsonResponse
    {
        $message = $message ?: __('lutility::response.bad_request');

        return self::base($message, $data, self::$code['bad_request'], $errors);
    }

    /**
     * Unauthorized Response
     *
     * @param  string  $message
     * @param  mixed  $data
     * @return JsonResponse
     */
    public static function unauthorized(string $message = '', $data = null, array $errors = []): JsonResponse
    {
        $message = $message ?: __('lutility::response.unauthorized');

        return self::base($message, $data, self::$code['unauthorized'], $errors);
    }

    /**
     * Forbidden Response
     *
     * @param  string  $message
     * @param  mixed  $data
     * @return JsonResponse
     */
    public static function forbidden(string $message = '', $data = null, array $errors = []): JsonResponse
    {
        $message = $message ?: __('lutility::response.forbidden');

        return self::base($message, $data, self::$code['forbidden'], $errors);
    }

    /**
     * Not Found Response
     *
     * @param  string  $message
     * @param  mixed  $data
     * @return JsonResponse
     */
    public static function notFound(string $message = '', $data = null, array $errors = []): JsonResponse
    {
        $message = $message ?: __('lutility::response.not_found');

        return self::base($message, $data, self::$code['not_found'], $errors);
    }

    /**
     * Unprocessable Entity
     *
     * @param  string  $message
     * @param  mixed  $data
     * @return JsonResponse
     */
    public static function unprocessableEntity(string $message = '', $data = null, array $errors = []): JsonResponse
    {
        $message = $message ?: __('lutility::response.unprocessable_entity');

        return self::base($message, $data, self::$code['unprocessable_entity'], $errors);
    }

    /**
     * Server Error Response
     *
     * @param  string  $message
     * @param  mixed  $data
     * @return JsonResponse
     */
    public static function serverError(string $message = '', $data = null, array $errors = []): JsonResponse
    {
        $message = $message ?: __('lutility::response.internal_server_error');

        return self::base($message, $data, self::$code['internal_server_error'], $errors);
    }
}
