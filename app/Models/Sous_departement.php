<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Sous_departement extends Model
{
    use HasFactory;

protected $table='sous_departements';

protected $primaryKey = 'id_sous_depart';
    public $incrementing = true; 
    protected $keyType = 'integer'; 
    public $timestamps = false; 

protected $fillabel=['id_sous_depart',	'id_depart',	'Nom_sous_depart',	'Descriptif_sous_depart','Nom_sous_depart_ar','Descriptif_sous_depart_ar'];

public function travail()
{
    return $this->hasMany(Travail::class, 'id_sous_depart', 'id_sous_depart');
}

public function departement()
{
    return $this->belongsTo(Departement::class, 'id_depart', 'id_depart');
}

public function contient()
{
    return $this->hasMany(Contient::class,'id_sous_depart','id_sous_depart');
}

public function conge()
{
    return $this->hasMany(Conge::class,'id_sous_depart','id_sous_depart');
}

}