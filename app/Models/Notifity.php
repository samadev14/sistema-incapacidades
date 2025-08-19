<?php
/* Archivo que contiene el modelo Notifity. Se hace uso del Trait FormatsAttributes, que contiene la lógica de mutadores que formatean la información antes de ser almacenada en la base de datos. También, este archivo contiene la relación del modelo Notifity con el modelo Employee. */

namespace App\Models;

use App\Traits\FormatsAttributes;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Notifity extends Model
{
    use HasFactory;
    use FormatsAttributes;

    protected $fillable = [
        'message',
        'employee_id',
    ];

    public function setMessageAttribute($value)
    {
        $this->attributes['message'] = $this->toSentenceCase($value);
    }

    // Relación muchos a uno con el modelo Employee
    public function employee()
    {
        return $this->belongsTo(Employee::class);
    }
}
