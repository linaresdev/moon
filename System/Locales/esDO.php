<?php
namespace Moon\Locales;

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

            ## Athentication
            "auth.bad"          => "Credenciales incorrectas",
            "auth.activated.0"  => "Cuenta inactiva",
            "aunt.activated.1"  => "Cuenta activa",
            "auth.activated.2"  => "Cuenta suspendida",
            "auth.activated.3"  => "Cuenta bloqueada",
            "auth.activated.4"  => "Cuenta inactiva por problemas legales",
            "auth.activated.5"  => "Cuenta eliminada",
            "auth.logout"       => "Salid de la sesion",
            "auth.logged"       => "Esta cuenta está autenticada",

            ## Windown
            "close.window"      => "Cerrar esta ventana",

            ## Legales
            "legal.agreements"  => "Acuerdos legales",

            ## Administrar
            "manage.app"        => "Administrar esta aplicación",

            ## Words
            "words.admin"           => "Administrador",
            "words.accessibility"   => "Accesibilidad",
            "words.contact"         => "Contacto",
            "words.cookies"         => "Cookies",
            "words.close"           => "Cerrar",
            "words.help"            => "Ayuda",
            "words.logout"          => "Salir",
            "words.login"           => "Acceder",
            "words.user"            => "Ususario",
            "words.manage"          => "Administrar",
            "words.password"        => "Contraseña",
            "words.privacy"         => "Privacidad",
            "words.security"        => "Seguridad",

            ## Validations
            "validator.email"       => "El campo :attribute no es valido",
            "validator.unique"      => "El :attribute no esta disponible",
            "validator.required"    => "El campo :attribute es requerido",
            "validator.min"         => "El campo :attribute solo permite minimo :min caracteres",
            "validator.max"         => "El campo :attribute solo permite maximo :min caracteres",
            "validator.numeric"     => "El campo :attribute solo adminte numeros",
            "validator.same"        => "Los campos no coinciden",
        ];
    }
}