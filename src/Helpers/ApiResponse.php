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
     * @param  string  $message
     * @param  bool  $status
     * @param  mixed  $data
     * @param  int  $statusCode
     * @return JsonResponse
     */
    private static function base(string $message, bool $status, $data, int $statusCode): JsonResponse
    {
        return response()->json([
            'status' => $status,
            'data' => $data,
            'message' => $message,
        ], $statusCode);
    }

    /**
     * Success response
     *
     * @param  string  $message
     * @param  mixed  $data
     * @return JsonResponse
     */
    public static function success(string $message = '', $data = null): JsonResponse
    {
        $message = $message ?: __('utility::response.success');

        return self::base($message, true, $data, self::$code['success']);
    }

    /**
     * Created response
     *
     * @param  string  $message
     * @param  mixed  $data
     * @return JsonResponse
     */
    public static function created(string $message = '', $data = null): JsonResponse
    {
        $message = $message ?: __('utility::response.created');

        return self::base($message, true, $data, self::$code['created']);
    }

    /**
     * Bad Request Response
     *
     * @param  string  $message
     * @param  mixed  $data
     * @return JsonResponse
     */
    public static function badRequest(string $message = '', $data = null): JsonResponse
    {
        $message = $message ?: __('utility::response.bad_request');

        return self::base($message, false, $data, self::$code['bad_request']);
    }

    /**
     * Unauthorized Response
     *
     * @param  string  $message
     * @param  mixed  $data
     * @return JsonResponse
     */
    public static function unauthorized(string $message = '', $data = null): JsonResponse
    {
        $message = $message ?: __('utility::response.unauthorized');

        return self::base($message, false, $data, self::$code['unauthorized']);
    }

    /**
     * Forbidden Response
     *
     * @param  string  $message
     * @param  mixed  $data
     * @return JsonResponse
     */
    public static function forbidden(string $message = '', $data = null): JsonResponse
    {
        $message = $message ?: __('utility::response.forbidden');

        return self::base($message, false, $data, self::$code['forbidden']);
    }

    /**
     * Not Found Response
     *
     * @param  string  $message
     * @param  mixed  $data
     * @return JsonResponse
     */
    public static function notFound(string $message = '', $data = null): JsonResponse
    {
        $message = $message ?: __('utility::response.not_found');

        return self::base($message, false, $data, self::$code['not_found']);
    }

    /**
     * Unprocessable Entity
     *
     * @param  string  $message
     * @param  mixed  $data
     * @return JsonResponse
     */
    public static function unprocessableEntity(string $message = '', $data = null): JsonResponse
    {
        $message = $message ?: __('utility::response.unprocessable_entity');

        return self::base($message, false, $data, self::$code['unprocessable_entity']);
    }

    /**
     * Server Error Response
     *
     * @param  string  $message
     * @param  mixed  $data
     * @return JsonResponse
     */
    public static function serverError(string $message = '', $data = null): JsonResponse
    {
        $message = $message ?: __('utility::response.internal_server_error');

        return self::base($message, false, $data, self::$code['internal_server_error']);
    }
}
