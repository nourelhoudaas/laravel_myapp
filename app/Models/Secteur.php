<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Secteur extends Model
{
    use HasFactory;
    protected $table = 'secteurs';
    protected $primaryKey = 'id_secteur';
    public $incrementing = true; 
    protected $keyType = 'integer';
    public $timestamps = false;
    

    protected $fillable=['id_secteur'	,'Nom_secteur',	'Nom_secteur_ar','id_filiere'];

    public function secteur ()
    {
        return $this->belongsTo(Filiere::class,'id_filiere','id_filiere');
    }

    public function posts()
    {
        return $this->hasMany(Post::class,'id_secteur','id_secteur');
    }

}
