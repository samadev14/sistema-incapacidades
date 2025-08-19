<?php
/* Este archivo contiene la clase FormatsAttributes, cuyo recurso se encarga de formatear los datos que se digitan en los formularios, evitando que el usuario ingrese caracteres extraños o datos mal tipeados a la base de datos del sistema. La ventaja de este Trait es que se puede reutilizar en otros archivos del proyecto. */

namespace App\Traits;

trait FormatsAttributes
{
    protected function toTitleCase($value): string
    {
        return ucwords(mb_strtolower($value));
    }

    protected function toSentenceCase($value): string
    {
        return ucfirst(mb_strtolower($value));
    }
}
