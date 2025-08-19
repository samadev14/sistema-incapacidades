<?php
/* Archivo que contiene el modelo Healthcare. Se hace uso del Trait FormatsAttributes, que contiene la lógica de mutadores que formatean la información antes de ser almacenada en la base de datos. También, este archivo contiene la relación del modelo Healthcare con el modelo Employee. */

namespace App\Models;

use App\Traits\FormatsAttributes;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Healthcare extends Model
{
    use HasFactory;
    use FormatsAttributes;

    protected $fillable = [
        'name_healthcare',
    ];

    public function setNameHealthcareAttribute($value)
    {
        $this->attributes['name_healthcare'] = $this->toTitleCase($value);
    }

    // Relación uno a muchos con el modelo Employee
    public function employees()
    {
        return $this->hasMany(Employee::class);
    }
}
