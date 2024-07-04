<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Departement extends Model
{
    use HasFactory;
    protected $table='departements';
    protected $primaryKey='id_depart';
protected $fillabel=['id_depart','Nom_depart',	'Descriptif_depart',];
}
