<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Alumno extends Model
{
    protected $fillable = [
        'matricula',
        'nombre',
        'fecha_nacimiento',
        'telefono',
        'email',
        'nivel_id',
    ];
//protected $guarded =[];//Nombre de la tabla que se manda a llamar en la base de datos
use HasFactory;
public function nivel(){
    return $this->belongsTo(Nivel::class, 'nivel_id', 'id'); // esta es la relacion que se estable entre la 
    //tabla niveles y alumno
}
   
}
