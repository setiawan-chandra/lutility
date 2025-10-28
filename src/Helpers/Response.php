<?php

namespace Kastanaz\Lutility\Helpers;

class Response
{
    /**
     * Route Redirect
     *
     * @var string
     */
    private static string $route;

    /**
     * Route Params
     *
     * @var mixed
     */
    private static $param;

    /**
     * Redirect Back
     *
     * @var boolean
     */
    private static bool $back = false;

    /**
     * Call Route
     *
     * @param  string  $route
     * @param  mixed  $param
     * @return static
     */
    public static function route(string $route, $param = []): static
    {
        self::$route = $route;
        self::$param = $param;

        return new static();
    }

    /**
     * Enable Redirect Back
     *
     * @return static
     */
    public static function back(): static
    {
        self::$back = true;

        return new static();
    }

    /**
     * Success Response
     *
     * @param  string  $message
     * @return \Illuminate\Routing\Redirector|\Illuminate\Http\RedirectResponse
     */
    public static function success(string $message = ''): \Illuminate\Routing\Redirector|\Illuminate\Http\RedirectResponse
    {
        $message = $message ?: __('lutility::response.success');

        return self::base('success', $message);
    }

    /**
     * Error Reponse
     *
     * @param  string  $message
     * @return \Illuminate\Routing\Redirector|\Illuminate\Http\RedirectResponse
     */
    public static function error(string $message = ''): \Illuminate\Routing\Redirector|\Illuminate\Http\RedirectResponse
    {
        $message = $message ?: __('lutility::response.error');

        return self::base('error', $message);
    }

    /**
     * Base Response
     *
     * @param string $status
     * @param string $message
     * @return \Illuminate\Routing\Redirector|\Illuminate\Http\RedirectResponse
     */
    private static function base(string $status, string $message): \Illuminate\Routing\Redirector|\Illuminate\Http\RedirectResponse
    {
        if (self::$back) {
            return back()->with('status', $status)->with('message', $message);
        }
        return redirect()->route(self::$route, self::$param)->with('status', $status)->with('message', $message);
    }
}
