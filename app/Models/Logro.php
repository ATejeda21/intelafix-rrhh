<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Logro extends Model
{
    use HasFactory;

    protected $fillable = [
        'empleado_id',
        'tipo',
        'descripcion',
        'fecha_ocurrencia'
    ];

    protected $casts = [
        'fecha_ocurrencia' => 'date'
    ];

    public function empleado()
    {
        return $this->belongsTo(Empleado::class);
    }
}