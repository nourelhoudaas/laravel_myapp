<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Fonction extends Model
{
    use HasFactory;
    protected $table = 'fonctions';
    protected $primaryKey = 'id_fonction';
    public $incrementing = true; 
    protected $keyType = 'string'; 
    public $timestamps = false;

    protected $fillable=['id_fonction',	'Nom_fonction',	'Nom_fonction_ar','Moyenne'];

    public function contient ()
    {
        return $this->hasMany(Contient::class,'id_fonction','id_fonction');
    }

    public function occupeIdNin()
    {
        return $this->hasMany(Occupe::class,'id_fonction','id_fonction');
    }


   
}  



