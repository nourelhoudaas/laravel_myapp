<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Contient extends Model
{
    use HasFactory;

    protected $table = 'contients';
    protected $primaryKey = 'id_contient';
    public $incrementing = true;
    protected $keyType = 'integer';
    public $timestamps = false;


    protected $fillable = [ 'id_contient','id_post','id_sous_depart','id_fonction','id_postsup'];

    public function post()
    {
        return $this->belongsTo(Post::class, 'id_post', 'id_post');
    }
    public function sous_departement()
    {
        return $this->belongsTo(Sous_departement::class, 'id_sous_depart', 'id_sous_depart');
    }
    public function fonction()
    {
        return $this->belongsTo(Fonction::class, 'id_fonction', 'id_fonction');
    }

    public function postsup()
    {
        return $this->belongsTo(PostSup::class, 'id_postsup', 'id_postsup');
    }

}

