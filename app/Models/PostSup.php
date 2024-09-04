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

    protected $fillable=['id_postsup',	'Nom_postsup',	'Nom_postsup_ar'];

    public function contient ()
    {
        return $this->hasMany(Contient::class,'id_post','id_post');
    }

    public function occupeIdNin()
    {
        return $this->hasMany(Occupe::class,'id_post','id_post');
    }

    public function niveau()
    {
        return $this->hasMany(Niveau::class,'id_post','id_post');
    }
   
}
