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

public function travails()
{
    return $this->hasMany(Travail::class, 'id_sous_depart', 'id_sous_depart');
}

public function departements()
{
    return $this->belongsTo(Departement::class, 'id_depart', 'id_depart');
}

public function contients()
{
    return $this->hasMany(Contient::class,'id_sous_depart','id_sous_depart');
}


}