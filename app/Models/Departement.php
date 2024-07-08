<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Departement extends Model
{
    use HasFactory;

    protected $table='departements';
    protected $primarykey='id_depart';
    public $incrementing=true;
    protected $keyType='integer';
    public $timestamps = false;

    protected $fillable = ['id_depart','Nom_depart','Descriptif_depart','Nom_depart_ar','Descriptif_depart_ar'];

    public function sous_departement()
    {
        return $this-> hasMany(Sous_departement::class,'id_depart','id_depart');
    }

}
