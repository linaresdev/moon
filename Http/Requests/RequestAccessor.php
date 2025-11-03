<?php
namespace Moon\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class RequestAccessor extends FormRequest 
{
    public function add($key, $message) {
        return $this->validator->errors()->add($key, $message);
    }

    public function errors() {
        return $this->validator;
    }
}