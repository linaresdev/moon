<?php
namespace Moon\Install\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class AccountRequest extends FormRequest
{
    public function authorize()
    {
        return true;
    }

    public function rules(): array
    {
        return [
            'appname'   => 'required',
            'slogan'    => 'required',
            'firstname' => 'required',
            'lastname'  => 'required',
            'email'     => 'required|unique:users,email',
            'password'  => 'required',
        ];
    }

    public function attributes(): array
    {
        return [
            'appname'   => __('Nombre del aplicativo'),
            'slogan'    => __('Descripción del aplicativo'),
            'firstname' => __('Nombre de la cuenta'),
            "lastname"  => __('Apellidos de la cuenta'),
            'email'     => __('Correo electrónico'),
            'password'  => __('Contraseña'),
        ];
    }

    public function messages(): array
    {
        return [
            "required" => __("Campo :attribute requerido")
        ];
    }
}