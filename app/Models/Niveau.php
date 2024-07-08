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
    protected $fillablel=['id_niv'	,'Nom_niv'	,'Specialité',	'Descriptif_niv',
    'Nom_niv_ar','Specialité_ar','Descriptif_niv_ar','id_post'];

    public function appartient()
    {
        return $this->hasMany(appartient::class, 'id_niv','id_niv');
    }

    public function post()
    {
        return $this->belongsTo(Post::class, 'id_post','id_post');
    }
}

