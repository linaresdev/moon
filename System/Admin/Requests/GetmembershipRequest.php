<?php
namespace Moon\Admin\Requests;

use Illuminate\Foundation\Http\FormRequest;

class GetmembershipRequest extends FormRequest 
{
    public function authorize() {
        return true;
    }

    public function rules() 
    {
        return [
            "type"      => "required",
            "fullname"  => "required",
            "email"     => "required|unique:users,email",            
        ];
    }

    public function attributes()
    {
        return [
            "type"      => __("words.type"),
            "email"     => __("words.email"),
            "fullname"  => __("words.fullname")
        ];
    }

    public function messages() {
        return [
            "required"  => __("validator.required"),
            "unique"    => __("validator.required")
        ];
    }
}