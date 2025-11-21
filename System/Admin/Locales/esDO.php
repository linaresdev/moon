<?php
namespace Moon\Admin\Locales;

class esDO 
{
    public function header() {
        return [
           "slug"         => "es",
           "flag"         => "{cdn}/flag/do.svg",
           "name"         => "esDO",
           "description"  => "Español República Dominicana",
        ];
    }

    public function lines()
    {
        return [
            "auth.authenticated"    => "Cuenta autenticada",
            "auth.invite"           => "Acceso mediante invitación",
            "auth.login"            => "Iniciar sesión",
            "auth.field.user"       => "Correo electrónico o Usuario",
            "auth.field.password"   => "Su contraseña",
            "auth.getmembership"    => "Solicitar mi cuenta",


            "words.back"            => "Regresar",
            "words.close"           => "Cerrar",
            "words.email"           => "Correo electrónico",
            "words.firstname"       => "Primer nombre",
            "words.fullname"        => "Nombre completo",
            "words.invite"          => "Invitación",
            "words.lastname"        => "Apellidos",
            "words.request"         => "Solicitar",
            "words.save"            => "Guardar",
            "words.send"            => "Enviar",
            "words.subject"         => "Asunto",

            "take.back"             => "Llévame de vuelta a donde estaba",

            ## Validations
            "validator.email"       => "El campo :attribute no es valido",
            "validator.unique"      => "El :attribute no esta disponible",
            "validator.required"    => "El campo :attribute es requerido",
            "validator.min"         => "El campo :attribute solo permite minimo :min caracteres",
            "validator.max"         => "El campo :attribute solo permite maximo :min caracteres",
            "validator.numeric"     => "El campo :attribute solo adminte numeros",
            "validator.same"        => "Los campos no coinciden",

            "send.request"          => "Enviar solicitud",
        ];
    }
}