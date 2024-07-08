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

    protected $fillable=['id_post',	'Nom_post',	'Grade_post','Nom_post_ar'];

    public function contient ()
    {
        return $this->hasMany(Contient::class,'id_post','id_post');
    }

    public function occupe()
    {
        return $this->hasMany(occupe::class,'id_post','id_post');
    }

    public function niveau()
    {
        return $this->hasMany(Niveau::class,'id_post','id_post');
    }
}
