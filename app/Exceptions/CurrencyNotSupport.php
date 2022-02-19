<?php

namespace App\Exceptions;

use Exception;

class CurrencyNotSupport extends Exception
{
    protected $message;

    public function __construct(string $message)
    {
        $this->message = $message;
    }

    /**
     * Report the exception.
     *
     * @return bool|null
     */
    public function report()
    {
        return true;
    }

    /**
     * Render the exception into an HTTP response.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function render($request)
    {
        return response($this->message, 500);
    }
}
