<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Sous_departement extends Model
{
    use HasFactory;

protected $table='sous_departements';

protected $fillabel=['id_sous_depart',	'id_depart',	'Nom_sous_depart',	'Descriptif_sous_depart',];
}
