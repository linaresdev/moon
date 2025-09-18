<?php
namespace Moon\Install\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class AccountRequest extends FormRequest {

    public function authorize() {
        return true;
    }

    public function attributes() {
        return [];
    }

    public function messages() {
        return [];
    }

}