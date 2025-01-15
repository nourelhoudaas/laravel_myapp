<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Occupe extends Model
{
    use HasFactory;
    protected $table = 'occupes';
    protected $primaryKey = 'id_occup';
    public $incrementing = true;
    protected $keyType = 'integer';
    public $timestamps = false;


    protected $fillable = 
        ['id_occup', 'date_recrutement', 'echellant',
         'id_post', 'id_nin', 'id_p', 'ref_PV', 'ref_Decision', 
         'ref_base', 'id_postsup', 'id_fonction', 'date_CF','visa_CF'
         ,'type_CTR'
        ];

    public function employe()
    {
        return $this->belongsTo(Employe::class, ['id_nin', 'id_p'], ['id_nin', 'id_p']);
    }

    public function post()
    {
        return $this->belongsTo(Post::class, 'id_post', 'id_post');
    }

    public function postsup()
    {
        return $this->belongsTo(PostSup::class, 'id_postsup', 'id_postsup');
    }

    public function fonction()
    {
        return $this->belongsTo(Fonction::class, 'id_fonction', 'id_fonction');
    }

}

