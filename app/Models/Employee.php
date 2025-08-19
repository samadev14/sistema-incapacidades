<?php
/* Archivo que contiene el modelo Employee. Se hace uso del Trait FormatsAttributes, que contiene la lógica de mutadores y accesores que formatean la información antes de ser almacenada en la base de datos. También, este archivo contiene todas las relaciones del modelo Employee con los modelos Incapacity, Notifity, Position y Healthcare. */

namespace App\Models;

use App\Traits\FormatsAttributes;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Employee extends Model
{
    use HasFactory;
    use FormatsAttributes;

    protected $fillable = [
        'name_employee',
        'last_name_employee',
        'id_employee',
        'email_employee',
        'position_id',
        'healthcare_id',
    ];

    public function setNameEmployeeAttribute($value)
    {
        $this->attributes['name_employee'] = $this->toTitleCase($value);
    }

    public function setLastNameEmployeeAttribute($value)
    {
        $this->attributes['last_name_employee'] = $this->toTitleCase($value);
    }

    public function setEmailEmployeeAttribute($value)
    {
        $this->attributes['email_employee'] = mb_strtolower($value);
    }

    public function getFullNameAttribute()
    {
        return "{$this->name_employee} {$this->last_name_employee}";
    }

    // Relaciones uno a muchos con los modelos Incapacity y Notifity
    public function incapacity()
    {
        return $this->hasMany(Incapacity::class);
    }

    public function notifity()
    {
        return $this->hasMany(Notifity::class);
    }

    // Relaciones muchos a uno con los modelos Position y Healthcare
    public function position()
    {
        return $this->belongsTo(Position::class);
    }

    public function healthcare()
    {
        return $this->belongsTo(Healthcare::class);
    }
}
