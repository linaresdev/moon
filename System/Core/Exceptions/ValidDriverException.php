<?php
namespace Moon\Core\Exceptions;

use Exception;
use Illuminate\Http\Request;
use Illuminate\Http\Response;

class ValidDriverException extends Exception 
{
    public function report(): void
    {
    }

    public function render(Request $request): Response
    {
       return response($this->getMessage());
    }
}