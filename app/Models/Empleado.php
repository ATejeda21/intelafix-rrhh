<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Empleado extends Model
{
    use HasFactory;

    protected $fillable = [
        'nombres',
        'apellidos',
        'fecha_nacimiento',
        'fotografia',
        'puesto',
        'salario',
        'tienda'
    ];

    protected $casts = [
        'fecha_nacimiento' => 'date',
        'salario' => 'decimal:2'
    ];

    public function logros()
    {
        return $this->hasMany(Logro::class);
    }

    public function getNombreCompletoAttribute()
    {
        return "{$this->nombres} {$this->apellidos}";
    }

    public function getLogrosPositivosAttribute()
    {
        return $this->logros()->where('tipo', 'Positivo')->count();
    }

    public function getLogrosNegativosAttribute()
    {
        return $this->logros()->where('tipo', 'Negativo')->count();
    }
}