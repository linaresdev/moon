<?php
namespace Moon\Http\Requests;

class LoginRequest extends RequestAccessor {

    public function authorize() {
        return true;
    }

    public function rules() {
        return [
            "user" => "required",
            "pwd" => "required"
        ];
    }

    public function attributes() {
        return [
            "user"  => __("Usuario"),
            "pwd"   => __("words.password")
        ];
    }

    public function messages() {
        return [
            "required" => __("validator.required")
        ];
    }    
}