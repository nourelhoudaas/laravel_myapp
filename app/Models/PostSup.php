<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PostSup extends Model
{
    use HasFactory;
    protected $table = 'post_sups';
    protected $primaryKey = 'id_postsup';
    public $incrementing = true; 
    protected $keyType = 'integer'; 
    public $timestamps = false;

    protected $fillable=['id_postsup',	'Nom_postsup',	'Nom_postsup_ar','Niveau_sup','point_indsup'];

    public function contient ()
    {
        return $this->hasMany(Contient::class,'id_postsup','id_postsup');
    }

    public function occupeIdNin()
    {
        return $this->hasMany(Occupe::class,'id_postsup','id_postsup');
    }

   
}
