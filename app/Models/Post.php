<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Post extends Model
{
    use HasFactory;
    protected $table = 'posts';
    protected $primaryKey = 'id_post';
    public $incrementing = true; 
    protected $keyType = 'integer'; 
    public $timestamps = false;

    protected $fillable=['id_post',	'Nom_post',	'Grade_post','Nom_post_ar','id_secteur'];

    
    public function occupeIdNin()
    {
        return $this->hasMany(Occupe::class,'id_post','id_post');
    }
    
    public function niveau()
    {
        return $this->hasMany(Niveau::class,'id_post','id_post');
    }
    public function posts()
    {
        return $this->belongsTo(Secteur::class,'id_secteur','id_secteur');
    }
    public function contient ()
    {
        return $this->hasMany(Contient::class,'id_post','id_post');
    }

    //par categorie 
    public function employers()
    {
        return $this->belongsToMany(Employe::class, 'occupes', 'id_post', ['id_p', 'id_nin']);
    }

    public function fonctions()
    {
        return $this->belongsToMany(Fonction::class, 'contients', 'id_post', 'id_fonction');
    }

    public function postSups()
    {
        return $this->belongsToMany(PostSup::class, 'contients', 'id_post', 'id_postsup');
    }
}
