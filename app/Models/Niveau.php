<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Niveau extends Model
{
    use HasFactory;
    protected $table = 'niveaux';
    protected $primaryKey = 'id_niv';
    public $incrementing = true; 
    protected $keyType = 'integer'; 
    protected $fillablel=['id_niv'	,'Nom_niv'	,'Specialité',	'Descriptif_niv'];
}
