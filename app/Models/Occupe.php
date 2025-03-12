<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\Employe;
use App\Models\Sous_Departement;
use App\Models\Post;
class Occupe extends Model
{
    use HasFactory;
    protected $table = 'occupes';
    protected $primaryKey = 'id_occup';
    public $incrementing = true; 
    protected $keyType = 'integer';
    public $timestamps = false;

    protected $fillable=['id_occup','date_recrutement','echellant'	,'id_nin','id_p','id_post'];
    public function employe()
    {
        return $this->belongsTo(Employe::class, ['id_nin','id_p'], ['id_nin','id_p']);
    }
    public function sous_departement()
    {
        return $this->belongsTo(Sous_Departement::class, 'id_sous_depart', 'id_sous_depart');
    }
    public function post()
    {
        return $this->belongsTo(Post::class, 'id_post', 'id_post');
    }
}
