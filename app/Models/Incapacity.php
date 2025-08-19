<?php
/* Archivo que contiene el modelo Incapacity. Se hace uso del Trait FormatsAttributes, que contiene la lógica de mutadores que formatean la información antes de ser almacenada en la base de datos. También, este archivo contiene la relación del modelo Incapacity con el modelo Employee. */

namespace App\Models;

use App\Traits\FormatsAttributes;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Incapacity extends Model
{
    use HasFactory;
    use FormatsAttributes;

    protected $fillable = [
        'type_incapacity',
        'description_incapacity',
        'start_date',
        'end_date',
        'status',
        'employee_id',
    ];

    protected $casts = [
        'start_date' => 'date',
        'end_date' => 'date',
    ];

    public function setDescriptionIncapacityAttribute($value)
    {
        $this->attributes['description_incapacity'] = $this->toSentenceCase($value);
    }

    // Relación muchos a uno con el modelo Employee
    public function employee()
    {
        return $this->belongsTo(Employee::class);
    }
}
